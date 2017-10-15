<?php

namespace backend\modules\renstra\controllers;

use Yii;
use yii\base\Model;
use common\models\TaMisiSKPD;
use backend\modules\renstra\models\TaMisiSKPDSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RenstraController implements the CRUD actions for TaMisiSKPD model.
 */
class RenstraController extends Controller
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
     * Lists all TaMisiSKPD models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaMisiSKPDSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('No_Misi NOT IN (98,99)');
        $jadwal = $this->cekjadwal();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jadwal' => $jadwal
        ]);
    }

    public function actionSasaran($id)
    {
        list($ID_Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan) = explode('.', $id);
        $searchModel = new \backend\modules\renstra\models\TaSasaranSKPDSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where([
                'ID_Tahun' => $ID_Tahun,
                'Kd_Urusan' => $Kd_Urusan,
                'Kd_Bidang' => $Kd_Bidang,
                'Kd_Unit' => $Kd_Unit,
                'No_Misi' => $No_Misi,
                'No_Tujuan' => $No_Tujuan,
            ]);
        
        return Yii::$app->controller->renderPartial('_sasaran', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id,
            ]);
    }

    /**
     * Displays a single TaMisiSKPD model.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @return mixed
     */
    public function actionView($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi),
        ]);
    }

    /**
     * Creates a new TaMisiSKPD model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $jadwal = $this->cekjadwal();
        IF($jadwal){
            $model = new TaMisiSKPD();

            if ($model->load(Yii::$app->request->post())) {
                $model->ID_Tahun = $this->IDTahun()->ID_Tahun;
                $model->Kd_Prov = $this->IDTahun()->Kd_Prov;
                $model->Kd_Kab_Kota = $this->IDTahun()->Kd_Kab_Kota;
                IF(!$model->Kd_Urusan){
                    $model->Kd_Urusan = Yii::$app->user->identity->tperan->kd_urusan;
                    $model->Kd_Bidang = Yii::$app->user->identity->tperan->kd_bidang;
                    $model->Kd_Unit = Yii::$app->user->identity->tperan->kd_unit;
                }
                $model->No_Misi = (\common\models\TaMisiSKPD::find()->where([
                        'ID_Tahun' => $this->IDTahun()->ID_Tahun,
                        'Kd_Prov' => $this->IDTahun()->Kd_Prov,
                        'Kd_Kab_Kota' => $this->IDTahun()->Kd_Kab_Kota,
                        'Kd_Urusan' => Yii::$app->user->identity->tperan->kd_urusan,
                        'Kd_Bidang' => Yii::$app->user->identity->tperan->kd_bidang,
                        'Kd_Unit' => Yii::$app->user->identity->tperan->kd_unit,
                    ])->andWhere('No_Misi < 98')->select('MAX(No_Misi) AS No_Misi')->one()['No_Misi']) +1;
                IF($model->save()){
                    echo 1;
                }ELSE{
                    echo 0;
                }
                //return $this->redirect(['view', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'No_Misi' => $model->No_Misi]);
            } else {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }            
        }ELSE{
            return $this->renderAjax('jadwal');
        }

    }

    public function actionTambah($id)
    {
        list($ID_Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi) = explode('.', $id);
        $tujuan = new \common\models\TaTujuanSKPD();
        $sasaran = [new \common\models\TaSasaranSKPD()];

        if ($tujuan->load(Yii::$app->request->post())) {
            $tujuan->ID_Tahun = $ID_Tahun;
            $tujuan->Kd_Prov = $this->IDTahun()->Kd_Prov;
            $tujuan->Kd_Kab_Kota = $this->IDTahun()->Kd_Kab_Kota;
            $tujuan->Kd_Urusan = $Kd_Urusan;
            $tujuan->Kd_Bidang = $Kd_Bidang;
            $tujuan->Kd_Unit = $Kd_Unit;
            $tujuan->No_Misi = $No_Misi;
            $No_Tujuan = (\common\models\TaTujuanSKPD::find()->where([
                        'ID_Tahun' => $this->IDTahun()->ID_Tahun,
                        'Kd_Prov' => $this->IDTahun()->Kd_Prov,
                        'Kd_Kab_Kota' => $this->IDTahun()->Kd_Kab_Kota,
                        'Kd_Urusan' => Yii::$app->user->identity->tperan->kd_urusan,
                        'Kd_Bidang' => Yii::$app->user->identity->tperan->kd_bidang,
                        'Kd_Unit' => Yii::$app->user->identity->tperan->kd_unit,
                        'No_Misi' => $No_Misi,
                    ])->select('No_Tujuan')->one()['No_Tujuan']) +1;
            $tujuan->No_Tujuan = $No_Tujuan;
            $sasaran = Model::createMultiple(\common\models\TaSasaranSKPD::classname());
            Model::loadMultiple($sasaran, Yii::$app->request->post());

            // validate all models
            $valid = $tujuan->validate();
            $valid = Model::validateMultiple($sasaran) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $tujuan->save(false)) {
                        foreach ($sasaran as $sasaran) {
                            $sasaran->ID_Tahun = $tujuan->ID_Tahun;
                            $sasaran->Kd_Prov = $tujuan->Kd_Prov;
                            $sasaran->Kd_Kab_Kota = $tujuan->Kd_Kab_Kota;
                            $sasaran->Kd_Urusan = $tujuan->Kd_Urusan;
                            $sasaran->Kd_Bidang = $tujuan->Kd_Bidang;
                            $sasaran->Kd_Unit = $tujuan->Kd_Unit;
                            $sasaran->No_Misi = $tujuan->No_Misi;
                            $sasaran->No_Tujuan = $tujuan->No_Tujuan;
                            if (! ($flag = $sasaran->save(false))) {
                                $transaction->rollBack();
                                echo 0;
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        echo 1;
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    echo 0;
                }
            }
        }
        return $this->renderAjax('_tambah', [
            'tujuan' => $tujuan,
            'sasaran' => (empty($sasaran)) ? [new \common\models\TaSasaranSKPD()] : $sasaran,
            'id' => $id,
        ]);        
    }

    public function actionTambahsasaran($id)
    {
        list($ID_Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan) = explode('.', $id);

        $jadwal = $this->cekjadwal();
        IF($jadwal){
            $model = new \common\models\TaSasaranSKPD();

            if ($model->load(Yii::$app->request->post())) {
                $model->ID_Tahun = $this->IDTahun()->ID_Tahun;
                $model->Kd_Prov = $this->IDTahun()->Kd_Prov;
                $model->Kd_Kab_Kota = $this->IDTahun()->Kd_Kab_Kota;
                IF(!$model->Kd_Urusan){
                    $model->Kd_Urusan = Yii::$app->user->identity->tperan->kd_urusan;
                    $model->Kd_Bidang = Yii::$app->user->identity->tperan->kd_bidang;
                    $model->Kd_Unit = Yii::$app->user->identity->tperan->kd_unit;
                }
                $model->No_Misi = $No_Misi;
                $model->No_Tujuan = $No_Tujuan;
                $model->No_Sasaran = (\common\models\TaSasaranSKPD::find()->where([
                        'ID_Tahun' => $this->IDTahun()->ID_Tahun,
                        'Kd_Prov' => $this->IDTahun()->Kd_Prov,
                        'Kd_Kab_Kota' => $this->IDTahun()->Kd_Kab_Kota,
                        'Kd_Urusan' => $model->Kd_Urusan,
                        'Kd_Bidang' => $model->Kd_Bidang,
                        'Kd_Unit' => $model->Kd_Unit,
                        'No_Misi' => $model->No_Misi,
                        'No_Tujuan' =>$model->No_Tujuan,
                    ])->select('No_Sasaran')->one()['No_Sasaran']) +1;
                IF($model->save()){
                    echo 1;
                }ELSE{
                    echo 0;
                }
            } else {
                return $this->renderAjax('_tambahsasaran', [
                    'model' => $model,
                    'id' => $id
                ]);
            }            
        }ELSE{
            return $this->renderAjax('jadwal');
        }

    }

    /**
     * Updates an existing TaMisiSKPD model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @return mixed
     */
    public function actionUpdate($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi)
    {
        $model = $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi);

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
     * Deletes an existing TaMisiSKPD model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @return mixed
     */
    public function actionDelete($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi)
    {
        $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaMisiSKPD model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @return TaMisiSKPD the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi)
    {
        if (($model = TaMisiSKPD::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'No_Misi' => $No_Misi])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function cekjadwal(){
        //control cek jadwal --@hoaaah
        $jadwal = \common\models\Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 1])->one();
        IF( DATE('Y-m-d') >= $jadwal['tgl_mulai'] && DATE('Y-m-d') <= $jadwal['tgl_selesai'] ){
            return true;
        }else{
            return false;
        }
    }

    protected function IDTahun(){
        IF(Yii::$app->session->get('tahun') && $tahun = Yii::$app->session->get('tahun')){
            $ID_Tahun = \common\models\TaPeriode::find()->where([
                    'or',
                    ['Tahun1' => $tahun],
                    ['Tahun2' => $tahun],
                    ['Tahun3' => $tahun],
                    ['Tahun4' => $tahun],
                    ['Tahun5' => $tahun],
                ])->one();
        }ELSE{
            $tahun = (DATE('Y')+1);
            $ID_Tahun = \common\models\TaPeriode::find()->where([
                    'or',
                    ['Tahun1' => $tahun],
                    ['Tahun2' => $tahun],
                    ['Tahun3' => $tahun],
                    ['Tahun4' => $tahun],
                    ['Tahun5' => $tahun],
                ])->one();
        } 

        return $ID_Tahun;
    }     
}
