<?php

namespace backend\modules\forumskpd\controllers;

use Yii;
use yii\db\Query;
use common\models\RenjaKegiatan;
use common\models\Subkegiatan;
use common\models\TStatus;
use common\models\Jadwal;
use common\models\SubkegiatanPhoto;
use common\models\RenjaKegiatanSearchf;
use backend\modules\forumskpd\models\RenjaKegiatanSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/**
 * RenjakegiatanController implements the CRUD actions for RenjaKegiatan model.
 */
class RenjakegiatanforumController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RenjaKegiatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new \backend\modules\forumskpd\models\RenjaKegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('a.no_skpdMisi NOT IN (98,99)');        
        //This is for SKPD dropdownlist in search ----@hoaaah
        $connection = \Yii::$app->db;
        $program = $connection->createCommand('SELECT CONCAT(Kd_Urusan,".", Kd_Bidang,".",Kd_Unit,".",Kd_Sub,".",no_skpdMisi,".",no_skpdTujuan,".",no_skpdSasaran,".",no_renjaSas,".",no_renjaProg,".",id_renprog) AS kd_program, uraian FROM t_renja_program WHERE kd_urusan = '.Yii::$app->user->identity->tperan->kd_urusan.' AND kd_bidang = '.Yii::$app->user->identity->tperan->kd_bidang.' AND kd_unit = '.Yii::$app->user->identity->tperan->kd_unit.' AND kd_sub = '.Yii::$app->user->identity->tperan->kd_sub);
        $query = $program->queryAll();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'query' => $query,
        ]);
    }

    /**
     * Displays a single RenjaKegiatan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Subkegiatan::find()
                        ->where([
                                 'renja_kegiatan_id'    => $id,
                                 'user_id' => Yii::$app->user->identity->id,
                                 ])
                        ->orderBy('id DESC'),            
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);          
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    //action berikut untuk modals info_asb
    public function actionInfo($id)
    {
        $info = $this->findModel($id);
     
        return $this->renderAjax('info', [  // ubah ini
            'info' => $info,
        ]);
    }

    public function actionDetail($id)
    {
        $model = $this->findSubkegiatan($id);
        $status = NULL;
        IF($model->input_status == 3){
            $status = $this->findStatus($id);
        }
        $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 5])->one();  
        if($model!==null){
            $photo = $this->findPhoto($id);
            return $this->renderAjax('usulanrinci', [
                'model' => $model,
                'photo' => $photo,
                'status' => $status,
                'jadwal' => $jadwal,
            ]);           
        } else{
            return "Terjadi kesalahan dengan inputan ini, mungkin kegiatan sudah dihapus. Anda hanya dapat menolak usulan ini.";
        }
    }    

   //action selanjutnya berkaitan dengan tindak lanjut dari usulan RW. Terdiri dari Terima, tolak atau tangguhkan dan draft untuk mengembalikan seperti semula
    public function actionTerima($id)
    {
        $connection = \Yii::$app->db;
        $connection ->createCommand()
                    ->update('t_subkegiatan', ['input_status' => 2, 'status_phased' => 5], 'id='. $id)
                    ->execute();
        $model = $this->findSubkegiatan($id);
        Yii::$app->getSession()->setFlash('success', "Usulan".Html::encode($model->uraian)." berhasil diterima.");
        return $this->redirect(['index']);
    }

    //untuk ajax Tolak Kegiatan
    public function actionInfotolak($id)
    {
        $subkegiatan = $this->findSubkegiatan($id);
        $model = new TStatus();
        IF($model->load(Yii::$app->request->post())){
            $model->id_historis = 11;
            $model->id_ref = $subkegiatan->id;
            $model->kd_status = 3;
            $user_id = Yii::$app->user->identity->id;
            IF($model->save()){
                $connection = \Yii::$app->db;
                $connection ->createCommand()
                            ->update('t_subkegiatan', ['input_status' => 3, 'status_phased' => 5], 'id='. $id)
                            ->execute();
                Yii::$app->getSession()->setFlash('error', "Usulan".Html::encode($subkegiatan->uraian)." telah ditolak.");
                return $this->redirect(['index']);
            }
        }

        return $this->renderAjax('tolak', [
            'subkegiatan' => $subkegiatan,
            'model' => $model,
        ]);
    }      

    public function actionTangguh($id)
    {
        $connection = \Yii::$app->db;
        $connection ->createCommand()
                    ->update('t_subkegiatan', ['input_status' => 4, 'status_phased' => 5], 'id='. $id)
                    ->execute();
        $model = $this->findSubkegiatan($id);
        Yii::$app->getSession()->setFlash('error', "Usulan".Html::encode($model->uraian)." berhasil ditangguhkan.");
        return $this->redirect(['index']);
    }

    public function actionDraft($id)
    {
        $model = $this->findSubkegiatan($id);
        IF($model->input_status == 3){
            $this->findStatus($id)->delete();
        }         
        $connection = \Yii::$app->db;
        $connection ->createCommand()
                    ->update('t_subkegiatan', ['input_status' => 1, 'status_phased' => 5], 'id='. $id)
                    ->execute();       
        Yii::$app->getSession()->setFlash('success', "Usulan".Html::encode($model->uraian)." berhasil dikembalikan ke draft usulan.");
        return $this->redirect(['index']);
    }


    /**
     * Finds the RenjaKegiatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RenjaKegiatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RenjaKegiatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findSubkegiatan($id)
    {
        if (($model = Subkegiatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }    

    protected function findStatus($id)
    {
        if (($model = TStatus::find()->where('id_ref='.$id)->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }     

    protected function findPhoto($id)
    {
        if (($model = SubkegiatanPhoto::find()->where('musrenbang_id='.$id)->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }     
}
