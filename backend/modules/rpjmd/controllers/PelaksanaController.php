<?php

namespace backend\modules\rpjmd\controllers;

use Yii;
use common\models\TaPelaksanaProgRPJMD;
use backend\modules\rpjmd\models\TaPelaksanaProgRPJMDSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PelaksanaController implements the CRUD actions for TaPelaksanaProgRPJMD model.
 */
class PelaksanaController extends Controller
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
     * Lists all TaPelaksanaProgRPJMD models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaPelaksanaProgRPJMDSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaPelaksanaProgRPJMD model.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $Id_Prog
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return mixed
     */
    public function actionView($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog, $Kd_Urusan, $Kd_Bidang, $Kd_Unit)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog, $Kd_Urusan, $Kd_Bidang, $Kd_Unit),
        ]);
    }

    /**
     * Creates a new TaPelaksanaProgRPJMD model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaPelaksanaProgRPJMD();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Perubahan' => $model->Kd_Perubahan, 'Kd_Dokumen' => $model->Kd_Dokumen, 'Kd_Usulan' => $model->Kd_Usulan, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran, 'Kd_Prog' => $model->Kd_Prog, 'Id_Prog' => $model->Id_Prog, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaPelaksanaProgRPJMD model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $Id_Prog
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return mixed
     */
    public function actionUpdate($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog, $Kd_Urusan, $Kd_Bidang, $Kd_Unit)
    {
        $model = $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog, $Kd_Urusan, $Kd_Bidang, $Kd_Unit);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/rpjmd/rpjmdprogram']);
            //return $this->redirect(['view', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Perubahan' => $model->Kd_Perubahan, 'Kd_Dokumen' => $model->Kd_Dokumen, 'Kd_Usulan' => $model->Kd_Usulan, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran, 'Kd_Prog' => $model->Kd_Prog, 'Id_Prog' => $model->Id_Prog, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaPelaksanaProgRPJMD model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $Id_Prog
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return mixed
     */
    public function actionDelete($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog, $Kd_Urusan, $Kd_Bidang, $Kd_Unit)
    {
        $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog, $Kd_Urusan, $Kd_Bidang, $Kd_Unit)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the TaPelaksanaProgRPJMD model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $Id_Prog
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return TaPelaksanaProgRPJMD the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog, $Kd_Urusan, $Kd_Bidang, $Kd_Unit)
    {
        if (($model = TaPelaksanaProgRPJMD::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Perubahan' => $Kd_Perubahan, 'Kd_Dokumen' => $Kd_Dokumen, 'Kd_Usulan' => $Kd_Usulan, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran, 'Kd_Prog' => $Kd_Prog, 'Id_Prog' => $Id_Prog, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
