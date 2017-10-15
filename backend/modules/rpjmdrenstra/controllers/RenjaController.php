<?php

namespace backend\modules\rpjmdrenstra\controllers;

use Yii;
use common\models\TaSasaranSKPD;
use backend\modules\rpjmdrenstra\models\TaSasaranSKPDSearch;
use yii\web\Controller;
use yii\base\Model;
//use app\base\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RenjaController implements the CRUD actions for RenjaProgram model.
 */
class RenjaController extends Controller
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
     * Lists all RenjaProgram models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaSasaranSKPDSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RenjaProgram model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionTambahmisi()
    {
        $model = new \common\models\TaMisiSKPD();
        //$tujuan = [new \common\models\RenjaProgramCapaian()];  
        $tujuan = [new \common\models\TaTujuanSKPD];
        $sasaran = [[new \common\models\TaSasaranSKPD]];              

        if ($model->load(Yii::$app->request->post())) {
            $model->Kd_Prov = 1;
            $model->Kd_Kab_Kota = 1;
            $model->No_Misi = ($this->findNoMisi($model->ID_Tahun)->No_Misi)+1;
            IF(Yii::$app->user->identity->tperan->kd_urusan <> NULL){
                $model->Kd_Urusan = Yii::$app->user->identity->tperan->kd_urusan;
                $model->Kd_Bidang = Yii::$app->user->identity->tperan->kd_bidang;
                $model->Kd_Unit = Yii::$app->user->identity->tperan->kd_unit;  
            }
            
                $tujuan = Model::createMultiple(\common\models\TaTujuanSKPD::classname());
                Model::loadMultiple($tujuan, Yii::$app->request->post());

                // validate person and houses models
                $valid = $model->validate();
                $valid = Model::validateMultiple($tujuan) && $valid;


                if (isset($_POST['Sasaran'][0][0])) {
                    foreach ($_POST['Sasaran'] as $indexTujuan => $sasaran) {
                        foreach ($sasaran as $indexSasaran => $sasaran) {
                            $data['Sasaran'] = $sasaran;
                            $sasaran = new \common\models\TaSasaranRKPD;
                            $sasaran->load($data);
                            $sasaran[$indexTujuan][$indexSasaran] = $sasaran;


                            $valid = $sasaran->validate();
                        }
                    }
                }

                if ($valid) {
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                            foreach ($tujuan as $indexTujuan => $tujuan) {
                                if ($flag === false) {
                                    break;
                                }

                                //$tujuan->No_Misi = $model->No_Misi;
                                //tambahan saya --@hoaaah
                                $tujuan->ID_Tahun = $model->ID_Tahun;
                                $tujuan->Kd_Prov = $model->Kd_Prov;
                                $tujuan->Kd_Kab_Kota = $model->Kd_Kab_Kota;
                                $tujuan->Kd_Urusan = $model->Kd_Urusan;
                                $tujuan->Kd_Bidang = $model->Kd_Bidang;
                                $tujuan->Kd_Unit = $model->Kd_Unit;
                                $tujuan->No_Misi = $model->No_Misi;
                                $tujuan->No_Tujuan = 1;
                                //akhir //tambahan saya --@hoaaah
                                if (!($flag = $tujuan->save(false))) {
                                    break;
                                }

                                if (isset($sasaran[$indexTujuan]) && is_array($sasaran[$indexTujuan])) {
                                    foreach ($sasaran[$indexTujuan] as $indexSasaran => $sasaran) {
                                        //$sasaran->No_Tujuan = $tujuan->No_Tujuan;
                                        //tambahan saya --@hoaaah
                                        $sasaran->ID_Tahun = $model->ID_Tahun;
                                        $sasaran->Kd_Prov = $model->Kd_Prov;
                                        $sasaran->Kd_Kab_Kota = $model->Kd_Kab_Kota;
                                        $sasaran->Kd_Urusan = $model->Kd_Urusan;
                                        $sasaran->Kd_Bidang = $model->Kd_Bidang;
                                        $sasaran->Kd_Unit = $model->Kd_Unit;
                                        $sasaran->No_Misi = $model->No_Misi;
                                        $sasaran->No_Tujuan = $tujuan->No_Tujuan;
                                        //akhir //tambahan saya --@hoaaah                                        
                                        if (!($flag = $sasaran->save(false))) {
                                            break;
                                        }
                                    }
                                }
                            }
                        }

                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->No_Misi]);
                        } else {
                            $transaction->rollBack();
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }
            print_r($model);
            echo "<br>";
            echo "<br>";
            print_r($tujuan);
            echo "<br>";
            echo "<br>";
            print_r($sasaran);
            //return $this->redirect(['index']);
        } else {
            return $this->render('tambahmisi', [
                'model' => $model,  
                'tujuan' => (empty($tujuan)) ? [new \common\models\TaTujuanSKPD] : $tujuan,
                'sasaran' => (empty($sasaran)) ? [[new \common\models\TaSasaranSKPD]] : $sasaran,                             
            ]);
        }
    }

    /**
     * Creates a new RenjaProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new \common\models\RenjaProgram();
        $capaian = [new \common\models\RenjaProgramCapaian()];        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'capaian' => (empty($capaian)) ? [new \common\models\RenjaProgramCapaian()] : $capaian                
            ]);
        }
    }

    public function actionTambah($id)
    {
        $sasaran[] = explode('.', $id);
        $model = new \common\models\RenjaProgram();
        $capaian = [new \common\models\RenjaProgramCapaian()];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
                'sasaran' => $sasaran,
                'capaian' => (empty($capaian)) ? [new \common\models\RenjaProgramCapaian()] : $capaian
            ]);
        }
    }    

    /**
     * Updates an existing RenjaProgram model.
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
     * Deletes an existing RenjaProgram model.
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

    protected function findNoMisi($id_tahun)
    {
        if (($model = \common\models\TaMisiSKPD::find()->orderBy('No_Misi DESC')->where('ID_Tahun ='.$id_tahun)->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }    
}
