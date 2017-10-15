<?php

namespace backend\modules\renstra\controllers;

use Yii;
use common\models\TaIndikatorProgRenstra;
use backend\modules\renstra\models\TaIndikatorProgRenstraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IndikatorController implements the CRUD actions for TaIndikatorProgRenstra model.
 */
class IndikatorController extends Controller
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
     * Lists all TaIndikatorProgRenstra models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaIndikatorProgRenstraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaIndikatorProgRenstra model.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param integer $No_Ind_Prog
     * @return mixed
     */
    public function actionView($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $No_Ind_Prog)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $No_Ind_Prog),
        ]);
    }

    /**
     * Creates a new TaIndikatorProgRenstra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaIndikatorProgRenstra();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Perubahan' => $model->Kd_Perubahan, 'Kd_Dokumen' => $model->Kd_Dokumen, 'Kd_Usulan' => $model->Kd_Usulan, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran, 'Kd_Prog' => $model->Kd_Prog, 'ID_Prog' => $model->ID_Prog, 'No_Ind_Prog' => $model->No_Ind_Prog]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaIndikatorProgRenstra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param integer $No_Ind_Prog
     * @return mixed
     */
    public function actionUpdate($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $No_Ind_Prog)
    {
        $model = $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $No_Ind_Prog);

        if ($model->load(Yii::$app->request->post())) {
            IF($model->save()){
                echo 1;
            }ELSE{
                echo 0;
            }
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaIndikatorProgRenstra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param integer $No_Ind_Prog
     * @return mixed
     */
    public function actionDelete($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $No_Ind_Prog)
    {
        $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $No_Ind_Prog)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the TaIndikatorProgRenstra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param integer $No_Ind_Prog
     * @return TaIndikatorProgRenstra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $No_Ind_Prog)
    {
        if (($model = TaIndikatorProgRenstra::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Perubahan' => $Kd_Perubahan, 'Kd_Dokumen' => $Kd_Dokumen, 'Kd_Usulan' => $Kd_Usulan, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran, 'Kd_Prog' => $Kd_Prog, 'ID_Prog' => $ID_Prog, 'No_Ind_Prog' => $No_Ind_Prog])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
