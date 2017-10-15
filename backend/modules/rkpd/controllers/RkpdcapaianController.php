<?php

namespace backend\modules\rkpd\controllers;

use Yii;
use common\models\RkpdProgramCapaian;
use backend\modules\rkpd\models\RkpdProgramCapaianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RkpdcapaianController implements the CRUD actions for RkpdProgramCapaian model.
 */
class RkpdcapaianController extends Controller
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
     * Lists all RkpdProgramCapaian models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RkpdProgramCapaianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RkpdProgramCapaian model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RkpdProgramCapaian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RkpdProgramCapaian();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RkpdProgramCapaian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $id_program = \common\models\RkpdProgram::findOne(['tahun' => $model->tahun, 'urusan_id' => $model->urusan_id, 'bidang_id' => $model->bidang_id, 'no_misi' => $model->no_misi, 'no_tujuan' => $model->no_tujuan, 'no_sasaran' => $model->no_sasaran, 'kd_progrkpd' => $model->kd_progrkpd, 'id_progrkpd' => $model->id_progrkpd]);

        if ($model->load(Yii::$app->request->post())) {
            IF($model->save()){
                echo 1;
            }ELSE{
                echo 0;
            }
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
                'id_program' => $id_program,
            ]);
        }
    }

    /**
     * Deletes an existing RkpdProgramCapaian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        // return $this->redirect(['index']);
        $model = $this->findModel($id);
        $model->target_angka = 0;
        $model->save();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the RkpdProgramCapaian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RkpdProgramCapaian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RkpdProgramCapaian::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
