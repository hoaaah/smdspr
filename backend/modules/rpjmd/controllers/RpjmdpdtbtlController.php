<?php

namespace backend\modules\rpjmd\controllers;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use common\models\RpjmdProgram;
use backend\modules\rpjmd\models\RpjmdProgramSearch;
use common\models\TaMisiRPJMD;
use backend\modules\rpjmd\models\TaMisiRPJMDSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RpjmdController implements the CRUD actions for TaMisiRPJMD model.
 */
class RpjmdpdtbtlController extends Controller
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
                    'create' => ['POST'],
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
        $searchModel = new RpjmdProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('No_Misi IN (98,99)');
        $jadwal = $this->cekjadwal();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jadwal' => $jadwal,
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
        
        return Yii::$app->controller->renderPartial('_sasaran', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
    }


    /**
     * Creates a new TaMisiRPJMD model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $ID_Tahun = $this->IDTahun();
        IF(Yii::$app->session->get('tahun') && $tahun = Yii::$app->session->get('tahun'));
        $pemda = \common\models\TaPemdaUmum::find()->where('YEAR(created_at) <= '.$tahun)->one();
        $misi = Yii::$app->db->createCommand()->batchInsert('ta_misi_rpjmd', [
                'ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'No_Misi', 'Ur_Misi'
                ], [
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 98, 'Pendapatan Daerah'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 'Belanja Tidak Langsung'],
            ]);
        $tujuan = Yii::$app->db->createCommand()->batchInsert('ta_tujuan_rpjmd', [
                'ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'No_Misi', 'No_Tujuan', 'Ur_Tujuan'
                ], [
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 98, 1, 'Pendapatan Daerah'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 'Belanja Tidak Langsung'],
            ]);
        $sasaran = Yii::$app->db->createCommand()->batchInsert('ta_sasaran_rpjmd', [
                'ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'No_Misi', 'No_Tujuan', 'No_Sasaran',  'Ur_Sasaran'
                ], [
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 98, 1, 1, 'Pendapatan Daerah'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 'Belanja Tidak Langsung'],
            ]);
        $program = Yii::$app->db->createCommand()->batchInsert('ta_program_rpjmd', [
                'ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'No_Misi', 'No_Tujuan', 'No_Sasaran',  'Kd_Prog', 'Id_Prog', 'Ket_Program', 'Kd_Urusan1', 'Kd_Bidang1'
                ], [
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 98, 1, 1, 1, '00', 'Pendapatan Asli Daerah', 0, 0],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 98, 1, 1, 2, '00', 'Dana Perimbangan', 0, 0],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 98, 1, 1, 3, '00', 'Lain-Lain PAD yang Sah', 0, 0],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 1, '00', 'Belanja Pegawai', 0, 0],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 2, '00', 'Belanja Bunga', 0, 0],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 3, '00', 'Belanja Subsidi', 0, 0],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 4, '00', 'Belanja Hibah', 0, 0],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 5, '00', 'Belanja Bantuan Sosial', 0, 0],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 6, '00', 'Belanja Bagi Hasil Kepada Provinsi/Kabupaten/Kota dan Pemerintah Desa', 0, 0],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 7, '00', 'Belanja Bantuan Keuangan Kepada Provinsi/Kabupaten/Kota dan Pemerintahan Desa', 0, 0],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 8, '00', 'Belanja Tidak Terduga', 0, 0],
            ]);
        $pagu = Yii::$app->db->createCommand()->batchInsert('ta_pagu_program_rpjmd', [
                'ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'No_Misi', 'No_Tujuan', 'No_Sasaran',  'Kd_Prog_rpjmd', 'Id_Prog_rpjmd', 'PaguTahun1', 'PaguTahun2', 'PaguTahun3', 'PaguTahun4', 'PaguTahun5', 'Satuan', 'Keterangan'
                ], [
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 98, 1, 1, 1, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 98, 1, 1, 2, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 98, 1, 1, 3, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 1, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 2, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 3, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 4, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 5, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 6, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 7, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, 99, 1, 1, 8, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
            ]);
        $misi->execute(); $tujuan->execute(); $sasaran->execute(); $program->execute(); $pagu->execute();
            return $this->redirect(Yii::$app->request->referrer);  
    }

    public function actionIndikator($id)
    {
        $model = new \common\models\TaIndikatorRPJMD();
        list($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog) = explode('.', $id);

        if ($model->load(Yii::$app->request->post())) {

            //preinsert ----@hoaaah
            $model->ID_Tahun = $ID_Tahun;
            $model->Kd_Prov = $Kd_Prov;
            $model->Kd_Kab_Kota = $Kd_Kab_Kota;
            $model->Kd_Perubahan = $Kd_Perubahan;
            $model->Kd_Dokumen = $Kd_Dokumen;
            $model->Kd_Usulan = $Kd_Usulan;
            $model->No_Misi = $No_Misi;
            $model->No_Tujuan = $No_Tujuan;
            $model->No_Sasaran = $No_Sasaran;
            $model->Kd_Prog = $Kd_Prog;
            $model->Id_Prog = $Id_Prog;
            IF($model->save()){
                echo 1;
            }ELSE{
                var_dump($model);
                echo 0;
            }

        } else {
            return $this->renderAjax('_formindikator', [
                'model' => $model,
                'id' => $id
            ]);
        }
    }

    public function actionPelaksana($id)
    {
        $model = new \common\models\TaPelaksanaProgRPJMD();
        list($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog) = explode('.', $id);
        $program = $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog);
        if ($model->load(Yii::$app->request->post())) {

            //preinsert ----@hoaaah
            $model->ID_Tahun = $ID_Tahun;
            $model->Kd_Prov = $Kd_Prov;
            $model->Kd_Kab_Kota = $Kd_Kab_Kota;
            $model->Kd_Perubahan = $Kd_Perubahan;
            $model->Kd_Dokumen = $Kd_Dokumen;
            $model->Kd_Usulan = $Kd_Usulan;
            $model->No_Misi = $No_Misi;
            $model->No_Tujuan = $No_Tujuan;
            $model->No_Sasaran = $No_Sasaran;
            $model->Kd_Prog = $Kd_Prog;
            $model->Id_Prog = $Id_Prog;
            $model->Kd_Urusan1 = $program->Kd_Urusan1;
            $model->Kd_Bidang1 = $program->Kd_Bidang1;
            IF($model->save()){
                echo 1;
            }ELSE{
                var_dump($model);
                echo 0;
            }

        } else {
            return $this->renderAjax('_formpelaksana', [
                'model' => $model,
                'id' => $id
            ]);
        }
    }

    /**
     * Updates an existing RpjmdProgram model.
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
     * @return mixed
     */
    public function actionUpdate($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog)
    {
        $model = $this->findProgram($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog);
        $pagu = \common\models\TaPaguProgramRPJMD::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Perubahan' => $Kd_Perubahan, 'Kd_Dokumen' => $Kd_Dokumen, 'Kd_Usulan' => $Kd_Usulan, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran, 'Kd_Prog_rpjmd' => $Kd_Prog, 'Id_Prog_rpjmd' => $Id_Prog]);

        if ($model->load(Yii::$app->request->post()) && $pagu->load(Yii::$app->request->post()) ) {
            IF($model->save() && $pagu->save()){
                echo 1;
            }ELSE{
                echo 0;
            }
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
                'pagu' => $pagu,
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
    public function actionDelete()
    {
        $ID_Tahun = $this->IDTahun();
        /* below code actually unneccessary, because No_Misi foreign key have cascade onDelete
        \common\models\TaSasaranRPJMD::findOne(['ID_Tahun' => $ID_Tahun->ID_Tahun, 'No_Misi' => 98])->delete();
        \common\models\TaSasaranRPJMD::findOne(['ID_Tahun' => $ID_Tahun->ID_Tahun, 'No_Misi' => 99])->delete();
        \common\models\TaTujuanRPJMD::findOne(['ID_Tahun' => $ID_Tahun->ID_Tahun, 'No_Misi' => 98])->delete();
        \common\models\TaTujuanRPJMD::findOne(['ID_Tahun' => $ID_Tahun->ID_Tahun, 'No_Misi' => 99])->delete();
        */
        \common\models\TaMisiRPJMD::findOne(['ID_Tahun' => $ID_Tahun->ID_Tahun, 'No_Misi' => 98])->delete();
        \common\models\TaMisiRPJMD::findOne(['ID_Tahun' => $ID_Tahun->ID_Tahun, 'No_Misi' => 99])->delete();
        

        //$this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi)->delete();

        return $this->redirect(Yii::$app->request->referrer);
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


   protected function findProgram($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog)
    {
        if (($model = RpjmdProgram::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Perubahan' => $Kd_Perubahan, 'Kd_Dokumen' => $Kd_Dokumen, 'Kd_Usulan' => $Kd_Usulan, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran, 'Kd_Prog' => $Kd_Prog, 'Id_Prog' => $Id_Prog])) !== null) {
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
                ])->select('ID_Tahun')->one();
        }ELSE{
            $tahun = (DATE('Y')+1);
            $ID_Tahun = \common\models\TaPeriode::find()->where([
                    'or',
                    ['Tahun1' => $tahun],
                    ['Tahun2' => $tahun],
                    ['Tahun3' => $tahun],
                    ['Tahun4' => $tahun],
                    ['Tahun5' => $tahun],
                ])->select('ID_Tahun')->one();
        } 

        return $ID_Tahun;
    } 
}
