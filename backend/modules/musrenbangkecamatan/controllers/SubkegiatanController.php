<?php

namespace backend\modules\musrenbangkecamatan\controllers;

use Yii;
use yii\db\Query;
use common\models\Subkegiatan;
use common\models\SubkegiatanPhoto;
use common\models\RenjaKegiatan;
use common\models\TStatus;
use common\models\Historis;
use common\models\Jadwal;
use common\models\Proses;
use backend\modules\musrenbangkecamatan\models\SubkegiatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/**
 * SubkegiatanController implements the CRUD actions for Subkegiatan model.
 */
class SubkegiatanController extends Controller
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
                    'terima' => ['POST'],
                    'tangguh'=> ['POST'],
                    'draft'  => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Subkegiatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubkegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 4])->one();
        $proses = Proses::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 4])->andWhere('kd_kecamatan=:kd_kecamatan', [':kd_kecamatan' => Yii::$app->user->identity->tperan->kd_kecamatan])->one();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jadwal' => $jadwal,
            'proses' => $proses,
        ]);
    }

    /**
     * Displays a single Subkegiatan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $kegiatan = $this->findKegiatan($model->renja_kegiatan_id);
        $photo = $this->findUsulan($id);
        return $this->render('view', [
            'model' => $model,
            'kegiatan' => $kegiatan,
            'photo' => $photo,
        ]);
    }


    /**
     * Updates an existing Subkegiatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $photo = $this->findPhoto($id);        
        $model = $this->findModel($id);
        $kegiatan = $this->findKegiatan($model->renja_kegiatan_id);     
        if($model->kd_kelurahan <> Yii::$app->user->identity->tperan->kd_kelurahan){
            Yii::$app->getSession()->setFlash('danger','Anda tidak memiliki akses untuk mengubah data ini');
            return $this->redirect(['view','id'=>$model->id]);
        }
        //persiapkan variabel untuk historis
        $model_s = $this->findModel($id);
        $historis = new Historis();
        if ($model->load(Yii::$app->request->post()) && $historis->load(Yii::$app->request->post())) {
            //$model->updated_at = DATE('Y-m-d');
            //ketika perubahan disimpan, copy semua data sebelum ke historis
            IF($model->save()){
                $historis->kd_historis = 11;
                $historis->id_ref = $id;
                //$historis->created_at = DATE('Y-m-d');
                $historis->tahun = $model_s->tahun;
                $historis->kd_urusan = $kegiatan->kd_urusan;
                $historis->kd_bidang = $kegiatan->kd_bidang;
                $historis->kd_unit = $kegiatan->kd_unit;
                $historis->kd_sub = $kegiatan->kd_sub;
                $historis->no_skpdMisi = $kegiatan->no_skpdMisi;
                $historis->no_skpdTujuan = $kegiatan->no_skpdTujuan;
                $historis->no_skpdSasaran = $kegiatan->no_skpdSasaran;
                $historis->no_renjaSas = $kegiatan->no_renjaSas;
                $historis->no_renjaProg = $kegiatan->no_renjaProg;
                $historis->id_renprog = $kegiatan->id_renprog;
                $historis->uraian = $model_s->uraian;
                $historis->kd_kecamatan = $model_s->kd_kecamatan;
                $historis->kd_kelurahan = $model_s->kd_kelurahan;
                $historis->rw = $model_s->rw;
                $historis->rt = $model_s->rt;
                $historis->lokasi = $model_s->lokasi;
                $historis->volume = $model_s->volume;
                $historis->satuan = $model_s->satuan;
                $historis->harga_satuan = $model_s->harga_satuan;
                $historis->biaya = $model_s->biaya;
                $historis->kd_asb = $model_s->kd_asb;
                $historis->input_phased = $model_s->input_phased;
                $historis->status = $model_s->input_status;
                $historis->status_phased = $model_s->status_phased;
                $historis->alasan_perubahan = $historis->alasan_perubahan;
                $historis->user_id = Yii::$app->user->identity->id;
                IF($historis->save()){
                    Yii::$app->getSession()->setFlash('success','Perubahan atas usulan'.Html::encode($model->uraian).'berhasil.');
                    return $this->redirect(['index']);
                }
            }
            
        } else {
            return $this->render('update', [
                'model' => $model,
                'kegiatan' => $kegiatan,
                'photo'=> $photo,
                'historis' => $historis,        
            ]);
        }
    }

    public function actionDetail($id)
    {
        $model = $this->findModel($id);
        $status = NULL;
        IF($model->input_status == 3){
            $status = $this->findStatus($id);
        }
        $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 4])->one();  
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
                    ->update('t_subkegiatan', ['input_status' => 2, 'status_phased' => 4], 'id='. $id)
                    ->execute();
        $model = $this->findModel($id);
        Yii::$app->getSession()->setFlash('success', "Usulan".Html::encode($model->uraian)." berhasil diterima.");
        return $this->redirect(['index']);
    }

    //untuk ajax Tolak Kegiatan
    public function actionInfotolak($id)
    {
        $subkegiatan = $this->findModel($id);
        $model = new TStatus();
        IF($model->load(Yii::$app->request->post())){
            $model->id_historis = 11;
            $model->id_ref = $subkegiatan->id;
            $model->kd_status = 3;
            $user_id = Yii::$app->user->identity->id;
            IF($model->save()){
                $connection = \Yii::$app->db;
                $connection ->createCommand()
                            ->update('t_subkegiatan', ['input_status' => 3, 'status_phased' => 4], 'id='. $id)
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
                    ->update('t_subkegiatan', ['input_status' => 4, 'status_phased' => 4], 'id='. $id)
                    ->execute();
        $model = $this->findModel($id);
        Yii::$app->getSession()->setFlash('error', "Usulan".Html::encode($model->uraian)." berhasil ditangguhkan.");
        return $this->redirect(['index']);
    }

    public function actionDraft($id)
    {
        $model = $this->findModel($id);
        IF($model->input_status == 3){
            $this->findStatus($id)->delete();
        }         
        $connection = \Yii::$app->db;
        $connection ->createCommand()
                    ->update('t_subkegiatan', ['input_status' => 1, 'status_phased' => 4], 'id='. $id)
                    ->execute();       
        Yii::$app->getSession()->setFlash('success', "Usulan".Html::encode($model->uraian)." berhasil dikembalikan ke draft usulan.");
        return $this->redirect(['index']);
    }

    /**
     * Finds the Subkegiatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subkegiatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subkegiatan::findOne($id)) !== null) {
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

    protected function findKegiatan($id)
    {
        if (($model = RenjaKegiatan::findOne($id)) !== null) {
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

}
