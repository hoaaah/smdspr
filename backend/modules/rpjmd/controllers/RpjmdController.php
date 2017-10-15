<?php

namespace backend\modules\rpjmd\controllers;

use Yii;
use Yii\base\Model;
use common\models\TaMisiRPJMD;
use backend\modules\rpjmd\models\TaMisiRPJMDSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RpjmdController implements the CRUD actions for TaMisiRPJMD model.
 */
class RpjmdController extends Controller
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
     * Lists all TaMisiRPJMD models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaMisiRPJMDSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('No_Misi NOT IN (98,99)');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSasaran($id)
    {
        list($ID_Tahun, $No_Misi, $No_Tujuan) = explode('.', $id);
        $searchModel = new \backend\modules\rpjmd\models\TaSasaranRPJMDSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where([
                'ID_Tahun' => $ID_Tahun,
                'No_Misi' => $No_Misi,
                'No_Tujuan' => $No_Tujuan,
            ]);
        $dataProvider->pagination->pageParam = 'sasaran-page';
        $dataProvider->sort->sortParam = 'sasaran-sort'; 

        return Yii::$app->controller->renderPartial('_sasaran', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id,
            ]);
    }

    /**
     * Displays a single TaMisiRPJMD model.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $No_Misi
     * @return mixed
     */
    public function actionView($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi),
        ]);
    }

    /**
     * Creates a new TaMisiRPJMD model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaMisiRPJMD();
        $model->ID_Tahun = $this->IDTahun()->ID_Tahun;
        $model->Kd_Prov = $this->IDTahun()->Kd_Prov;
        $model->Kd_Kab_Kota = $this->IDTahun()->Kd_Kab_Kota;
        $model->Kd_Perubahan = 1;
        $model->Kd_Dokumen = 1;
        $model->Kd_Usulan = 1;
        $model->No_Misi = (TaMisiRPJMD::find()->where([
                        'ID_Tahun' => $model->ID_Tahun,
                        'Kd_Prov' => $model->Kd_Prov,
                        'Kd_Kab_Kota' => $model->Kd_Kab_Kota,
                        'Kd_Perubahan' => $model->Kd_Perubahan,
                        'Kd_Dokumen' => $model->Kd_Dokumen,
                        'Kd_Usulan' => $model->Kd_Usulan,
                    ])->select('MAX(No_Misi) AS No_Misi')->where('No_Misi NOT IN (98,99)')->one()->No_Misi) + 1;

        /*
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Perubahan' => $model->Kd_Perubahan, 'Kd_Dokumen' => $model->Kd_Dokumen, 'Kd_Usulan' => $model->Kd_Usulan, 'No_Misi' => $model->No_Misi]);
        }*/
        if ($model->load(Yii::$app->request->post())) {
            if($model->save())
            {
                echo 1;
            }else
            {
                echo 0;
            }
        }else{
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionTambah($id)
    {
        list($ID_Tahun, $No_Misi) = explode('.', $id);
        $tujuan = new \common\models\TaTujuanRPJMD();
        $sasaran = [new \common\models\TaSasaranRPJMD()];        

        if ($tujuan->load(Yii::$app->request->post())) {
            $tujuan->ID_Tahun = (int) ($ID_Tahun);
            $tujuan->Kd_Prov = $this->IDTahun()->Kd_Prov;
            $tujuan->Kd_Kab_Kota = $this->IDTahun()->Kd_Kab_Kota;
            $tujuan->No_Misi = (int) ($No_Misi);
            $tujuan->Kd_Perubahan = 1;
            $tujuan->Kd_Dokumen = 1;
            $tujuan->Kd_Usulan = 1;
            $tujuan->No_Tujuan = (\common\models\TaTujuanRPJMD::find()->where([
                        'ID_Tahun' => $this->IDTahun()->ID_Tahun,
                        'Kd_Prov' => $this->IDTahun()->Kd_Prov,
                        'Kd_Kab_Kota' => $this->IDTahun()->Kd_Kab_Kota,
                        'Kd_Perubahan' => $tujuan->Kd_Perubahan,
                        'Kd_Dokumen' => $tujuan->Kd_Dokumen,
                        'Kd_Usulan' => $tujuan->Kd_Usulan,
                        'No_Misi' => $No_Misi,
                    ])->select('MAX(No_Tujuan) AS No_Tujuan')->one()['No_Tujuan'])+1;
            IF($tujuan->save()){
                echo 1;
            }ELSE{
                echo 0;
            }
        }ELSE{
            return $this->renderAjax('_tambah', [
                'tujuan' => $tujuan,
                'id' => ($ID_Tahun.$No_Misi),
                'sasaran' => (empty($sasaran)) ? [new \common\models\TaSasaranRPJMD()] : $sasaran
            ]);                    
        }

    }

    public function actionTambahsasaran($id)
    {
        list($ID_Tahun, $No_Misi, $No_Tujuan) = explode('.', $id);
        $model = new \common\models\TaSasaranRPJMD();
        $model->ID_Tahun = $ID_Tahun;
        $model->Kd_Prov = $this->IDTahun()->Kd_Prov;
        $model->Kd_Kab_Kota = $this->IDTahun()->Kd_Kab_Kota;
        $model->Kd_Perubahan = 1;
        $model->Kd_Dokumen = 1;
        $model->Kd_Usulan = 1;
        $model->No_Misi = $No_Misi;
        $model->No_Tujuan = $No_Tujuan;
        $model->No_Sasaran = (\common\models\TaSasaranRPJMD::find()->where([
                        'ID_Tahun' => $model->ID_Tahun,
                        'Kd_Prov' => $model->Kd_Prov,
                        'Kd_Kab_Kota' => $model->Kd_Kab_Kota,
                        'Kd_Perubahan' => $model->Kd_Perubahan,
                        'Kd_Dokumen' => $model->Kd_Dokumen,
                        'Kd_Usulan' => $model->Kd_Usulan,
                        'No_Misi' => $model->No_Misi,
                        'No_Tujuan' => $model->No_Tujuan,
                    ])->select('MAX(No_Sasaran) AS No_Sasaran')->one()['No_Sasaran']) + 1;

        if ($model->load(Yii::$app->request->post()) ) {
            IF($model->save()){
                echo 1;
            }ELSE{
                echo 0;
            }
        } else {
            return $this->renderAjax('_tambahsasaran', [
                'model' => $model,
                'id' => $id,
            ]);
        }
    } 

    /**
     * Updates an existing TaMisiRPJMD model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $No_Misi
     * @return mixed
     */
    public function actionUpdate($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi)
    {
        $model = $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi);

        if ($model->load(Yii::$app->request->post())) {
            if($model->save())
            {
                echo 1;
            }else
            {
                echo 0;
            }
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaMisiRPJMD model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $No_Misi
     * @return mixed
     */
    public function actionDelete($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi)
    {
        $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaMisiRPJMD model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $No_Misi
     * @return TaMisiRPJMD the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi)
    {
        if (($model = TaMisiRPJMD::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Perubahan' => $Kd_Perubahan, 'Kd_Dokumen' => $Kd_Dokumen, 'Kd_Usulan' => $Kd_Usulan, 'No_Misi' => $No_Misi])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function cekjadwal(){
        //control cek jadwal --@hoaaah
        $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 1])->one();
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
