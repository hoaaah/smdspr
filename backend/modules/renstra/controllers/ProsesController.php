<?php

namespace backend\modules\renstra\controllers;

use Yii;
use common\models\TaPeriode;
use backend\modules\rpjmd\models\TaPeriodeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProsesController implements the CRUD actions for TaPeriode model.
 */
class ProsesController extends Controller
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


    public function actionIndex()
    {
        $searchModel = new TaPeriodeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota),
        ]);
    }

    public function actionProses($kd, $periode, $n)
    {
        IF(!Yii::$app->user->identity->tperan->kd_sub){
            Yii::$app->getSession()->setFlash('danger','Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
            break;
        }
        $Kd_Urusan = Yii::$app->user->identity->tperan->kd_urusan;
        $Kd_Bidang = Yii::$app->user->identity->tperan->kd_bidang;
        $Kd_Unit = Yii::$app->user->identity->tperan->kd_unit;
        $Kd_Sub = Yii::$app->user->identity->tperan->kd_sub;
        $user_id = Yii::$app->user->identity->id;
        IF($kd == 1){
            $connection = \Yii::$app->db;
            $renjaprogram = "
                INSERT INTO t_renja_program
                    (tahun,
                     urusan_id,
                     bidang_id,
                     kd_urusan,
                     kd_bidang,
                     kd_unit,
                     kd_sub,
                     no_skpdMisi,
                     no_skpdTujuan,
                     no_skpdSasaran,
                     no_renjaSas,
                     no_renjaProg,
                     id_renprog,
                     uraian,
                     pagu_program,
                     created_at,
                     updated_at,
                     user_id,
                     input_phased,
                     STATUS,
                     status_phased,
                     id_tahun,
                     Kd_Perubahan_Renstra,
                     Kd_Dokumen_Renstra,
                     Kd_Usulan_Renstra,
                     Kd_Urusan_Renstra,
                     Kd_Bidang_Renstra,
                     Kd_Unit_Renstra,
                     No_Misi_Renstra,
                     No_Tujuan_Renstra,
                     No_Sasaran_Renstra,
                     Kd_Prog_Renstra,
                     ID_Prog_Renstra)
                SELECT
                d.Tahun$n,
                a.Kd_Urusan1,
                a.Kd_Bidang1,
                c.Kd_Urusan,
                c.Kd_Bidang,
                c.Kd_Unit,
                c.Kd_Sub,
                a.No_Misi,
                a.No_Tujuan,
                a.No_Sasaran,
                1 AS no_renjaSas,
                a.Kd_Prog,
                a.ID_Prog,
                a.Ket_Program,
                b.PaguTahun$n,
                TIMESTAMP(NOW()) AS created_at,
                TIMESTAMP(NOW()) AS updated_at,
                $user_id,
                1 AS input_phased,
                2 AS input_status,
                1 AS status_phased,
                a.ID_Tahun,
                a.Kd_Perubahan,
                a.Kd_Dokumen,
                a.Kd_Usulan,
                a.Kd_Urusan,
                a.Kd_Bidang,
                a.Kd_Unit,
                a.No_Misi,
                a.No_Tujuan,
                a.No_Sasaran,
                a.Kd_Prog,
                a.ID_Prog
                FROM
                ta_renstra a
                INNER JOIN ta_pagu_prog_renstra b ON a.ID_Tahun = b.ID_Tahun AND a.Kd_Prov = b.Kd_Prov AND a.Kd_Kab_Kota = b.Kd_Kab_Kota AND a.Kd_Perubahan = b.Kd_Perubahan AND a.Kd_Dokumen = b.Kd_Dokumen AND a.Kd_Usulan = b.Kd_Usulan AND a.Kd_Urusan = b.Kd_Urusan AND a.Kd_Bidang = b.Kd_Bidang AND a.Kd_Unit = b.Kd_Unit AND a.No_Misi = b.No_Misi AND a.No_Tujuan = b.No_Tujuan AND a.No_Sasaran = b.No_Sasaran AND a.Kd_Prog = b.Kd_Prog AND a.ID_Prog = b.ID_Prog
                INNER JOIN ta_pelaksana_prog_renstra c ON a.ID_Tahun = c.ID_Tahun AND a.Kd_Prov = c.Kd_Prov AND a.Kd_Kab_Kota = c.Kd_Kab_Kota AND a.Kd_Perubahan = c.Kd_Perubahan AND a.Kd_Dokumen = c.Kd_Dokumen AND a.Kd_Usulan = c.Kd_Usulan AND a.Kd_Urusan = c.Kd_Urusan AND a.Kd_Bidang = c.Kd_Bidang AND a.Kd_Unit = c.Kd_Unit AND a.No_Misi = c.No_Misi AND a.No_Tujuan = c.No_Tujuan AND a.No_Sasaran = c.No_Sasaran AND a.Kd_Prog = c.Kd_Prog AND a.ID_Prog = c.ID_Prog
                INNER JOIN ta_periode d ON a.ID_Tahun = d.ID_Tahun AND a.Kd_Prov = d.Kd_Prov AND a.Kd_Kab_Kota = d.Kd_Kab_Kota
                WHERE c.Kd_Urusan = $Kd_Urusan AND c.Kd_Bidang = $Kd_Bidang AND c.Kd_Unit = $Kd_Unit AND c.Kd_Sub = $Kd_Sub AND a.ID_Tahun = $periode
            ";
            $capaianprogram = "
                INSERT INTO t_renja_program_capaian
                    (tahun,
                     urusan_id,
                     bidang_id,
                     kd_urusan,
                     kd_bidang,
                     kd_unit,
                     kd_sub,
                     no_skpdMisi,
                     no_skpdTujuan,
                     no_skpdSasaran,
                     no_renjaSas,
                     no_renjaProg,
                     id_renprog,
                     no_indikator,
                     tolok_ukur,
                     target_angka,
                     target_uraian,
                     kd_indikator_2,
                     kd_indikator_3,
                     created_at,
                     updated_at,
                     user_id,
                     input_phased,
                     STATUS,
                     status_phased)
                SELECT
                d.Tahun$n,
                a.Kd_Urusan1,
                a.Kd_Bidang1,
                c.Kd_Urusan,
                c.Kd_Bidang,
                c.Kd_Unit,
                c.Kd_Sub,
                a.No_Misi,
                a.No_Tujuan,
                a.No_Sasaran,
                1 AS no_renjaSas,
                a.Kd_Prog,
                a.ID_Prog,
                b.No_Ind_Prog,
                b.Tolak_Ukur,
                b.NilaiTahun$n,
                b.Target_Uraian,
                b.Jn_Indikator,
                b.Jn_Indikator2,
                TIMESTAMP(NOW()) AS created_at,
                TIMESTAMP(NOW()) AS updated_at,
                $user_id,
                1 AS input_phased,
                2 AS input_status,
                1 AS status_phased
                FROM
                ta_renstra a
                INNER JOIN ta_indikator_prog_renstra b ON a.ID_Tahun = b.ID_Tahun AND a.Kd_Prov = b.Kd_Prov AND a.Kd_Kab_Kota = b.Kd_Kab_Kota AND a.Kd_Perubahan = b.Kd_Perubahan AND a.Kd_Dokumen = b.Kd_Dokumen AND a.Kd_Usulan = b.Kd_Usulan AND a.Kd_Urusan = b.Kd_Urusan AND a.Kd_Bidang = b.Kd_Bidang AND a.Kd_Unit = b.Kd_Unit AND a.No_Misi = b.No_Misi AND a.No_Tujuan = b.No_Tujuan AND a.No_Sasaran = b.No_Sasaran AND a.Kd_Prog = b.Kd_Prog AND a.ID_Prog = b.ID_Prog
                INNER JOIN ta_pelaksana_prog_renstra c ON a.ID_Tahun = c.ID_Tahun AND a.Kd_Prov = c.Kd_Prov AND a.Kd_Kab_Kota = c.Kd_Kab_Kota AND a.Kd_Perubahan = c.Kd_Perubahan AND a.Kd_Dokumen = c.Kd_Dokumen AND a.Kd_Usulan = c.Kd_Usulan AND a.Kd_Urusan = c.Kd_Urusan AND a.Kd_Bidang = c.Kd_Bidang AND a.Kd_Unit = c.Kd_Unit AND a.No_Misi = c.No_Misi AND a.No_Tujuan = c.No_Tujuan AND a.No_Sasaran = c.No_Sasaran AND a.Kd_Prog = c.Kd_Prog AND a.ID_Prog = c.ID_Prog
                INNER JOIN ta_periode d ON a.ID_Tahun = d.ID_Tahun AND a.Kd_Prov = d.Kd_Prov AND a.Kd_Kab_Kota = d.Kd_Kab_Kota
                WHERE c.Kd_Urusan = $Kd_Urusan AND c.Kd_Bidang = $Kd_Bidang AND c.Kd_Unit = $Kd_Unit AND a.ID_Tahun = $periode
            ";
            $renjakegiatan = "
                INSERT INTO t_renja_kegiatan
                    (tahun,
                     kd_urusan,
                     kd_bidang,
                     kd_unit,
                     kd_sub,
                     no_skpdMisi,
                     no_skpdTujuan,
                     no_skpdSasaran,
                     no_renjaSas,
                     no_renjaProg,
                     id_renprog,
                     id_renkeg,
                     uraian,
                     lokasi,
                     pagu_kegiatan,
                     created_at,
                     updated_at,
                     user_id,
                     input_phased,
                     STATUS,
                     status_phased)
                SELECT
                d.Tahun$n,
                c.Kd_Urusan,
                c.Kd_Bidang,
                c.Kd_Unit,
                c.Kd_Sub,
                a.No_Misi,
                a.No_Tujuan,
                a.No_Sasaran,
                1 AS no_renjaSas,
                a.Kd_Prog,
                a.ID_Prog,
                a.Kd_Keg,
                a.Ket_Kegiatan,
                a.Lokasi,
                b.PaguTahun$n,
                TIMESTAMP(NOW()) AS created_at,
                TIMESTAMP(NOW()) AS updated_at,
                $user_id,
                1 AS input_phased,
                2 AS input_status,
                1 AS status_phased
                FROM
                ta_kegiatan_skpd a
                INNER JOIN ta_pagu_kegiatan_skpd b ON a.ID_Tahun = b.ID_Tahun AND a.Kd_Prov = b.Kd_Prov AND a.Kd_Kab_Kota = b.Kd_Kab_Kota AND a.Kd_Urusan = b.Kd_Urusan AND a.Kd_Bidang = b.Kd_Bidang AND a.Kd_Unit = b.Kd_Unit AND a.No_Misi = b.No_Misi AND a.No_Tujuan = b.No_Tujuan AND a.No_Sasaran = b.No_Sasaran AND a.Kd_Prog = b.Kd_Prog AND a.ID_Prog = b.ID_Prog AND a.Kd_Keg = b.Kd_Keg
                INNER JOIN ta_pelaksana_keg_skpd c ON a.ID_Tahun = c.ID_Tahun AND a.Kd_Prov = c.Kd_Prov AND a.Kd_Kab_Kota = c.Kd_Kab_Kota AND a.Kd_Urusan = c.Kd_Urusan AND a.Kd_Bidang = c.Kd_Bidang AND a.Kd_Unit = c.Kd_Unit AND a.No_Misi = c.No_Misi AND a.No_Tujuan = c.No_Tujuan AND a.No_Sasaran = c.No_Sasaran AND a.Kd_Prog = c.Kd_Prog AND a.ID_Prog = c.ID_Prog  AND a.Kd_Keg = c.Kd_Keg
                INNER JOIN ta_periode d ON a.ID_Tahun = d.ID_Tahun AND a.Kd_Prov = d.Kd_Prov AND a.Kd_Kab_Kota = d.Kd_Kab_Kota
                WHERE c.Kd_Urusan = $Kd_Urusan AND c.Kd_Bidang = $Kd_Bidang AND c.Kd_Unit = $Kd_Unit AND a.ID_Tahun = $periode
            ";
            $capaiankegiatan = "
                INSERT INTO t_renja_kegiatan_capaian
                    (tahun,
                     kd_urusan,
                     kd_bidang,
                     kd_unit,
                     kd_sub,
                     no_skpdMisi,
                     no_skpdTujuan,
                     no_skpdSasaran,
                     no_renjaSas,
                     no_renjaProg,
                     id_renprog,
                     id_renkeg,
                     no_indikator,
                     tolok_ukur,
                     target_angka,
                     target_uraian,
                     kd_indikator_1,
                     kd_indikator_2,
                     kd_indikator_3,
                     keterangan,
                     created_at,
                     updated_at,
                     user_id,
                     input_phased,
                     STATUS,
                     status_phased)
                SELECT
                d.Tahun$n,
                c.Kd_Urusan,
                c.Kd_Bidang,
                c.Kd_Unit,
                c.Kd_Sub,
                a.No_Misi,
                a.No_Tujuan,
                a.No_Sasaran,
                1 AS no_renjaSas,
                a.Kd_Prog,
                a.ID_Prog,
                a.Kd_Keg,
                b.No_ID,
                b.Tolak_Ukur,
                b.NilaiTahun$n,
                b.Target_Uraian,
                b.Kd_Indikator_1,
                b.Kd_Indikator_2,
                b.Kd_Indikator_3,
                b.Keterangan,
                TIMESTAMP(NOW()) AS created_at,
                TIMESTAMP(NOW()) AS updated_at,
                $user_id,
                1 AS input_phased,
                2 AS input_status,
                1 AS status_phased
                FROM
                ta_kegiatan_skpd a
                INNER JOIN ta_indikator_kegiatan_skpd b ON a.ID_Tahun = b.ID_Tahun AND a.Kd_Prov = b.Kd_Prov AND a.Kd_Kab_Kota = b.Kd_Kab_Kota AND a.Kd_Urusan = b.Kd_Urusan AND a.Kd_Bidang = b.Kd_Bidang AND a.Kd_Unit = b.Kd_Unit AND a.No_Misi = b.No_Misi AND a.No_Tujuan = b.No_Tujuan AND a.No_Sasaran = b.No_Sasaran AND a.Kd_Prog = b.Kd_Prog AND a.ID_Prog = b.ID_Prog AND a.Kd_Keg = b.Kd_Keg
                INNER JOIN ta_pelaksana_keg_skpd c ON a.ID_Tahun = c.ID_Tahun AND a.Kd_Prov = c.Kd_Prov AND a.Kd_Kab_Kota = c.Kd_Kab_Kota AND a.Kd_Urusan = c.Kd_Urusan AND a.Kd_Bidang = c.Kd_Bidang AND a.Kd_Unit = c.Kd_Unit AND a.No_Misi = c.No_Misi AND a.No_Tujuan = c.No_Tujuan AND a.No_Sasaran = c.No_Sasaran AND a.Kd_Prog = c.Kd_Prog AND a.ID_Prog = c.ID_Prog  AND a.Kd_Keg = c.Kd_Keg
                INNER JOIN ta_periode d ON a.ID_Tahun = d.ID_Tahun AND a.Kd_Prov = d.Kd_Prov AND a.Kd_Kab_Kota = d.Kd_Kab_Kota
                WHERE c.Kd_Urusan = $Kd_Urusan AND c.Kd_Bidang = $Kd_Bidang AND c.Kd_Unit = $Kd_Unit AND a.ID_Tahun = $periode
            ";                        
            $connection->createCommand($renjaprogram)->execute();
            $connection->createCommand($capaianprogram)->execute();
            $connection->createCommand($renjakegiatan)->execute();
            $connection->createCommand($capaiankegiatan)->execute();
            return $this->redirect(Yii::$app->request->referrer);
        }ELSEIF($kd == 0){

            $tahun = TaPeriode::find()->select("Tahun$n")->where(['ID_Tahun' => $periode])->one();
            switch ($n) {
                case 1:
                    $tahun = $tahun->Tahun1;
                    break;
                case 2:
                    $tahun = $tahun->Tahun2;
                    break;
                case 3:
                    $tahun = $tahun->Tahun3;
                    break;
                case 4:
                    $tahun = $tahun->Tahun4;
                    break;
                case 5:
                    $tahun = $tahun->Tahun5;
                    break;
                default:
                    # code...
                    break;
            }
            \common\models\RenjaKegiatanCapaian::deleteAll(['tahun' => $tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub]);
            \common\models\RenjaKegiatan::deleteAll(['tahun' => $tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub]);
            \common\models\RenjaProgramCapaian::deleteAll(['tahun' => $tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub]);
            \common\models\RenjaProgram::deleteAll(['tahun' => $tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub]);
            return $this->redirect(Yii::$app->request->referrer);
        }ELSE{
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    /**
     * Finds the TaPeriode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @return TaPeriode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota)
    {
        if (($model = TaPeriode::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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
