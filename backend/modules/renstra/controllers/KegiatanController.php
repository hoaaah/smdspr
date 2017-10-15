<?php

namespace backend\modules\renstra\controllers;

use Yii;
use common\models\TaKegiatanSkpd;
use backend\modules\renstra\models\TaKegiatanSkpdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KegiatanController implements the CRUD actions for TaKegiatanSkpd model.
 */
class KegiatanController extends Controller
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
     * Lists all TaKegiatanSkpd models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaKegiatanSkpdSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaKegiatanSkpd model.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionView($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg),
        ]);
    }

    /**
     * Creates a new TaKegiatanSkpd model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaKegiatanSkpd();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran, 'Kd_Prog' => $model->Kd_Prog, 'ID_Prog' => $model->ID_Prog, 'Kd_Keg' => $model->Kd_Keg]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaKegiatanSkpd model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionUpdate($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg)
    {
        $model = $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran, 'Kd_Prog' => $model->Kd_Prog, 'ID_Prog' => $model->ID_Prog, 'Kd_Keg' => $model->Kd_Keg]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaKegiatanSkpd model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionDelete($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg)
    {
        $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaKegiatanSkpd model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param integer $Kd_Keg
     * @return TaKegiatanSkpd the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg)
    {
        if (($model = TaKegiatanSkpd::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran, 'Kd_Prog' => $Kd_Prog, 'ID_Prog' => $ID_Prog, 'Kd_Keg' => $Kd_Keg])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
