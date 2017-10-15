<?php

namespace frontend\modules\musrenrw\controllers;

use Yii;
use yii\db\Query;
use common\models\RenjaKegiatan;
use common\models\Subkegiatan;
use common\models\RenjaKegiatanSearchf;
use frontend\modules\musrenrw\models\RenjaKegiatanSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RenjakegiatanController implements the CRUD actions for RenjaKegiatan model.
 */
class RenjakegiatanController extends Controller
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
        if(isset(Yii::$app->session['tahun'])){
            $tahun = Yii::$app->session['tahun'];
        }else{
            $tahun = date('Y');
        }
        $searchModel = new \frontend\modules\musrenrw\models\RenjaKegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['a.tahun' => $tahun]);
        //This is for SKPD dropdownlist in search ----@hoaaah
        $connection = \Yii::$app->db;
        $skpd = $connection->createCommand('SELECT CONCAT(Kd_Urusan,".", Kd_Bidang,".",Kd_Unit,".",Kd_Sub) AS kd_skpd, Nm_Sub_Unit FROM r_sub_unit');
        $query = $skpd->queryAll();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'query' => $query,
            'tahun' => $tahun,
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

    /**
     * Creates a new RenjaKegiatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RenjaKegiatan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RenjaKegiatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RenjaKegiatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

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
}
