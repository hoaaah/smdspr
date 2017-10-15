<?php

namespace backend\modules\rpjmd\controllers;

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
        IF($kd == 1){
            $connection = \Yii::$app->db;
            $rkpd = "
                INSERT INTO 
                t_rkpd_program
                    (tahun,
                     urusan_id,
                     bidang_id,
                     no_misi,
                     no_tujuan,
                     no_sasaran,
                     kd_progrkpd,
                     id_progrkpd,
                     uraian,
                     pagu_program,
                     created_at,
                     updated_at,
                     user_id,
                     input_phased,
                     STATUS,
                     status_phased,
                     id_tahun,
                     Kd_Perubahan_Rpjmd,
                     Kd_Dokumen_Rpjmd,
                     Kd_Usulan_Rpjmd,
                     No_Misi_Rpjmd,
                     No_Tujuan_Rpjmd,
                     No_Sasaran_Rpjmd,
                     Kd_Prog_Rpjmd,
                     ID_Prog_Rpjmd)
                SELECT
                c.Tahun$n,
                d.Kd_Urusan1,
                d.Kd_Bidang1,
                a.No_Misi,
                a.No_Tujuan,
                a.No_Sasaran,
                a.Kd_Prog,
                a.Id_Prog,
                a.Ket_Program,
                b.PaguTahun$n,
                TIMESTAMP(NOW()) AS created_at,
                TIMESTAMP(NOW()) AS updated_at,
                1 AS user_id,
                1 AS input_phased,
                2 AS STATUS,
                1 AS status_phased,
                a.ID_Tahun,
                a.Kd_Perubahan,
                a.Kd_Dokumen,
                a.Kd_Usulan, 
                a.No_Misi,
                a.No_Tujuan,
                a.No_Sasaran,
                a.Kd_Prog,
                a.Id_Prog
                FROM ta_program_rpjmd a 
                INNER JOIN ta_pagu_program_rpjmd b ON a.ID_Tahun = b.ID_Tahun AND a.Kd_Prov = b.Kd_Prov AND a.Kd_Kab_Kota = b.Kd_Kab_Kota AND a.Kd_Perubahan = b.Kd_Perubahan AND a.Kd_Dokumen = b.Kd_Dokumen AND a.Kd_Usulan = b.Kd_Usulan AND a.No_Misi = b.No_Misi AND a.No_Tujuan = b.No_Tujuan AND a.No_Sasaran = b.No_Sasaran AND a.Kd_Prog = b.Kd_Prog_rpjmd AND a.Id_Prog = b.Id_Prog_rpjmd
                INNER JOIN ta_program_urbid_rpjmd d ON a.ID_Tahun = d.ID_Tahun AND a.Kd_Prov = d.Kd_Prov AND a.Kd_Kab_Kota = d.Kd_Kab_Kota AND a.Kd_Perubahan = d.Kd_Perubahan AND a.Kd_Dokumen = d.Kd_Dokumen AND a.Kd_Usulan = d.Kd_Usulan AND a.No_Misi = d.No_Misi AND a.No_Tujuan = d.No_Tujuan AND a.No_Sasaran = d.No_Sasaran AND a.Kd_Prog = d.Kd_Prog AND a.Id_Prog = d.Id_Prog
                INNER JOIN ta_periode c ON a.ID_Tahun = c.ID_Tahun AND a.Kd_Prov = c.Kd_Prov AND a.Kd_Kab_Kota = c.Kd_Kab_Kota
                WHERE a.ID_Tahun = $periode
            ";
            $btl = "
                INSERT INTO 
                t_rkpd_program
                    (tahun,
                     urusan_id,
                     bidang_id,
                     no_misi,
                     no_tujuan,
                     no_sasaran,
                     kd_progrkpd,
                     id_progrkpd,
                     uraian,
                     pagu_program,
                     created_at,
                     updated_at,
                     user_id,
                     input_phased,
                     STATUS,
                     status_phased,
                     id_tahun,
                     Kd_Perubahan_Rpjmd,
                     Kd_Dokumen_Rpjmd,
                     Kd_Usulan_Rpjmd,
                     No_Misi_Rpjmd,
                     No_Tujuan_Rpjmd,
                     No_Sasaran_Rpjmd,
                     Kd_Prog_Rpjmd,
                     ID_Prog_Rpjmd)
                SELECT
                c.Tahun$n,
                a.Kd_Urusan1,
                a.Kd_Bidang1,
                a.No_Misi,
                a.No_Tujuan,
                a.No_Sasaran,
                a.Kd_Prog,
                a.Id_Prog,
                a.Ket_Program,
                b.PaguTahun$n,
                TIMESTAMP(NOW()) AS created_at,
                TIMESTAMP(NOW()) AS updated_at,
                1 AS user_id,
                1 AS input_phased,
                2 AS STATUS,
                1 AS status_phased,
                a.ID_Tahun,
                a.Kd_Perubahan,
                a.Kd_Dokumen,
                a.Kd_Usulan, 
                a.No_Misi,
                a.No_Tujuan,
                a.No_Sasaran,
                a.Kd_Prog,
                a.Id_Prog
                FROM ta_program_rpjmd a 
                INNER JOIN ta_pagu_program_rpjmd b ON a.ID_Tahun = b.ID_Tahun AND a.Kd_Prov = b.Kd_Prov AND a.Kd_Kab_Kota = b.Kd_Kab_Kota AND a.Kd_Perubahan = b.Kd_Perubahan AND a.Kd_Dokumen = b.Kd_Dokumen AND a.Kd_Usulan = b.Kd_Usulan AND a.No_Misi = b.No_Misi AND a.No_Tujuan = b.No_Tujuan AND a.No_Sasaran = b.No_Sasaran AND a.Kd_Prog = b.Kd_Prog_rpjmd AND a.Id_Prog = b.Id_Prog_rpjmd
                INNER JOIN ta_periode c ON a.ID_Tahun = c.ID_Tahun AND a.Kd_Prov = c.Kd_Prov AND a.Kd_Kab_Kota = c.Kd_Kab_Kota
                WHERE a.ID_Tahun = $periode AND a.No_Misi >= 98
            ";            
            $capaian = "
                INSERT INTO t_rkpd_program_capaian
                    (tahun,
                     urusan_id,
                     bidang_id,
                     no_misi,
                     no_tujuan,
                     no_sasaran,
                     kd_progrkpd,
                     id_progrkpd,
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

                c.Tahun$n,
                d.Kd_Urusan1,
                d.Kd_Bidang1,
                a.No_Misi,
                a.No_Tujuan,
                a.No_Sasaran,
                a.Kd_Prog,
                a.Id_Prog,
                b.No_ind_Prog,
                b.Tolak_Ukur,
                b.NilaiTahun$n,
                b.Target_Uraian,
                b.Jn_Indikator,
                b.Jn_Indikator2,
                /*uraian dan keterangan itu tidak perlu*/
                TIMESTAMP(NOW()) AS created_at,
                TIMESTAMP(NOW()) AS updated_at,
                1 AS user_id,
                1 AS input_phased,
                2 AS STATUS,
                1 AS status_phased
                FROM ta_program_rpjmd a 
                INNER JOIN ta_indikator_rpjmd b ON a.ID_Tahun = b.ID_Tahun AND a.Kd_Prov = b.Kd_Prov AND a.Kd_Kab_Kota = b.Kd_Kab_Kota AND a.Kd_Perubahan = b.Kd_Perubahan AND a.Kd_Dokumen = b.Kd_Dokumen AND a.Kd_Usulan = b.Kd_Usulan AND a.No_Misi = b.No_Misi AND a.No_Tujuan = b.No_Tujuan AND a.No_Sasaran = b.No_Sasaran AND a.Kd_Prog = b.Kd_Prog AND a.Id_Prog = b.Id_Prog
                INNER JOIN ta_program_urbid_rpjmd d ON a.ID_Tahun = d.ID_Tahun AND a.Kd_Prov = d.Kd_Prov AND a.Kd_Kab_Kota = d.Kd_Kab_Kota AND a.Kd_Perubahan = d.Kd_Perubahan AND a.Kd_Dokumen = d.Kd_Dokumen AND a.Kd_Usulan = d.Kd_Usulan AND a.No_Misi = d.No_Misi AND a.No_Tujuan = d.No_Tujuan AND a.No_Sasaran = d.No_Sasaran AND a.Kd_Prog = d.Kd_Prog AND a.Id_Prog = d.Id_Prog
                INNER JOIN ta_periode c ON a.ID_Tahun = c.ID_Tahun AND a.Kd_Prov = c.Kd_Prov AND a.Kd_Kab_Kota = c.Kd_Kab_Kota
                WHERE a.ID_Tahun = $periode
            ";
            $connection->createCommand($rkpd)->execute();
            $connection->createCommand($btl)->execute();
            $connection->createCommand($capaian)->execute();
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
            \common\models\RkpdProgramCapaian::deleteAll(['tahun' => $tahun]);
            \common\models\RkpdProgram::deleteAll(['tahun' => $tahun]);
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
