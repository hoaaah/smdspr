<?php

namespace backend\modules\forumskpd\controllers;

use Yii;
use yii\db\Query;
use common\models\RenjaProgram;
use common\models\RenjaKegiatan;
use common\models\Subkegiatan;
use backend\modules\forumskpd\models\RenjaProgramSearch;
use backend\modules\forumskpd\models\RenjaKegiatanSearch;
use backend\modules\forumskpd\models\RenjaKegiatanSearchPublic;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Urusan;
use common\models\Bidang;
use common\models\Jadwal;
use common\models\Proses;
use common\components\CommonController;

/**
 * RenjaprogramController implements the CRUD actions for RenjaProgram model.
 */
class RenjaprogramController extends Controller
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

    public function beforeAction($event)
    {
        return parent::beforeAction($event);
    }

    /**
     * Lists all RenjaProgram models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RenjaProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->query->where('tahun ='.(DATE('Y')+1));
        $dataProvider->pagination->pageSize=10;
        //Untuk Daftar Kegiatan
        $searchKegiatan = new RenjaKegiatanSearch();
        $dataKegiatan = $searchKegiatan->search(Yii::$app->request->queryParams);
        //$dataProvider->query->where('tahun ='.(DATE('Y')+1));
        $dataKegiatan->pagination->pageSize=10;        
        //This is for SKPD dropdownlist in search ----@hoaaah
        $connection = \Yii::$app->db;
        $program = $connection->createCommand('SELECT CONCAT(Kd_Urusan,".", Kd_Bidang,".",Kd_Unit,".",Kd_Sub, ".", id_renprog) AS kd_program, uraian FROM t_renja_program WHERE kd_urusan ='.Yii::$app->user->identity->tperan->kd_urusan.' AND kd_bidang='.Yii::$app->user->identity->tperan->kd_bidang.' AND kd_unit='.Yii::$app->user->identity->tperan->kd_unit.' AND kd_sub='.Yii::$app->user->identity->tperan->kd_sub);
        $query = $program->queryAll();
        //Untuk jadwal dan cek BA
        $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 3])->one();
        $proses = Proses::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 5])->andWhere('kd_kelurahan=:kd_kelurahan', [':kd_kelurahan' => 98])->one();            
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchKegiatan' => $searchKegiatan,
            'dataKegiatan' => $dataKegiatan,
            'query' => $query,
            'jadwal' => $jadwal,
            'proses' => $proses,
        ]);
    }

    public function actionTable()
    {
        //Untuk Daftar Kegiatan
        $searchKegiatan = new RenjaKegiatanSearch();
        $dataKegiatan = $searchKegiatan->search(Yii::$app->request->queryParams);
        //$dataKegiatan->pagination->pageSize=30;
        $dataKegiatan->pagination->pageSize=100;    
        //This is for SKPD dropdownlist in search ----@hoaaah
        $connection = \Yii::$app->db;
        $skpd = $connection->createCommand('SELECT CONCAT(Kd_Urusan,".", Kd_Bidang,".",Kd_Unit,".",Kd_Sub) AS kd_skpd, Nm_Sub_Unit FROM r_sub_unit');
        $query = $skpd->queryAll();
        $program = $connection->createCommand('SELECT CONCAT(Kd_Urusan,".", Kd_Bidang,".",Kd_Unit,".",Kd_Sub, ".", id_renprog) AS kd_program, uraian FROM t_renja_program');
        $query2 = $program->queryAll();
        //untuk menghitung dan menggenerate total kegiatan        
        return $this->render('table', [
            'searchKegiatan' => $searchKegiatan,
            'dataKegiatan' => $dataKegiatan,
            'query' => $query,
            'query2' => $query2,
        ]);
    }
    /**
     * Displays a single RenjaProgram model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $dataProvider = new ActiveDataProvider([
            'query' => RenjaKegiatan::find()
                        ->where([
                                 'tahun'    => $model['tahun'],
                                 'kd_urusan'=> $model['kd_urusan'],
                                 'kd_bidang'=> $model['kd_bidang'],
                                 'kd_unit'=> $model['kd_unit'],
                                 'kd_sub'=> $model['kd_sub'],
                                 'id_renprog'=>$model['id_renprog'],
                                 ])
                        ->orderBy('id DESC'),            
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);        
        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    //Untuk ajax Detail Program
    public function actionDetail($id)
    {
        $model = $this->findModel($id);
        $dataProvider = new ActiveDataProvider([
            'query' => RenjaKegiatan::find()
                        ->where([
                                 'tahun'    => $model['tahun'],
                                 'kd_urusan'=> $model['kd_urusan'],
                                 'kd_bidang'=> $model['kd_bidang'],
                                 'kd_unit'=> $model['kd_unit'],
                                 'kd_sub'=> $model['kd_sub'],
                                 'id_renprog'=>$model['id_renprog'],
                                 ])
                        ->orderBy('id DESC'),            
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);     
        return $this->renderAjax('detail', [  // ubah ini
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    //untuk ajax rincian kegiatan
    public function actionKegiatanrinci($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Subkegiatan::find()
                        ->where([
                                 'renja_kegiatan_id'    => $id,
                                 ])
                        ->orderBy('id DESC'),            
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);          
        return $this->renderAjax('kegiatanrinci', [
            'model' => $this->findKegiatan($id),
            'dataProvider' => $dataProvider,
        ]);
    }    

    /**
     * Finds the RenjaProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RenjaProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RenjaProgram::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //untuk findKegiatan pada ajax rinci
    protected function findKegiatan($id)
    {
        if (($model = RenjaKegiatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }  

   
}
