<?php

namespace backend\modules\renstra\controllers;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use common\models\TaMisiSKPD;
use backend\modules\renstra\models\TaMisiSKPDSearch;
use backend\modules\renstra\models\RenstraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RenstraController implements the CRUD actions for TaMisiSKPD model.
 */
class RenstrapdtbtlController extends Controller
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
        $searchModel = new RenstraSearch();
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
        $ID_Tahun = $this->IDTahun();
        IF(Yii::$app->session->get('tahun') ){
            $tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $tahun = DATE('Y') +1;
        }
        $pemda = \common\models\TaPemdaUmum::find()->where('YEAR(created_at) <= '.$tahun)->one();
        $skpd = \common\models\TaSubUnit::find()->where('Tahun <= '.$tahun)->one();
        $misi = Yii::$app->db->createCommand()->batchInsert('ta_misi_skpd', [
                'ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'Ur_Misi'
                ], [
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, $skpd->Kd_Urusan, $skpd->Kd_Bidang, $skpd->Kd_Unit, 98, 'Pendapatan Daerah'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, $skpd->Kd_Urusan, $skpd->Kd_Bidang, $skpd->Kd_Unit, 99, 'Belanja Tidak Langsung'],
            ]);
        $tujuan = Yii::$app->db->createCommand()->batchInsert('ta_tujuan_skpd', [
                'ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'Ur_Tujuan'
                ], [
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, $skpd->Kd_Urusan, $skpd->Kd_Bidang, $skpd->Kd_Unit, 98, 1, 'Pendapatan Daerah'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, $skpd->Kd_Urusan, $skpd->Kd_Bidang, $skpd->Kd_Unit, 99, 1, 'Belanja Tidak Langsung'],
            ]);
        $sasaran = Yii::$app->db->createCommand()->batchInsert('ta_sasaran_skpd', [
                'ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran',  'Ur_Sasaran'
                ], [
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, $skpd->Kd_Urusan, $skpd->Kd_Bidang, $skpd->Kd_Unit, 98, 1, 1, 'Pendapatan Daerah'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, $skpd->Kd_Urusan, $skpd->Kd_Bidang, $skpd->Kd_Unit, 99, 1, 1, 'Belanja Tidak Langsung'],
            ]);
        $program = Yii::$app->db->createCommand()->batchInsert('ta_renstra', [
                'ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran',  'Kd_Prog', 'ID_Prog', 'Ket_Program', 'Kd_Urusan1', 'Kd_Bidang1', 'No_Misi1', 'No_Tujuan1', 'No_Sasaran1', 'Kd_Prog1', 'ID_Prog1'
                ], [
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 98, 1, 1, 1, '00', 'Pendapatan Asli Daerah', 0, 0, 98, 1, 1, 1, '00'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 98, 1, 1, 2, '00', 'Dana Perimbangan', 0, 0, 98, 1, 1, 2, '00'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 98, 1, 1, 3, '00', 'Lain-Lain PAD yang Sah', 0, 0, 98, 1, 1, 3, '00'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 1, '00', 'Belanja Pegawai', 0, 0, 99, 1, 1, 1, '00'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 2, '00', 'Belanja Bunga', 0, 0, 99, 1, 1, 2, '00'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 3, '00', 'Belanja Subsidi', 0, 0, 99, 1, 1, 3, '00'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 4, '00', 'Belanja Hibah', 0, 0, 99, 1, 1, 4, '00'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 5, '00', 'Belanja Bantuan Sosial', 0, 0, 99, 1, 1, 5, '00'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 6, '00', 'Belanja Bagi Hasil Kepada Provinsi/Kabupaten/Kota dan Pemerintah Desa', 0, 0, 99, 1, 1, 6, '00'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 7, '00', 'Belanja Bantuan Keuangan Kepada Provinsi/Kabupaten/Kota dan Pemerintahan Desa', 0, 0, 99, 1, 1, 7, '00'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 8, '00', 'Belanja Tidak Terduga', 0, 0, 99, 1, 1, 8, '00'],
            ]);
        $pagu = Yii::$app->db->createCommand()->batchInsert('ta_pagu_prog_renstra', [
                'ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran',  'Kd_Prog', 'ID_Prog', 'PaguTahun1', 'PaguTahun2', 'PaguTahun3', 'PaguTahun4', 'PaguTahun5', 'Satuan', 'Keterangan'
                ], [
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  98, 1, 1, 1, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  98, 1, 1, 2, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  98, 1, 1, 3, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 1, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 2, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 3, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 4, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 5, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 6, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 7, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, 1, 1, 1, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 8, '00', 0, 0, 0, 0, 0, 'Rp', '-'],
            ]);

        $kegiatan = Yii::$app->db->createCommand()->batchInsert('ta_kegiatan_skpd', [
                'ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran',  'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Ket_Kegiatan', 'Lokasi'
                ], [
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 98, 1, 1, 1, '00', 1, 'Pendapatan Asli Daerah', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 98, 1, 1, 2, '00', 1, 'Dana Perimbangan', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 98, 1, 1, 3, '00', 1, 'Lain-Lain PAD yang Sah', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 1, '00', 1, 'Belanja Pegawai', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 2, '00', 1, 'Belanja Bunga', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 3, '00', 1, 'Belanja Subsidi', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 4, '00', 1, 'Belanja Hibah', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 5, '00', 1, 'Belanja Bantuan Sosial', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 6, '00', 1, 'Belanja Bagi Hasil Kepada Provinsi/Kabupaten/Kota dan Pemerintah Desa', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 7, '00', 1, 'Belanja Bantuan Keuangan Kepada Provinsi/Kabupaten/Kota dan Pemerintahan Desa', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit, 99, 1, 1, 8, '00', 1, 'Belanja Tidak Terduga', '-'],
            ]);
        $pagukegiatan = Yii::$app->db->createCommand()->batchInsert('ta_pagu_kegiatan_skpd', [
                'ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota','Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran',  'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'PaguTahun1', 'PaguTahun2', 'PaguTahun3', 'PaguTahun4', 'PaguTahun5', 'Satuan', 'Keterangan'
                ], [
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  98, 1, 1, 1, '00', 1, 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  98, 1, 1, 2, '00', 1, 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  98, 1, 1, 3, '00', 1, 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 1, '00', 1, 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 2, '00', 1, 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 3, '00', 1, 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 4, '00', 1, 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 5, '00', 1, 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 6, '00', 1, 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 7, '00', 1, 0, 0, 0, 0, 0, 'Rp', '-'],
                [$ID_Tahun->ID_Tahun, $pemda->Kd_Prov, $pemda->Kd_Kab_Kota, Yii::$app->user->identity->tperan->kd_urusan, Yii::$app->user->identity->tperan->kd_bidang, Yii::$app->user->identity->tperan->kd_unit,  99, 1, 1, 8, '00', 1, 0, 0, 0, 0, 0, 'Rp', '-'],
            ]);

        $misi->execute(); $tujuan->execute(); $sasaran->execute();  $program->execute(); $pagu->execute(); $kegiatan->execute(); $pagukegiatan->execute();
            return $this->redirect(Yii::$app->request->referrer);  
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
        \common\models\TaMisiSKPD::findOne(['ID_Tahun' => $ID_Tahun->ID_Tahun, 'No_Misi' => 99, 'Kd_Urusan' => Yii::$app->user->identity->tperan->kd_urusan, 'Kd_Bidang' => Yii::$app->user->identity->tperan->kd_bidang, 'Kd_Unit' => Yii::$app->user->identity->tperan->kd_unit,])->delete();
        \common\models\TaMisiSKPD::findOne(['ID_Tahun' => $ID_Tahun->ID_Tahun, 'No_Misi' => 98,  'Kd_Urusan' => Yii::$app->user->identity->tperan->kd_urusan, 'Kd_Bidang' => Yii::$app->user->identity->tperan->kd_bidang, 'Kd_Unit' => Yii::$app->user->identity->tperan->kd_unit])->delete();
        \common\models\TaKegiatanSkpd::deleteAll(['ID_Tahun' => $ID_Tahun->ID_Tahun, 'No_Misi' => 98,  'Kd_Urusan' => Yii::$app->user->identity->tperan->kd_urusan, 'Kd_Bidang' => Yii::$app->user->identity->tperan->kd_bidang, 'Kd_Unit' => Yii::$app->user->identity->tperan->kd_unit]);
        \common\models\TaKegiatanSkpd::deleteAll(['ID_Tahun' => $ID_Tahun->ID_Tahun, 'No_Misi' => 99,  'Kd_Urusan' => Yii::$app->user->identity->tperan->kd_urusan, 'Kd_Bidang' => Yii::$app->user->identity->tperan->kd_bidang, 'Kd_Unit' => Yii::$app->user->identity->tperan->kd_unit]);
        

        //$this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi)->delete();

        return $this->redirect(Yii::$app->request->referrer);
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
                            var_dump($sasaran);
                            if (! ($flag = $sasaran->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->renderAjax('_tambah', [
            'tujuan' => $tujuan,
            'sasaran' => (empty($sasaran)) ? [new \common\models\TaSasaranSKPD()] : $sasaran
        ]);        
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
    public function actionUpdate($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog)
    {
        $model = \common\models\Renstra::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Perubahan' => $Kd_Perubahan, 'Kd_Dokumen' => $Kd_Dokumen, 'Kd_Usulan' => $Kd_Usulan, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran, 'Kd_Prog' => $Kd_Prog, 'ID_Prog' => $ID_Prog]);
        $pagu = \common\models\TaPaguProgRenstra::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Perubahan' => $Kd_Perubahan, 'Kd_Dokumen' => $Kd_Dokumen, 'Kd_Usulan' => $Kd_Usulan, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran, 'Kd_Prog' => $Kd_Prog, 'ID_Prog' => $ID_Prog]);
        $kegiatan = \common\models\TaKegiatanSkpd::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran, 'Kd_Prog' => $Kd_Prog, 'ID_Prog' => $ID_Prog, 'Kd_Keg' => 1]);
        $pagukegiatan = \common\models\TaPaguKegiatanSkpd::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran, 'Kd_Prog' => $Kd_Prog, 'ID_Prog' => $ID_Prog, 'Kd_Keg' => 1]);

        if ($model->load(Yii::$app->request->post()) && $pagu->load(Yii::$app->request->post())) {
            $kegiatan->Kd_Prog = $model->Kd_Prog;
            $pagukegiatan->Kd_Prog = $model->Kd_Prog;
            $kegiatan->Ket_Kegiatan = $model->Ket_Program;
            $pagukegiatan->PaguTahun1 = $pagu->PaguTahun1;
            $pagukegiatan->PaguTahun2 = $pagu->PaguTahun2;
            $pagukegiatan->PaguTahun3 = $pagu->PaguTahun3;
            $pagukegiatan->PaguTahun4 = $pagu->PaguTahun4;
            $pagukegiatan->PaguTahun5 = $pagu->PaguTahun5;
            $pagukegiatan->Satuan = $pagu->Satuan;
            IF($model->save() && $pagu->save() && $kegiatan->save() && $pagukegiatan->save()){
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

    public function actionPelaksana($id)
    {
        $model = new \common\models\TaPelaksanaProgRenstra();
        $kegiatan = new \common\models\TaPelaksanaKegSkpd();
        list($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog) = explode('.', $id);
        $program = $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog);
        if ($model->load(Yii::$app->request->post())) {

            //preinsert ----@hoaaah
            $model->ID_Tahun = $ID_Tahun;
            $model->Kd_Prov = $Kd_Prov;
            $model->Kd_Kab_Kota = $Kd_Kab_Kota;
            $model->Kd_Perubahan = $Kd_Perubahan;
            $model->Kd_Dokumen = $Kd_Dokumen;
            $model->Kd_Usulan = $Kd_Usulan;
            // $model->Kd_Urusan = $Kd_Urusan;
            // $model->Kd_Bidang = $Kd_Bidang;
            // $model->Kd_Unit = $Kd_Unit;
            $model->No_Misi = $No_Misi;
            $model->No_Tujuan = $No_Tujuan;
            $model->No_Sasaran = $No_Sasaran;
            $model->Kd_Prog = $Kd_Prog;
            $model->ID_Prog = $ID_Prog;
            $model->Nm_Sub = \common\models\Sub::find()->where([
                    'Kd_Urusan' => $model->Kd_Urusan,
                    'Kd_Bidang' => $model->Kd_Bidang,
                    'Kd_Unit' => $model->Kd_Unit,
                    'Kd_Sub' => $model->Kd_Sub,
                ])->select('Nm_Sub_Unit')->one()->Nm_Sub_Unit;
            $kegiatan->ID_Tahun = $ID_Tahun;
            $kegiatan->Kd_Prov = $Kd_Prov;
            $kegiatan->Kd_Kab_Kota = $Kd_Kab_Kota;
            $kegiatan->Kd_Urusan = $model->Kd_Urusan;
            $kegiatan->Kd_Bidang = $model->Kd_Bidang;
            $kegiatan->Kd_Unit = $model->Kd_Unit;
            $kegiatan->Kd_Sub = $model->Kd_Sub;
            $kegiatan->No_Misi = $No_Misi;
            $kegiatan->No_Tujuan = $No_Tujuan;
            $kegiatan->No_Sasaran = $No_Sasaran;
            $kegiatan->Kd_Prog = $Kd_Prog;
            $kegiatan->ID_Prog = $ID_Prog;
            $kegiatan->Kd_Keg = 1;
            $kegiatan->Nm_Sub = $model->Nm_Sub;
            IF($model->save() && $kegiatan->save()){
                echo 1;
            }ELSE{
                echo 0;
            }

        } else {
            return $this->renderAjax('_formpelaksana', [
                'model' => $model,
            ]);
        }
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


    public function actionBidang() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $urusan_id = $parents[0];
                $out = \common\models\Bidang::find()
                           ->where([
                            'Kd_Urusan'=>$urusan_id
                            ])
                           ->select(['Kd_Bidang AS id','Nm_Bidang AS name'])->asArray()->all();
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionUnit() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $urusan_id = empty($ids[0]) ? null : $ids[0];
            $bidang_id = empty($ids[1]) ? null : $ids[1];
            if ($urusan_id != null) {
               //$data = self::getProdList($cat_id, $subcat_id);
               $data = \common\models\Unit::find()
                           ->where([
                            'Kd_Urusan'=>$urusan_id,
                            'Kd_Bidang' => $bidang_id,
                            ])
                           ->select(['Kd_Unit AS id','Nm_Unit AS name'])->asArray()->all();
                /**
                 * the getProdList function will query the database based on the
                 * cat_id and sub_cat_id and return an array like below:
                 *  [
                 *      'out'=>[
                 *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
                 *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
                 *       ],
                 *       'selected'=>'<prod-id-1>'
                 *  ]
                 */
               
               echo Json::encode(['output'=>$data, 'selected'=>'']);
               return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }       

    public function actionSub() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $urusan_id = empty($ids[0]) ? null : $ids[0];
            $bidang_id = empty($ids[1]) ? null : $ids[1];
            $unit_id = empty($ids[2]) ? null : $ids[2];
            if ($urusan_id != null) {
               //$data = self::getProdList($cat_id, $subcat_id);
               $data = \common\models\Sub::find()
                           ->where([
                            'Kd_Urusan'=>$urusan_id,
                            'Kd_Bidang' => $bidang_id,
                            'Kd_Unit' => $unit_id
                            ])
                           ->select(['Kd_Sub AS id','Nm_Sub_Unit AS name'])->asArray()->all();
                /**
                 * the getProdList function will query the database based on the
                 * cat_id and sub_cat_id and return an array like below:
                 *  [
                 *      'out'=>[
                 *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
                 *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
                 *       ],
                 *       'selected'=>'<prod-id-1>'
                 *  ]
                 */
               
               echo Json::encode(['output'=>$data, 'selected'=>'']);
               return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
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
