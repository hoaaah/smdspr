<?php

namespace frontend\modules\musrenrw\controllers;

use Yii;
use yii\db\Query;
use common\models\RenjaProgram;
use common\models\RenjaKegiatan;
use common\models\Subkegiatan;
use frontend\modules\musrenrw\models\RenjaProgramSearch;
use frontend\modules\musrenrw\models\RenjaKegiatanSearch;
use frontend\modules\musrenrw\models\RenjaKegiatanSearchPublic;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Urusan;
use common\models\Bidang;
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
        if(isset(Yii::$app->session['tahun'])){
            $tahun = Yii::$app->session['tahun'];
        }else{
            $tahun = date('Y');
        }
        $searchModel = new RenjaProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('no_skpdMisi NOT IN (98,99)');
        $dataProvider->query->andWhere(['tahun' => $tahun]);
        $dataProvider->pagination->pageSize=10;
        //Untuk Daftar Kegiatan
        $searchKegiatan = new RenjaKegiatanSearchPublic();
        $dataKegiatan = $searchKegiatan->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['tahun' => $tahun]);
        $dataKegiatan->pagination->pageSize=10;        
        //This is for SKPD dropdownlist in search ----@hoaaah
        $connection = \Yii::$app->db;
        $skpd = $connection->createCommand('SELECT CONCAT(Kd_Urusan,".", Kd_Bidang,".",Kd_Unit,".",Kd_Sub) AS kd_skpd, Nm_Sub_Unit FROM r_sub_unit');
        $query = $skpd->queryAll();
        $program = $connection->createCommand('SELECT CONCAT(Kd_Urusan,".", Kd_Bidang,".",Kd_Unit,".",Kd_Sub, ".", id_renprog) AS kd_program, uraian FROM t_renja_program');
        $query2 = $program->queryAll();
        //untuk menghitung dan menggenerate total kegiatan        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchKegiatan' => $searchKegiatan,
            'dataKegiatan' => $dataKegiatan,
            'query' => $query,
            'query2' => $query2,
            'tahun' => $tahun
        ]);
    }

    public function actionTable()
    {
        if(isset(Yii::$app->session['tahun'])){
            $tahun = Yii::$app->session['tahun'];
        }else{
            $tahun = date('Y');
        }
        //Untuk Daftar Kegiatan
        $searchKegiatan = new RenjaKegiatanSearchPublic();
        $dataKegiatan = $searchKegiatan->search(Yii::$app->request->queryParams);
        $dataKegiatan->query->andWhere('a.no_skpdMisi NOT IN (98,99)');
        $dataKegiatan->query->where(['a.tahun' => $tahun]);
        $dataKegiatan->query->orderBy('a.kd_urusan', 'a.kd_bidang', 'a.kd_unit', 'a.kd_sub', 'a.id_renprog');
        $dataKegiatan->pagination->pageSize=30;
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
            'tahun' => $tahun,
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
