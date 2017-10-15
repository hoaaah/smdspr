<?php

namespace backend\modules\forumskpd\controllers;

use Yii;
use yii\db\Query;
use common\models\RenjaKegiatan;
use common\models\Subkegiatan;
use common\models\RenjaKegiatanSearchf;
use backend\modules\forumskpd\models\RenjaKegiatanSearch;
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
