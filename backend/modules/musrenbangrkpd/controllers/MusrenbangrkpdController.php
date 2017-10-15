<?php

namespace backend\modules\musrenbangrkpd\controllers;

use Yii;
use yii\db\Query;
use yii\data\SqlDataProvider;
use common\models\Subkegiatan;
use common\models\SubkegiatanPhoto;
use common\models\RenjaKegiatan;
use common\models\TStatus;
use common\models\Historis;
use common\models\Jadwal;
use common\models\Proses;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/**
 * SubkegiatanController implements the CRUD actions for Subkegiatan model.
 */
class MusrenbangrkpdController extends Controller
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
                    'terima' => ['POST'],
                    'tangguh'=> ['POST'],
                    'draft'  => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        /*$searchModel = new \backend\modules\musrenbangrkpd\models\RkpdProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        */
        $tahun = (DATE('Y')+1);
        $totalCount = Yii::$app->db->createCommand('SELECT COUNT(id) FROM t_rkpd_program a WHERE tahun = :tahun')
                    ->bindValue(':tahun', $tahun)
                    ->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => '
                    SELECT
                        a.kd,
                        a.id,
                        a.tahun,
                        a.urusan_id,
                        a.bidang_id,
                        a.no_misi,
                        a.no_tujuan,
                        a.no_sasaran,
                        a.kd_progrkpd,
                        a.id_progrkpd,
                        a.uraian,
                        a.pagu_program,
                        b.pagu_program AS pagu_program_awal,
                        a.pagu_program_renja,
                        IFNULL(b.pagu_program_renja,0) AS pagu_program_renja_awal,
                        a.pagu_kegiatan_renja,
                        IFNULL(b.pagu_kegiatan_renja,0) AS pagu_kegiatan_renja_awal,
                        a.biaya,
                        IFNULL(b.biaya,0) AS biaya_awal
                    FROM
                        (
                            SELECT
                                a.kd,
                                a.id,
                                a.tahun,
                                a.urusan_id,
                                a.bidang_id,
                                a.no_misi,
                                a.no_tujuan,
                                a.no_sasaran,
                                a.kd_progrkpd,
                                a.id_progrkpd,
                                a.uraian,
                                a.pagu_program,
                                SUM(a.pagu_program_renja) AS pagu_program_renja,
                                SUM(a.pagu_kegiatan_renja) AS pagu_kegiatan_renja,
                                SUM(a.biaya) AS biaya
                            FROM
                                (
                                    SELECT
                                        CASE t_rkpd_program.no_misi
                                        WHEN 98 THEN 1
                                        WHEN 99 THEN 2
                                        ELSE 3
                                        END as kd,              
                                        t_rkpd_program.id,
                                        t_rkpd_program.tahun,
                                        t_rkpd_program.urusan_id,
                                        t_rkpd_program.bidang_id,
                                        t_rkpd_program.no_misi,
                                        t_rkpd_program.no_tujuan,
                                        t_rkpd_program.no_sasaran,
                                        t_rkpd_program.kd_progrkpd,
                                        t_rkpd_program.id_progrkpd,
                                        t_rkpd_program.uraian,
                                        IFNULL(
                                            t_rkpd_program.pagu_program,
                                            0
                                        ) AS pagu_program,
                                        0 AS pagu_program_renja,
                                        0 AS pagu_kegiatan_renja,
                                        SUM(
                                            IFNULL(t_subkegiatan.biaya, 0)
                                        ) AS biaya
                                    FROM
                                        t_rkpd_program
                                    LEFT JOIN ta_program_rpjmd ON t_rkpd_program.id_tahun = ta_program_rpjmd.ID_Tahun
                                    AND t_rkpd_program.Kd_Perubahan_Rpjmd = ta_program_rpjmd.Kd_Perubahan
                                    AND t_rkpd_program.Kd_Dokumen_Rpjmd = ta_program_rpjmd.Kd_Dokumen
                                    AND t_rkpd_program.Kd_Usulan_Rpjmd = ta_program_rpjmd.Kd_Usulan
                                    AND t_rkpd_program.No_Misi_Rpjmd = ta_program_rpjmd.No_Misi
                                    AND t_rkpd_program.No_Tujuan_Rpjmd = ta_program_rpjmd.No_Tujuan
                                    AND t_rkpd_program.No_Sasaran_Rpjmd = ta_program_rpjmd.No_Sasaran
                                    AND t_rkpd_program.Kd_Prog_Rpjmd = ta_program_rpjmd.Kd_Prog
                                    AND t_rkpd_program.ID_Prog_Rpjmd = ta_program_rpjmd.Id_Prog
                                    LEFT JOIN ta_renstra ON ta_program_rpjmd.No_Misi = ta_renstra.No_Misi1
                                    AND ta_program_rpjmd.No_Tujuan = ta_renstra.No_Tujuan1
                                    AND ta_program_rpjmd.No_Sasaran = ta_renstra.No_Sasaran1
                                    AND ta_program_rpjmd.Kd_Prog = ta_renstra.Kd_Prog1
                                    AND ta_program_rpjmd.Id_Prog = ta_renstra.ID_Prog1
                                    AND ta_program_rpjmd.ID_Tahun = ta_renstra.ID_Tahun
                                    AND ta_program_rpjmd.Kd_Prov = ta_renstra.Kd_Prov
                                    AND ta_program_rpjmd.Kd_Kab_Kota = ta_renstra.Kd_Kab_Kota
                                    LEFT JOIN t_renja_program ON t_renja_program.id_tahun = ta_renstra.ID_Tahun
                                    AND t_renja_program.Kd_Perubahan_Renstra = ta_renstra.Kd_Perubahan
                                    AND t_renja_program.Kd_Dokumen_Renstra = ta_renstra.Kd_Dokumen
                                    AND t_renja_program.Kd_Usulan_Renstra = ta_renstra.Kd_Usulan
                                    AND t_renja_program.Kd_Urusan_Renstra = ta_renstra.Kd_Urusan
                                    AND t_renja_program.Kd_Bidang_Renstra = ta_renstra.Kd_Bidang
                                    AND t_renja_program.Kd_Unit_Renstra = ta_renstra.Kd_Unit
                                    AND t_renja_program.No_Misi_Renstra = ta_renstra.No_Misi
                                    AND t_renja_program.No_Tujuan_Renstra = ta_renstra.No_Tujuan
                                    AND t_renja_program.No_Sasaran_Renstra = ta_renstra.No_Sasaran
                                    AND t_renja_program.Kd_Prog_Renstra = ta_renstra.Kd_Prog
                                    AND t_renja_program.ID_Prog_Renstra = ta_renstra.ID_Prog
                                    LEFT JOIN t_renja_kegiatan ON t_renja_kegiatan.tahun = t_renja_program.tahun
                                    AND t_renja_kegiatan.kd_urusan = t_renja_program.kd_urusan
                                    AND t_renja_kegiatan.kd_bidang = t_renja_program.kd_bidang
                                    AND t_renja_kegiatan.kd_unit = t_renja_program.kd_unit
                                    AND t_renja_kegiatan.kd_sub = t_renja_program.kd_sub
                                    AND t_renja_kegiatan.no_skpdMisi = t_renja_program.no_skpdMisi
                                    AND t_renja_kegiatan.no_skpdTujuan = t_renja_program.no_skpdTujuan
                                    AND t_renja_kegiatan.no_skpdSasaran = t_renja_program.no_skpdSasaran
                                    AND t_renja_kegiatan.no_renjaSas = t_renja_program.no_renjaSas
                                    AND t_renja_kegiatan.no_renjaProg = t_renja_program.no_renjaProg
                                    AND t_renja_kegiatan.id_renprog = t_renja_program.id_renprog
                                    LEFT JOIN t_subkegiatan ON t_subkegiatan.renja_kegiatan_id = t_renja_kegiatan.id
                                    WHERE
                                        t_rkpd_program.tahun = :tahun
                                    GROUP BY
                                        t_rkpd_program.id,
                                        t_rkpd_program.tahun,
                                        t_rkpd_program.urusan_id,
                                        t_rkpd_program.bidang_id,
                                        t_rkpd_program.no_misi,
                                        t_rkpd_program.no_tujuan,
                                        t_rkpd_program.no_sasaran,
                                        t_rkpd_program.kd_progrkpd,
                                        t_rkpd_program.id_progrkpd,
                                        t_rkpd_program.uraian,
                                        t_rkpd_program.pagu_program
                                    UNION ALL
                                        SELECT
                                            CASE t_rkpd_program.no_misi
                                            WHEN 98 THEN 1
                                            WHEN 99 THEN 2
                                            ELSE 3
                                            END AS kd,                                      
                                            t_rkpd_program.id,
                                            t_rkpd_program.tahun,
                                            t_rkpd_program.urusan_id,
                                            t_rkpd_program.bidang_id,
                                            t_rkpd_program.no_misi,
                                            t_rkpd_program.no_tujuan,
                                            t_rkpd_program.no_sasaran,
                                            t_rkpd_program.kd_progrkpd,
                                            t_rkpd_program.id_progrkpd,
                                            t_rkpd_program.uraian,
                                            0 AS pagu_program,
                                            SUM(
                                                IFNULL(
                                                    t_renja_program.pagu_program,
                                                    0
                                                )
                                            ) AS pagu_program_renja,
                                            0 AS pagu_kegiatan_renja,
                                            0 AS biaya
                                        FROM
                                            t_rkpd_program
                                        LEFT JOIN ta_program_rpjmd ON t_rkpd_program.id_tahun = ta_program_rpjmd.ID_Tahun
                                        AND t_rkpd_program.Kd_Perubahan_Rpjmd = ta_program_rpjmd.Kd_Perubahan
                                        AND t_rkpd_program.Kd_Dokumen_Rpjmd = ta_program_rpjmd.Kd_Dokumen
                                        AND t_rkpd_program.Kd_Usulan_Rpjmd = ta_program_rpjmd.Kd_Usulan
                                        AND t_rkpd_program.No_Misi_Rpjmd = ta_program_rpjmd.No_Misi
                                        AND t_rkpd_program.No_Tujuan_Rpjmd = ta_program_rpjmd.No_Tujuan
                                        AND t_rkpd_program.No_Sasaran_Rpjmd = ta_program_rpjmd.No_Sasaran
                                        AND t_rkpd_program.Kd_Prog_Rpjmd = ta_program_rpjmd.Kd_Prog
                                        AND t_rkpd_program.ID_Prog_Rpjmd = ta_program_rpjmd.Id_Prog
                                        LEFT JOIN ta_renstra ON ta_program_rpjmd.No_Misi = ta_renstra.No_Misi1
                                        AND ta_program_rpjmd.No_Tujuan = ta_renstra.No_Tujuan1
                                        AND ta_program_rpjmd.No_Sasaran = ta_renstra.No_Sasaran1
                                        AND ta_program_rpjmd.Kd_Prog = ta_renstra.Kd_Prog1
                                        AND ta_program_rpjmd.Id_Prog = ta_renstra.ID_Prog1
                                        AND ta_program_rpjmd.ID_Tahun = ta_renstra.ID_Tahun
                                        AND ta_program_rpjmd.Kd_Prov = ta_renstra.Kd_Prov
                                        AND ta_program_rpjmd.Kd_Kab_Kota = ta_renstra.Kd_Kab_Kota
                                        LEFT JOIN t_renja_program ON t_renja_program.id_tahun = ta_renstra.ID_Tahun
                                        AND t_renja_program.Kd_Perubahan_Renstra = ta_renstra.Kd_Perubahan
                                        AND t_renja_program.Kd_Dokumen_Renstra = ta_renstra.Kd_Dokumen
                                        AND t_renja_program.Kd_Usulan_Renstra = ta_renstra.Kd_Usulan
                                        AND t_renja_program.Kd_Urusan_Renstra = ta_renstra.Kd_Urusan
                                        AND t_renja_program.Kd_Bidang_Renstra = ta_renstra.Kd_Bidang
                                        AND t_renja_program.Kd_Unit_Renstra = ta_renstra.Kd_Unit
                                        AND t_renja_program.No_Misi_Renstra = ta_renstra.No_Misi
                                        AND t_renja_program.No_Tujuan_Renstra = ta_renstra.No_Tujuan
                                        AND t_renja_program.No_Sasaran_Renstra = ta_renstra.No_Sasaran
                                        AND t_renja_program.Kd_Prog_Renstra = ta_renstra.Kd_Prog
                                        AND t_renja_program.ID_Prog_Renstra = ta_renstra.ID_Prog
                                        WHERE
                                            t_rkpd_program.tahun = :tahun
                                        GROUP BY
                                            t_rkpd_program.id,
                                            t_rkpd_program.tahun,
                                            t_rkpd_program.urusan_id,
                                            t_rkpd_program.bidang_id,
                                            t_rkpd_program.no_misi,
                                            t_rkpd_program.no_tujuan,
                                            t_rkpd_program.no_sasaran,
                                            t_rkpd_program.kd_progrkpd,
                                            t_rkpd_program.id_progrkpd,
                                            t_rkpd_program.uraian,
                                            t_rkpd_program.pagu_program
                                        UNION ALL
                                            SELECT
                                                CASE t_rkpd_program.no_misi
                                                WHEN 98 THEN 1
                                                WHEN 99 THEN 2
                                                ELSE 3
                                                END AS kd,
                                                t_rkpd_program.id,
                                                t_rkpd_program.tahun,
                                                t_rkpd_program.urusan_id,
                                                t_rkpd_program.bidang_id,
                                                t_rkpd_program.no_misi,
                                                t_rkpd_program.no_tujuan,
                                                t_rkpd_program.no_sasaran,
                                                t_rkpd_program.kd_progrkpd,
                                                t_rkpd_program.id_progrkpd,
                                                t_rkpd_program.uraian,
                                                0 AS pagu_program,
                                                0 AS pagu_program_renja,
                                                SUM(
                                                    IFNULL(
                                                        t_renja_kegiatan.pagu_kegiatan,
                                                        0
                                                    )
                                                ) AS pagu_kegiatan_renja,
                                                0 AS biaya
                                            FROM
                                                t_rkpd_program
                                            LEFT JOIN ta_program_rpjmd ON t_rkpd_program.id_tahun = ta_program_rpjmd.ID_Tahun
                                            AND t_rkpd_program.Kd_Perubahan_Rpjmd = ta_program_rpjmd.Kd_Perubahan
                                            AND t_rkpd_program.Kd_Dokumen_Rpjmd = ta_program_rpjmd.Kd_Dokumen
                                            AND t_rkpd_program.Kd_Usulan_Rpjmd = ta_program_rpjmd.Kd_Usulan
                                            AND t_rkpd_program.No_Misi_Rpjmd = ta_program_rpjmd.No_Misi
                                            AND t_rkpd_program.No_Tujuan_Rpjmd = ta_program_rpjmd.No_Tujuan
                                            AND t_rkpd_program.No_Sasaran_Rpjmd = ta_program_rpjmd.No_Sasaran
                                            AND t_rkpd_program.Kd_Prog_Rpjmd = ta_program_rpjmd.Kd_Prog
                                            AND t_rkpd_program.ID_Prog_Rpjmd = ta_program_rpjmd.Id_Prog
                                            LEFT JOIN ta_renstra ON ta_program_rpjmd.No_Misi = ta_renstra.No_Misi1
                                            AND ta_program_rpjmd.No_Tujuan = ta_renstra.No_Tujuan1
                                            AND ta_program_rpjmd.No_Sasaran = ta_renstra.No_Sasaran1
                                            AND ta_program_rpjmd.Kd_Prog = ta_renstra.Kd_Prog1
                                            AND ta_program_rpjmd.Id_Prog = ta_renstra.ID_Prog1
                                            AND ta_program_rpjmd.ID_Tahun = ta_renstra.ID_Tahun
                                            AND ta_program_rpjmd.Kd_Prov = ta_renstra.Kd_Prov
                                            AND ta_program_rpjmd.Kd_Kab_Kota = ta_renstra.Kd_Kab_Kota
                                            LEFT JOIN t_renja_program ON t_renja_program.id_tahun = ta_renstra.ID_Tahun
                                            AND t_renja_program.Kd_Perubahan_Renstra = ta_renstra.Kd_Perubahan
                                            AND t_renja_program.Kd_Dokumen_Renstra = ta_renstra.Kd_Dokumen
                                            AND t_renja_program.Kd_Usulan_Renstra = ta_renstra.Kd_Usulan
                                            AND t_renja_program.Kd_Urusan_Renstra = ta_renstra.Kd_Urusan
                                            AND t_renja_program.Kd_Bidang_Renstra = ta_renstra.Kd_Bidang
                                            AND t_renja_program.Kd_Unit_Renstra = ta_renstra.Kd_Unit
                                            AND t_renja_program.No_Misi_Renstra = ta_renstra.No_Misi
                                            AND t_renja_program.No_Tujuan_Renstra = ta_renstra.No_Tujuan
                                            AND t_renja_program.No_Sasaran_Renstra = ta_renstra.No_Sasaran
                                            AND t_renja_program.Kd_Prog_Renstra = ta_renstra.Kd_Prog
                                            AND t_renja_program.ID_Prog_Renstra = ta_renstra.ID_Prog
                                            LEFT JOIN t_renja_kegiatan ON t_renja_kegiatan.tahun = t_renja_program.tahun
                                            AND t_renja_kegiatan.kd_urusan = t_renja_program.kd_urusan
                                            AND t_renja_kegiatan.kd_bidang = t_renja_program.kd_bidang
                                            AND t_renja_kegiatan.kd_unit = t_renja_program.kd_unit
                                            AND t_renja_kegiatan.kd_sub = t_renja_program.kd_sub
                                            AND t_renja_kegiatan.no_skpdMisi = t_renja_program.no_skpdMisi
                                            AND t_renja_kegiatan.no_skpdTujuan = t_renja_program.no_skpdTujuan
                                            AND t_renja_kegiatan.no_skpdSasaran = t_renja_program.no_skpdSasaran
                                            AND t_renja_kegiatan.no_renjaSas = t_renja_program.no_renjaSas
                                            AND t_renja_kegiatan.no_renjaProg = t_renja_program.no_renjaProg
                                            AND t_renja_kegiatan.id_renprog = t_renja_program.id_renprog
                                            WHERE
                                                t_rkpd_program.tahun = :tahun
                                            GROUP BY
                                                t_rkpd_program.id,
                                                t_rkpd_program.tahun,
                                                t_rkpd_program.urusan_id,
                                                t_rkpd_program.bidang_id,
                                                t_rkpd_program.no_misi,
                                                t_rkpd_program.no_tujuan,
                                                t_rkpd_program.no_sasaran,
                                                t_rkpd_program.kd_progrkpd,
                                                t_rkpd_program.id_progrkpd,
                                                t_rkpd_program.uraian,
                                                t_rkpd_program.pagu_program
                                ) a
                            GROUP BY
                                a.id,
                                a.tahun,
                                a.urusan_id,
                                a.bidang_id,
                                a.no_misi,
                                a.no_tujuan,
                                a.no_sasaran,
                                a.kd_progrkpd,
                                a.id_progrkpd,
                                a.uraian
                        ) a
                    LEFT JOIN (
                        SELECT
                            a.kd,
                            a.id,
                            a.tahun,
                            a.urusan_id,
                            a.bidang_id,
                            a.no_misi,
                            a.no_tujuan,
                            a.no_sasaran,
                            a.kd_progrkpd,
                            a.id_progrkpd,
                            a.uraian,
                            a.pagu_program,
                            SUM(a.pagu_program_renja) AS pagu_program_renja,
                            SUM(a.pagu_kegiatan_renja) AS pagu_kegiatan_renja,
                            SUM(a.biaya) AS biaya
                        FROM
                            (
                                SELECT
                                    CASE t_ba_rkpd_program.no_misi
                                    WHEN 98 THEN 1
                                    WHEN 99 THEN 2
                                    ELSE 3
                                    END AS kd,          
                                    t_ba_rkpd_program.id,
                                    t_ba_rkpd_program.tahun,
                                    t_ba_rkpd_program.urusan_id,
                                    t_ba_rkpd_program.bidang_id,
                                    t_ba_rkpd_program.no_misi,
                                    t_ba_rkpd_program.no_tujuan,
                                    t_ba_rkpd_program.no_sasaran,
                                    t_ba_rkpd_program.kd_progrkpd,
                                    t_ba_rkpd_program.id_progrkpd,
                                    t_ba_rkpd_program.uraian,
                                    IFNULL(
                                        t_ba_rkpd_program.pagu_program,
                                        0
                                    ) AS pagu_program,
                                    0 AS pagu_program_renja,
                                    0 AS pagu_kegiatan_renja,
                                    SUM(
                                        IFNULL(t_ba_subkegiatan.biaya, 0)
                                    ) AS biaya
                                FROM
                                    t_ba_rkpd_program
                                LEFT JOIN ta_program_rpjmd ON t_ba_rkpd_program.id_tahun = ta_program_rpjmd.ID_Tahun
                                AND t_ba_rkpd_program.Kd_Perubahan_Rpjmd = ta_program_rpjmd.Kd_Perubahan
                                AND t_ba_rkpd_program.Kd_Dokumen_Rpjmd = ta_program_rpjmd.Kd_Dokumen
                                AND t_ba_rkpd_program.Kd_Usulan_Rpjmd = ta_program_rpjmd.Kd_Usulan
                                AND t_ba_rkpd_program.No_Misi_Rpjmd = ta_program_rpjmd.No_Misi
                                AND t_ba_rkpd_program.No_Tujuan_Rpjmd = ta_program_rpjmd.No_Tujuan
                                AND t_ba_rkpd_program.No_Sasaran_Rpjmd = ta_program_rpjmd.No_Sasaran
                                AND t_ba_rkpd_program.Kd_Prog_Rpjmd = ta_program_rpjmd.Kd_Prog
                                AND t_ba_rkpd_program.ID_Prog_Rpjmd = ta_program_rpjmd.Id_Prog
                                LEFT JOIN ta_renstra ON ta_program_rpjmd.No_Misi = ta_renstra.No_Misi1
                                AND ta_program_rpjmd.No_Tujuan = ta_renstra.No_Tujuan1
                                AND ta_program_rpjmd.No_Sasaran = ta_renstra.No_Sasaran1
                                AND ta_program_rpjmd.Kd_Prog = ta_renstra.Kd_Prog1
                                AND ta_program_rpjmd.Id_Prog = ta_renstra.ID_Prog1
                                AND ta_program_rpjmd.ID_Tahun = ta_renstra.ID_Tahun
                                AND ta_program_rpjmd.Kd_Prov = ta_renstra.Kd_Prov
                                AND ta_program_rpjmd.Kd_Kab_Kota = ta_renstra.Kd_Kab_Kota
                                LEFT JOIN t_ba_renja_program ON t_ba_renja_program.id_tahun = ta_renstra.ID_Tahun
                                AND t_ba_renja_program.Kd_Perubahan_Renstra = ta_renstra.Kd_Perubahan
                                AND t_ba_renja_program.Kd_Dokumen_Renstra = ta_renstra.Kd_Dokumen
                                AND t_ba_renja_program.Kd_Usulan_Renstra = ta_renstra.Kd_Usulan
                                AND t_ba_renja_program.Kd_Urusan_Renstra = ta_renstra.Kd_Urusan
                                AND t_ba_renja_program.Kd_Bidang_Renstra = ta_renstra.Kd_Bidang
                                AND t_ba_renja_program.Kd_Unit_Renstra = ta_renstra.Kd_Unit
                                AND t_ba_renja_program.No_Misi_Renstra = ta_renstra.No_Misi
                                AND t_ba_renja_program.No_Tujuan_Renstra = ta_renstra.No_Tujuan
                                AND t_ba_renja_program.No_Sasaran_Renstra = ta_renstra.No_Sasaran
                                AND t_ba_renja_program.Kd_Prog_Renstra = ta_renstra.Kd_Prog
                                AND t_ba_renja_program.ID_Prog_Renstra = ta_renstra.ID_Prog
                                LEFT JOIN t_ba_renja_kegiatan ON t_ba_renja_kegiatan.tahun = t_ba_renja_program.tahun
                                AND t_ba_renja_kegiatan.kd_urusan = t_ba_renja_program.kd_urusan
                                AND t_ba_renja_kegiatan.kd_bidang = t_ba_renja_program.kd_bidang
                                AND t_ba_renja_kegiatan.kd_unit = t_ba_renja_program.kd_unit
                                AND t_ba_renja_kegiatan.kd_sub = t_ba_renja_program.kd_sub
                                AND t_ba_renja_kegiatan.no_skpdMisi = t_ba_renja_program.no_skpdMisi
                                AND t_ba_renja_kegiatan.no_skpdTujuan = t_ba_renja_program.no_skpdTujuan
                                AND t_ba_renja_kegiatan.no_skpdSasaran = t_ba_renja_program.no_skpdSasaran
                                AND t_ba_renja_kegiatan.no_renjaSas = t_ba_renja_program.no_renjaSas
                                AND t_ba_renja_kegiatan.no_renjaProg = t_ba_renja_program.no_renjaProg
                                AND t_ba_renja_kegiatan.id_renprog = t_ba_renja_program.id_renprog
                                LEFT JOIN t_ba_subkegiatan ON t_ba_subkegiatan.renja_kegiatan_id = t_ba_renja_kegiatan.id
                                WHERE
                                    t_ba_rkpd_program.tahun = :tahun
                                    AND t_ba_rkpd_program.status_phased = 5
                                    AND t_ba_renja_program.status_phased = 5
                                    AND t_ba_renja_kegiatan.status_phased = 5
                                    AND t_ba_subkegiatan.status_phased = 5
                                GROUP BY
                                    t_ba_rkpd_program.id,
                                    t_ba_rkpd_program.tahun,
                                    t_ba_rkpd_program.urusan_id,
                                    t_ba_rkpd_program.bidang_id,
                                    t_ba_rkpd_program.no_misi,
                                    t_ba_rkpd_program.no_tujuan,
                                    t_ba_rkpd_program.no_sasaran,
                                    t_ba_rkpd_program.kd_progrkpd,
                                    t_ba_rkpd_program.id_progrkpd,
                                    t_ba_rkpd_program.uraian,
                                    t_ba_rkpd_program.pagu_program
                                UNION ALL
                                    SELECT
                                        CASE t_ba_rkpd_program.no_misi
                                        WHEN 98 THEN 1
                                        WHEN 99 THEN 2
                                        ELSE 3
                                        END AS kd,              
                                        t_ba_rkpd_program.id,
                                        t_ba_rkpd_program.tahun,
                                        t_ba_rkpd_program.urusan_id,
                                        t_ba_rkpd_program.bidang_id,
                                        t_ba_rkpd_program.no_misi,
                                        t_ba_rkpd_program.no_tujuan,
                                        t_ba_rkpd_program.no_sasaran,
                                        t_ba_rkpd_program.kd_progrkpd,
                                        t_ba_rkpd_program.id_progrkpd,
                                        t_ba_rkpd_program.uraian,
                                        0 AS pagu_program,
                                        SUM(
                                            IFNULL(
                                                t_ba_renja_program.pagu_program,
                                                0
                                            )
                                        ) AS pagu_program_renja,
                                        0 AS pagu_kegiatan_renja,
                                        0 AS biaya
                                    FROM
                                        t_ba_rkpd_program
                                    LEFT JOIN ta_program_rpjmd ON t_ba_rkpd_program.id_tahun = ta_program_rpjmd.ID_Tahun
                                    AND t_ba_rkpd_program.Kd_Perubahan_Rpjmd = ta_program_rpjmd.Kd_Perubahan
                                    AND t_ba_rkpd_program.Kd_Dokumen_Rpjmd = ta_program_rpjmd.Kd_Dokumen
                                    AND t_ba_rkpd_program.Kd_Usulan_Rpjmd = ta_program_rpjmd.Kd_Usulan
                                    AND t_ba_rkpd_program.No_Misi_Rpjmd = ta_program_rpjmd.No_Misi
                                    AND t_ba_rkpd_program.No_Tujuan_Rpjmd = ta_program_rpjmd.No_Tujuan
                                    AND t_ba_rkpd_program.No_Sasaran_Rpjmd = ta_program_rpjmd.No_Sasaran
                                    AND t_ba_rkpd_program.Kd_Prog_Rpjmd = ta_program_rpjmd.Kd_Prog
                                    AND t_ba_rkpd_program.ID_Prog_Rpjmd = ta_program_rpjmd.Id_Prog
                                    LEFT JOIN ta_renstra ON ta_program_rpjmd.No_Misi = ta_renstra.No_Misi1
                                    AND ta_program_rpjmd.No_Tujuan = ta_renstra.No_Tujuan1
                                    AND ta_program_rpjmd.No_Sasaran = ta_renstra.No_Sasaran1
                                    AND ta_program_rpjmd.Kd_Prog = ta_renstra.Kd_Prog1
                                    AND ta_program_rpjmd.Id_Prog = ta_renstra.ID_Prog1
                                    AND ta_program_rpjmd.ID_Tahun = ta_renstra.ID_Tahun
                                    AND ta_program_rpjmd.Kd_Prov = ta_renstra.Kd_Prov
                                    AND ta_program_rpjmd.Kd_Kab_Kota = ta_renstra.Kd_Kab_Kota
                                    LEFT JOIN t_ba_renja_program ON t_ba_renja_program.id_tahun = ta_renstra.ID_Tahun
                                    AND t_ba_renja_program.Kd_Perubahan_Renstra = ta_renstra.Kd_Perubahan
                                    AND t_ba_renja_program.Kd_Dokumen_Renstra = ta_renstra.Kd_Dokumen
                                    AND t_ba_renja_program.Kd_Usulan_Renstra = ta_renstra.Kd_Usulan
                                    AND t_ba_renja_program.Kd_Urusan_Renstra = ta_renstra.Kd_Urusan
                                    AND t_ba_renja_program.Kd_Bidang_Renstra = ta_renstra.Kd_Bidang
                                    AND t_ba_renja_program.Kd_Unit_Renstra = ta_renstra.Kd_Unit
                                    AND t_ba_renja_program.No_Misi_Renstra = ta_renstra.No_Misi
                                    AND t_ba_renja_program.No_Tujuan_Renstra = ta_renstra.No_Tujuan
                                    AND t_ba_renja_program.No_Sasaran_Renstra = ta_renstra.No_Sasaran
                                    AND t_ba_renja_program.Kd_Prog_Renstra = ta_renstra.Kd_Prog
                                    AND t_ba_renja_program.ID_Prog_Renstra = ta_renstra.ID_Prog
                                    WHERE
                                        t_ba_rkpd_program.tahun = :tahun
                                        AND t_ba_rkpd_program.status_phased = 5
                                        AND t_ba_renja_program.status_phased = 5
                                    GROUP BY
                                        t_ba_rkpd_program.id,
                                        t_ba_rkpd_program.tahun,
                                        t_ba_rkpd_program.urusan_id,
                                        t_ba_rkpd_program.bidang_id,
                                        t_ba_rkpd_program.no_misi,
                                        t_ba_rkpd_program.no_tujuan,
                                        t_ba_rkpd_program.no_sasaran,
                                        t_ba_rkpd_program.kd_progrkpd,
                                        t_ba_rkpd_program.id_progrkpd,
                                        t_ba_rkpd_program.uraian,
                                        t_ba_rkpd_program.pagu_program
                                    UNION ALL
                                        SELECT
                                            CASE t_ba_rkpd_program.no_misi
                                            WHEN 98 THEN 1
                                            WHEN 99 THEN 2
                                            ELSE 3
                                            END AS kd,                                                          
                                            t_ba_rkpd_program.id,
                                            t_ba_rkpd_program.tahun,
                                            t_ba_rkpd_program.urusan_id,
                                            t_ba_rkpd_program.bidang_id,
                                            t_ba_rkpd_program.no_misi,
                                            t_ba_rkpd_program.no_tujuan,
                                            t_ba_rkpd_program.no_sasaran,
                                            t_ba_rkpd_program.kd_progrkpd,
                                            t_ba_rkpd_program.id_progrkpd,
                                            t_ba_rkpd_program.uraian,
                                            0 AS pagu_program,
                                            0 AS pagu_program_renja,
                                            SUM(
                                                IFNULL(
                                                    t_ba_renja_kegiatan.pagu_kegiatan,
                                                    0
                                                )
                                            ) AS pagu_kegiatan_renja,
                                            0 AS biaya
                                        FROM
                                            t_ba_rkpd_program
                                        LEFT JOIN ta_program_rpjmd ON t_ba_rkpd_program.id_tahun = ta_program_rpjmd.ID_Tahun
                                        AND t_ba_rkpd_program.Kd_Perubahan_Rpjmd = ta_program_rpjmd.Kd_Perubahan
                                        AND t_ba_rkpd_program.Kd_Dokumen_Rpjmd = ta_program_rpjmd.Kd_Dokumen
                                        AND t_ba_rkpd_program.Kd_Usulan_Rpjmd = ta_program_rpjmd.Kd_Usulan
                                        AND t_ba_rkpd_program.No_Misi_Rpjmd = ta_program_rpjmd.No_Misi
                                        AND t_ba_rkpd_program.No_Tujuan_Rpjmd = ta_program_rpjmd.No_Tujuan
                                        AND t_ba_rkpd_program.No_Sasaran_Rpjmd = ta_program_rpjmd.No_Sasaran
                                        AND t_ba_rkpd_program.Kd_Prog_Rpjmd = ta_program_rpjmd.Kd_Prog
                                        AND t_ba_rkpd_program.ID_Prog_Rpjmd = ta_program_rpjmd.Id_Prog
                                        LEFT JOIN ta_renstra ON ta_program_rpjmd.No_Misi = ta_renstra.No_Misi1
                                        AND ta_program_rpjmd.No_Tujuan = ta_renstra.No_Tujuan1
                                        AND ta_program_rpjmd.No_Sasaran = ta_renstra.No_Sasaran1
                                        AND ta_program_rpjmd.Kd_Prog = ta_renstra.Kd_Prog1
                                        AND ta_program_rpjmd.Id_Prog = ta_renstra.ID_Prog1
                                        AND ta_program_rpjmd.ID_Tahun = ta_renstra.ID_Tahun
                                        AND ta_program_rpjmd.Kd_Prov = ta_renstra.Kd_Prov
                                        AND ta_program_rpjmd.Kd_Kab_Kota = ta_renstra.Kd_Kab_Kota
                                        LEFT JOIN t_ba_renja_program ON t_ba_renja_program.id_tahun = ta_renstra.ID_Tahun
                                        AND t_ba_renja_program.Kd_Perubahan_Renstra = ta_renstra.Kd_Perubahan
                                        AND t_ba_renja_program.Kd_Dokumen_Renstra = ta_renstra.Kd_Dokumen
                                        AND t_ba_renja_program.Kd_Usulan_Renstra = ta_renstra.Kd_Usulan
                                        AND t_ba_renja_program.Kd_Urusan_Renstra = ta_renstra.Kd_Urusan
                                        AND t_ba_renja_program.Kd_Bidang_Renstra = ta_renstra.Kd_Bidang
                                        AND t_ba_renja_program.Kd_Unit_Renstra = ta_renstra.Kd_Unit
                                        AND t_ba_renja_program.No_Misi_Renstra = ta_renstra.No_Misi
                                        AND t_ba_renja_program.No_Tujuan_Renstra = ta_renstra.No_Tujuan
                                        AND t_ba_renja_program.No_Sasaran_Renstra = ta_renstra.No_Sasaran
                                        AND t_ba_renja_program.Kd_Prog_Renstra = ta_renstra.Kd_Prog
                                        AND t_ba_renja_program.ID_Prog_Renstra = ta_renstra.ID_Prog
                                        LEFT JOIN t_ba_renja_kegiatan ON t_ba_renja_kegiatan.tahun = t_ba_renja_program.tahun
                                        AND t_ba_renja_kegiatan.kd_urusan = t_ba_renja_program.kd_urusan
                                        AND t_ba_renja_kegiatan.kd_bidang = t_ba_renja_program.kd_bidang
                                        AND t_ba_renja_kegiatan.kd_unit = t_ba_renja_program.kd_unit
                                        AND t_ba_renja_kegiatan.kd_sub = t_ba_renja_program.kd_sub
                                        AND t_ba_renja_kegiatan.no_skpdMisi = t_ba_renja_program.no_skpdMisi
                                        AND t_ba_renja_kegiatan.no_skpdTujuan = t_ba_renja_program.no_skpdTujuan
                                        AND t_ba_renja_kegiatan.no_skpdSasaran = t_ba_renja_program.no_skpdSasaran
                                        AND t_ba_renja_kegiatan.no_renjaSas = t_ba_renja_program.no_renjaSas
                                        AND t_ba_renja_kegiatan.no_renjaProg = t_ba_renja_program.no_renjaProg
                                        AND t_ba_renja_kegiatan.id_renprog = t_ba_renja_program.id_renprog
                                        WHERE
                                            t_ba_rkpd_program.tahun = :tahun
                                            AND t_ba_rkpd_program.status_phased = 5
                                            AND t_ba_renja_program.status_phased = 5
                                            AND t_ba_renja_kegiatan.status_phased = 5
                                        GROUP BY
                                            t_ba_rkpd_program.id,
                                            t_ba_rkpd_program.tahun,
                                            t_ba_rkpd_program.urusan_id,
                                            t_ba_rkpd_program.bidang_id,
                                            t_ba_rkpd_program.no_misi,
                                            t_ba_rkpd_program.no_tujuan,
                                            t_ba_rkpd_program.no_sasaran,
                                            t_ba_rkpd_program.kd_progrkpd,
                                            t_ba_rkpd_program.id_progrkpd,
                                            t_ba_rkpd_program.uraian,
                                            t_ba_rkpd_program.pagu_program
                            ) a
                        GROUP BY
                            a.id,
                            a.tahun,
                            a.urusan_id,
                            a.bidang_id,
                            a.no_misi,
                            a.no_tujuan,
                            a.no_sasaran,
                            a.kd_progrkpd,
                            a.id_progrkpd,
                            a.uraian
                    ) b ON 
                    a.kd = b.kd
                    AND a.id = b.id
                    AND a.tahun = b.tahun
                    AND a.urusan_id = b.urusan_id
                    AND a.bidang_id = b.bidang_id
                    AND a.no_misi = b.no_misi
                    AND a.no_tujuan = b.no_tujuan
                    AND a.no_sasaran = b.no_sasaran
                    AND a.kd_progrkpd = b.kd_progrkpd
                    AND a.id_progrkpd = b.id_progrkpd
                    ORDER BY a.kd, a.no_misi, a.no_tujuan, a.no_sasaran, a.kd_progrkpd, a.id_progrkpd      
                 

                        ',
            'params' => [
                    ':tahun' => $tahun,
            ],
            'totalCount' => $totalCount,
            'sort' =>false, // to remove the table header sorting
            /*
            'sort' => [
                'attributes' => [
                    'id',
                    'pagu_kegiatan',
                    'biaya',
                    'selisih',
                    'program',
                    'tahun',
                    'uraian'
                ],
            ],
            */
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('forum', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionKegiatan($id){

        list($tahun, $kd_urusan, $kd_bidang, $kd_unit, $kd_sub, $no_skpdMisi, $no_skpdTujuan, $no_skpdSasaran, $no_renjaProg, $id_renprog) = explode('.', $id);

        $totalCount = Yii::$app->db->createCommand('
            SELECT COUNT(a.id) FROM
                (
                    SELECT
                    a.id, a.id_renja_kegiatan, a.kd_urusan, a.kd_bidang, a.kd_unit, a.kd_sub, a.no_skpdMisi, a.no_skpdTujuan, a.no_skpdSasaran, a.no_renjaSas, a.no_renjaProg, a.id_renprog, a.program_renja,
                    a.id_renkeg, a.kegiatan_renja, a.pagu_kegiatan, b.pagu_kegiatan AS pagu_kegiatan_awal, a.pagu_musrenbang, a.kd_bahas,
                    COUNT(a.id_subkegiatan) AS jumlah_subkegiatan, SUM(IFNULL(a.biaya,0)) AS biaya, SUM(IFNULL(b.biaya,0)) AS biaya_awal
                    FROM
                    (
                        SELECT
                        c.id, c.urusan_id, c.bidang_id, c.uraian,
                        c.kd_urusan, c.kd_bidang, c.kd_unit, c.kd_sub, c.no_skpdMisi, c.no_skpdTujuan, c.no_skpdSasaran, c.no_renjaSas, c.no_renjaProg, c.id_renprog, c.pagu_program AS pagu_program_renja, c.uraian AS program_renja,
                        b.id AS id_renja_kegiatan, b.id_renkeg, b.pagu_kegiatan, b.pagu_musrenbang, b.kd_bahas, b.uraian AS kegiatan_renja,
                        a.id AS id_subkegiatan,
                        a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt, a.volume, a.satuan, a.biaya, a.uraian AS subkegiatan_renja
                        FROM t_subkegiatan a 
                        LEFT JOIN t_renja_kegiatan b ON a.renja_kegiatan_id = b.id 
                        LEFT JOIN t_renja_program c ON b.tahun = c.tahun AND b.kd_urusan = c.kd_urusan AND b.kd_bidang = c.kd_bidang AND b.kd_unit = c.kd_unit AND b.kd_sub = c.kd_sub AND b.no_skpdMisi = c.no_skpdMisi AND b.no_skpdTujuan = c.no_skpdTujuan AND b.no_skpdSasaran = c.no_skpdSasaran AND b.no_renjaSas = c.no_renjaSas AND b.no_renjaProg = c.no_renjaProg
                        WHERE a.status_phased = 6 AND a.input_status = 2 AND b.tahun = :tahun AND b.kd_urusan = :kd_urusan AND  b.kd_bidang = :kd_bidang AND  b.kd_unit = :kd_unit AND  b.kd_sub = :kd_sub AND  b.no_skpdMisi = :no_skpdMisi AND b.no_skpdTujuan = :no_skpdTujuan AND b.no_skpdSasaran = :no_skpdSasaran AND b.no_renjaProg = :no_renjaProg AND b.id_renprog = :id_renprog
                    ) a LEFT JOIN
                    (
                        SELECT
                        c.id, c.urusan_id, c.bidang_id, c.uraian,
                        c.kd_urusan, c.kd_bidang, c.kd_unit, c.kd_sub, c.no_skpdMisi, c.no_skpdTujuan, c.no_skpdSasaran, c.no_renjaSas, c.no_renjaProg, c.id_renprog, c.pagu_program AS pagu_program_renja, c.uraian AS program_renja,
                        b.id AS id_renja_kegiatan, b.id_renkeg, b.pagu_kegiatan, b.pagu_musrenbang, b.kd_bahas, b.uraian AS kegiatan_renja,
                        a.id AS id_subkegiatan,
                        a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt, a.volume, a.satuan, a.biaya, a.uraian AS subkegiatan_renja
                        FROM t_ba_subkegiatan a 
                        LEFT JOIN t_ba_renja_kegiatan b ON a.renja_kegiatan_id = b.id 
                        LEFT JOIN t_ba_renja_program c ON b.tahun = c.tahun AND b.kd_urusan = c.kd_urusan AND b.kd_bidang = c.kd_bidang AND b.kd_unit = c.kd_unit AND b.kd_sub = c.kd_sub AND b.no_skpdMisi = c.no_skpdMisi AND b.no_skpdTujuan = c.no_skpdTujuan AND b.no_skpdSasaran = c.no_skpdSasaran AND b.no_renjaSas = c.no_renjaSas AND b.no_renjaProg = c.no_renjaProg
                        WHERE a.status_phased = 5 AND a.input_status = 2 AND b.tahun = :tahun AND b.kd_urusan = :kd_urusan AND  b.kd_bidang = :kd_bidang AND  b.kd_unit = :kd_unit AND  b.kd_sub = :kd_sub AND  b.no_skpdMisi = :no_skpdMisi AND b.no_skpdTujuan = :no_skpdTujuan AND b.no_skpdSasaran = :no_skpdSasaran AND b.no_renjaProg = :no_renjaProg AND b.id_renprog = :id_renprog

                    ) b ON a.id = b.id AND a.urusan_id = b.urusan_id AND a.kd_urusan = b.kd_urusan AND a.kd_bidang = b.kd_bidang AND a.kd_unit = b.kd_unit AND a.kd_sub = b.kd_sub
                    AND a.no_skpdMisi = b.no_skpdMisi AND a.no_skpdTujuan = b.no_skpdTujuan AND a.no_skpdSasaran = b.no_skpdSasaran AND a.no_renjaProg = b.no_renjaProg AND a.id_renprog = b.id_renprog
                    AND a.id_renkeg = b.id_renkeg AND a.id_subkegiatan = b.id_subkegiatan
                    GROUP BY a.id, a.kd_urusan, a.kd_bidang, a.kd_unit, a.kd_sub, a.no_skpdMisi, a.no_skpdTujuan, a.no_skpdSasaran, a.no_renjaSas, a.no_renjaProg, a.id_renprog, a.program_renja,
                    a.id_renkeg, a.kegiatan_renja, a.pagu_kegiatan, a.pagu_musrenbang, a.kd_bahas 
                ) a GROUP BY a.id   
            ')
                    ->bindValue(':tahun', $tahun)
                    ->bindValue(':kd_urusan', $kd_urusan)
                    ->bindValue(':kd_bidang', $kd_bidang)
                    ->bindValue(':kd_unit', $kd_unit)
                    ->bindValue(':kd_sub', $kd_sub)
                    ->bindValue(':no_skpdMisi', $no_skpdMisi)
                    ->bindValue(':no_skpdTujuan', $no_skpdTujuan)
                    ->bindValue(':no_skpdSasaran', $no_skpdSasaran)
                    ->bindValue(':no_renjaProg', $no_renjaProg)
                    ->bindValue(':id_renprog', $id_renprog)
                    ->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => '
                    SELECT
                    a.id, a.id_renja_kegiatan, a.kd_urusan, a.kd_bidang, a.kd_unit, a.kd_sub, a.no_skpdMisi, a.no_skpdTujuan, a.no_skpdSasaran, a.no_renjaSas, a.no_renjaProg, a.id_renprog, a.program_renja,
                    a.id_renkeg, a.kegiatan_renja, a.pagu_kegiatan, b.pagu_kegiatan AS pagu_kegiatan_awal, a.pagu_musrenbang, a.kd_bahas,
                    COUNT(a.id_subkegiatan) AS jumlah_subkegiatan, SUM(IFNULL(a.biaya,0)) AS biaya, SUM(IFNULL(b.biaya,0)) AS biaya_awal
                    FROM
                    (
                        SELECT
                        c.id, c.urusan_id, c.bidang_id, c.uraian,
                        c.kd_urusan, c.kd_bidang, c.kd_unit, c.kd_sub, c.no_skpdMisi, c.no_skpdTujuan, c.no_skpdSasaran, c.no_renjaSas, c.no_renjaProg, c.id_renprog, c.pagu_program AS pagu_program_renja, c.uraian AS program_renja,
                        b.id AS id_renja_kegiatan, b.id_renkeg, b.pagu_kegiatan, b.pagu_musrenbang, b.kd_bahas, b.uraian AS kegiatan_renja,
                        a.id AS id_subkegiatan,
                        a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt, a.volume, a.satuan, a.biaya, a.uraian AS subkegiatan_renja
                        FROM t_subkegiatan a 
                        LEFT JOIN t_renja_kegiatan b ON a.renja_kegiatan_id = b.id 
                        LEFT JOIN t_renja_program c ON b.tahun = c.tahun AND b.kd_urusan = c.kd_urusan AND b.kd_bidang = c.kd_bidang AND b.kd_unit = c.kd_unit AND b.kd_sub = c.kd_sub AND b.no_skpdMisi = c.no_skpdMisi AND b.no_skpdTujuan = c.no_skpdTujuan AND b.no_skpdSasaran = c.no_skpdSasaran AND b.no_renjaSas = c.no_renjaSas AND b.no_renjaProg = c.no_renjaProg
                        WHERE a.status_phased = 6 AND a.input_status = 2 AND b.tahun = :tahun AND b.kd_urusan = :kd_urusan AND  b.kd_bidang = :kd_bidang AND  b.kd_unit = :kd_unit AND  b.kd_sub = :kd_sub AND  b.no_skpdMisi = :no_skpdMisi AND b.no_skpdTujuan = :no_skpdTujuan AND b.no_skpdSasaran = :no_skpdSasaran AND b.no_renjaProg = :no_renjaProg AND b.id_renprog = :id_renprog
                    ) a LEFT JOIN
                    (
                        SELECT
                        c.id, c.urusan_id, c.bidang_id, c.uraian,
                        c.kd_urusan, c.kd_bidang, c.kd_unit, c.kd_sub, c.no_skpdMisi, c.no_skpdTujuan, c.no_skpdSasaran, c.no_renjaSas, c.no_renjaProg, c.id_renprog, c.pagu_program AS pagu_program_renja, c.uraian AS program_renja,
                        b.id AS id_renja_kegiatan, b.id_renkeg, b.pagu_kegiatan, b.pagu_musrenbang, b.kd_bahas, b.uraian AS kegiatan_renja,
                        a.id AS id_subkegiatan,
                        a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt, a.volume, a.satuan, a.biaya, a.uraian AS subkegiatan_renja
                        FROM t_ba_subkegiatan a 
                        LEFT JOIN t_ba_renja_kegiatan b ON a.renja_kegiatan_id = b.id 
                        LEFT JOIN t_ba_renja_program c ON b.tahun = c.tahun AND b.kd_urusan = c.kd_urusan AND b.kd_bidang = c.kd_bidang AND b.kd_unit = c.kd_unit AND b.kd_sub = c.kd_sub AND b.no_skpdMisi = c.no_skpdMisi AND b.no_skpdTujuan = c.no_skpdTujuan AND b.no_skpdSasaran = c.no_skpdSasaran AND b.no_renjaSas = c.no_renjaSas AND b.no_renjaProg = c.no_renjaProg
                        WHERE a.status_phased = 5 AND a.input_status = 2 AND b.tahun = :tahun AND b.kd_urusan = :kd_urusan AND  b.kd_bidang = :kd_bidang AND  b.kd_unit = :kd_unit AND  b.kd_sub = :kd_sub AND  b.no_skpdMisi = :no_skpdMisi AND b.no_skpdTujuan = :no_skpdTujuan AND b.no_skpdSasaran = :no_skpdSasaran AND b.no_renjaProg = :no_renjaProg AND b.id_renprog = :id_renprog

                    ) b ON a.id = b.id AND a.urusan_id = b.urusan_id AND a.kd_urusan = b.kd_urusan AND a.kd_bidang = b.kd_bidang AND a.kd_unit = b.kd_unit AND a.kd_sub = b.kd_sub
                    AND a.no_skpdMisi = b.no_skpdMisi AND a.no_skpdTujuan = b.no_skpdTujuan AND a.no_skpdSasaran = b.no_skpdSasaran AND a.no_renjaProg = b.no_renjaProg AND a.id_renprog = b.id_renprog
                    AND a.id_renkeg = b.id_renkeg AND a.id_subkegiatan = b.id_subkegiatan
                    GROUP BY a.id, a.kd_urusan, a.kd_bidang, a.kd_unit, a.kd_sub, a.no_skpdMisi, a.no_skpdTujuan, a.no_skpdSasaran, a.no_renjaSas, a.no_renjaProg, a.id_renprog, a.program_renja,
                    a.id_renkeg, a.kegiatan_renja, a.pagu_kegiatan, a.pagu_musrenbang, a.kd_bahas            
                
                        ',
            'params' => [
                        ':tahun' => $tahun,
                        ':kd_urusan' => $kd_urusan,
                        ':kd_bidang' => $kd_bidang,
                        ':kd_unit' => $kd_unit,
                        ':kd_sub' => $kd_sub,
                        ':no_skpdMisi' => $no_skpdMisi,
                        ':no_skpdTujuan' => $no_skpdTujuan,
                        ':no_skpdSasaran' => $no_skpdSasaran,
                        ':no_renjaProg' => $no_renjaProg,
                        ':id_renprog' => $id_renprog
            ],
            'totalCount' => $totalCount,
            'sort' =>false, // to remove the table header sorting
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        
        $dataProvider->pagination->pageParam = 'kegiatan-page';
        
        return Yii::$app->controller->renderAjax('_kegiatan', [
            //'model'=>$model,
            'dataProvider' => $dataProvider,
            ]);
    }

    public function actionSubkegiatan($id){
        $totalCount = Yii::$app->db->createCommand('
                    SELECT
                    COUNT(a.id)
                    FROM
                    (
                    SELECT
                    id, tahun, renja_kegiatan_id, uraian AS aktivitas_usulan, kd_kecamatan, kd_kelurahan, rw, rt, volume, satuan, harga_satuan, biaya, keterangan
                    FROM t_subkegiatan WHERE status_phased = 6 AND input_status = 2 AND renja_kegiatan_id = :renja_kegiatan_id
                    ) a LEFT JOIN
                    (
                    SELECT
                    id, tahun, renja_kegiatan_id, uraian AS aktivitas_usulan, kd_kecamatan, kd_kelurahan, rw, rt, volume, satuan, harga_satuan, biaya, keterangan
                    FROM t_ba_subkegiatan WHERE status_phased = 5 AND input_status = 2 AND renja_kegiatan_id = :renja_kegiatan_id
                    ) b ON a.id = b.id
                    LEFT JOIN
                    r_kecamatan c ON a.kd_kecamatan = c.id 
                    LEFT JOIN
                    r_desa d ON a.kd_kelurahan = d.id   
            ')
                    ->bindValue(':renja_kegiatan_id', $id)
                    ->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => '
                    SELECT
                    a.id, a.tahun, a.renja_kegiatan_id, a.aktivitas_usulan, a.kd_kecamatan, c.kecamatan, a.kd_kelurahan, d.desa, a.rw, a.rt, a.volume, a.satuan, a.harga_satuan, 
                    a.biaya, b.biaya AS biaya_awal,
                    a.keterangan
                    FROM
                    (
                    SELECT
                    id, tahun, renja_kegiatan_id, uraian AS aktivitas_usulan, kd_kecamatan, kd_kelurahan, rw, rt, volume, satuan, harga_satuan, biaya, keterangan
                    FROM t_subkegiatan WHERE status_phased = 6 AND input_status = 2 AND renja_kegiatan_id = :renja_kegiatan_id
                    ) a LEFT JOIN
                    (
                    SELECT
                    id, tahun, renja_kegiatan_id, uraian AS aktivitas_usulan, kd_kecamatan, kd_kelurahan, rw, rt, volume, satuan, harga_satuan, biaya, keterangan
                    FROM t_ba_subkegiatan WHERE status_phased = 5 AND input_status = 2 AND renja_kegiatan_id = :renja_kegiatan_id
                    ) b ON a.id = b.id
                    LEFT JOIN
                    r_kecamatan c ON a.kd_kecamatan = c.id 
                    LEFT JOIN
                    r_desa d ON a.kd_kelurahan = d.id        
                
                        ',
            'params' => [
                        ':renja_kegiatan_id' => $id
            ],
            'totalCount' => $totalCount,
            'sort' =>false, // to remove the table header sorting
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        
        $dataProvider->pagination->pageParam = 'subkegiatan-page';
        
        return Yii::$app->controller->renderAjax('_subkegiatan', [
            //'model'=>$model,
            'dataProvider' => $dataProvider,
            ]);
    }    

    public function actionRkpdprogramview($id)
    {
        $model = $this->findRkpdprogram($id);
        $capaian = $this->findRkpdprogramcapaian($model->tahun, $model->urusan_id, $model->bidang_id, $model->no_misi, $model->no_tujuan, $model->no_sasaran, $model->kd_progrkpd, $model->id_progrkpd);

        $totalCount = Yii::$app->db->createCommand('
                SELECT COUNT(b.id)
                FROM
                (
                    SELECT
                    /*a.status_phased, a.input_status, b.status_phased, b.status, c.status_phased, c.status, f.status_phased, f.status,*/
                    c.id, c.urusan_id, c.bidang_id, c.uraian,
                    f.tahun, f.no_misi, f.no_tujuan, f.no_sasaran, f.kd_progrkpd, f.id_progrkpd, f.pagu_program AS pagu_program_rkpd, f.uraian AS program_rkpd, f.urusan_id AS urusan_rkpd, f.bidang_id AS bidang_rkpd,
                    c.kd_urusan, c.kd_bidang, c.kd_unit, c.kd_sub, c.no_skpdMisi, c.no_skpdTujuan, c.no_skpdSasaran, c.no_renjaSas, c.no_renjaProg, c.id_renprog, c.pagu_program AS pagu_program_renja, c.uraian AS program_renja,
                    b.id_renkeg, b.pagu_kegiatan, b.pagu_musrenbang, b.kd_bahas, b.uraian AS kegiatan_renja,
                    a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt, a.volume, a.satuan, a.biaya, a.uraian AS subkegiatan_renja
                    FROM t_subkegiatan a 
                    LEFT JOIN t_renja_kegiatan b ON a.renja_kegiatan_id = b.id 
                    LEFT JOIN t_renja_program c ON b.tahun = c.tahun AND b.kd_urusan = c.kd_urusan AND b.kd_bidang = c.kd_bidang AND b.kd_unit = c.kd_unit AND b.kd_sub = c.kd_sub AND b.no_skpdMisi = c.no_skpdMisi AND b.no_skpdTujuan = c.no_skpdTujuan AND b.no_skpdSasaran = c.no_skpdSasaran AND b.no_renjaSas = c.no_renjaSas AND b.no_renjaProg = c.no_renjaProg
                    LEFT JOIN ta_renstra d ON c.id_tahun = d.ID_Tahun AND c.Kd_Perubahan_Renstra = d.Kd_Perubahan AND c.Kd_Dokumen_Renstra = d.Kd_Dokumen AND c.Kd_Usulan_Renstra = d.Kd_Usulan AND c.Kd_Urusan_Renstra = d.Kd_Urusan AND c.Kd_Bidang_Renstra = d.Kd_Bidang AND c.Kd_Unit_Renstra = d.Kd_Unit AND c.No_Misi_Renstra = d.No_Misi AND c.No_Tujuan_Renstra = d.No_Tujuan AND c.No_Sasaran_Renstra = d.No_Sasaran AND c.Kd_Prog_Renstra = d.Kd_Prog AND c.ID_Prog_Renstra = d.ID_Prog 
                    LEFT JOIN ta_program_rpjmd e ON d.Kd_Urusan1 = e.Kd_Urusan1 AND d.Kd_Bidang1 = e.Kd_Bidang1 AND d.No_Misi1 = e.No_Misi AND d.No_Tujuan1 = e.No_Tujuan AND d.No_Sasaran1 = e.No_Sasaran AND d.Kd_Prog1 = e.Kd_Prog AND d.ID_Prog1 = e.Id_Prog 
                    LEFT JOIN t_rkpd_program f ON f.ID_Tahun = e.ID_Tahun AND f.Kd_Perubahan_Rpjmd = e.Kd_Perubahan AND f.Kd_Dokumen_Rpjmd = e.Kd_Dokumen AND f.Kd_Usulan_Rpjmd = e.Kd_Usulan AND f.No_Misi_Rpjmd = e.No_Misi AND f.No_Tujuan_Rpjmd = e.No_Tujuan AND f.No_Sasaran_Rpjmd = e.No_Sasaran AND f.Kd_Prog_Rpjmd = e.Kd_Prog AND f.ID_Prog_Rpjmd = e.Id_Prog
                    WHERE a.status_phased = 6 AND a.input_status = 2 AND f.tahun = :tahun AND f.urusan_id = :urusan_id AND f.bidang_id = :bidang_id AND f.no_misi = :no_misi AND f.no_tujuan = :no_tujuan AND f.no_sasaran = :no_sasaran AND f.kd_progrkpd = :kd_progrkpd AND f.id_progrkpd = :id_progrkpd

                )b
                LEFT JOIN
                (
                    SELECT
                    c.id, c.urusan_id, c.bidang_id, c.uraian,
                    f.tahun, f.no_misi, f.no_tujuan, f.no_sasaran, f.kd_progrkpd, f.id_progrkpd, f.pagu_program AS pagu_program_rkpd, f.uraian AS program_rkpd, f.urusan_id AS urusan_rkpd, f.bidang_id AS bidang_rkpd,
                    c.kd_urusan, c.kd_bidang, c.kd_unit, c.kd_sub, c.no_skpdMisi, c.no_skpdTujuan, c.no_skpdSasaran, c.no_renjaSas, c.no_renjaProg, c.id_renprog, c.pagu_program AS pagu_program_renja, c.uraian AS program_renja,
                    b.id_renkeg, b.pagu_kegiatan, b.pagu_musrenbang, b.kd_bahas, b.uraian AS kegiatan_renja,
                    a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt, a.volume, a.satuan, a.biaya, a.uraian AS subkegiatan_renja
                    FROM t_ba_subkegiatan a 
                    LEFT JOIN t_ba_renja_kegiatan b ON a.renja_kegiatan_id = b.id 
                    LEFT JOIN t_ba_renja_program c ON b.tahun = c.tahun AND b.kd_urusan = c.kd_urusan AND b.kd_bidang = c.kd_bidang AND b.kd_unit = c.kd_unit AND b.kd_sub = c.kd_sub AND b.no_skpdMisi = c.no_skpdMisi AND b.no_skpdTujuan = c.no_skpdTujuan AND b.no_skpdSasaran = c.no_skpdSasaran AND b.no_renjaSas = c.no_renjaSas AND b.no_renjaProg = c.no_renjaProg
                    LEFT JOIN ta_renstra d ON c.id_tahun = d.ID_Tahun AND c.Kd_Perubahan_Renstra = d.Kd_Perubahan AND c.Kd_Dokumen_Renstra = d.Kd_Dokumen AND c.Kd_Usulan_Renstra = d.Kd_Usulan AND c.Kd_Urusan_Renstra = d.Kd_Urusan AND c.Kd_Bidang_Renstra = d.Kd_Bidang AND c.Kd_Unit_Renstra = d.Kd_Unit AND c.No_Misi_Renstra = d.No_Misi AND c.No_Tujuan_Renstra = d.No_Tujuan AND c.No_Sasaran_Renstra = d.No_Sasaran AND c.Kd_Prog_Renstra = d.Kd_Prog AND c.ID_Prog_Renstra = d.ID_Prog 
                    LEFT JOIN ta_program_rpjmd e ON d.Kd_Urusan1 = e.Kd_Urusan1 AND d.Kd_Bidang1 = e.Kd_Bidang1 AND d.No_Misi1 = e.No_Misi AND d.No_Tujuan1 = e.No_Tujuan AND d.No_Sasaran1 = e.No_Sasaran AND d.Kd_Prog1 = e.Kd_Prog AND d.ID_Prog1 = e.Id_Prog 
                    LEFT JOIN t_ba_rkpd_program f ON f.ID_Tahun = e.ID_Tahun AND f.Kd_Perubahan_Rpjmd = e.Kd_Perubahan AND f.Kd_Dokumen_Rpjmd = e.Kd_Dokumen AND f.Kd_Usulan_Rpjmd = e.Kd_Usulan AND f.No_Misi_Rpjmd = e.No_Misi AND f.No_Tujuan_Rpjmd = e.No_Tujuan AND f.No_Sasaran_Rpjmd = e.No_Sasaran AND f.Kd_Prog_Rpjmd = e.Kd_Prog AND f.ID_Prog_Rpjmd = e.Id_Prog
                    WHERE a.status_phased = 5 AND a.input_status = 2 AND f.tahun = :tahun AND f.urusan_id = :urusan_id AND f.bidang_id = :bidang_id AND f.no_misi = :no_misi AND f.no_tujuan = :no_tujuan AND f.no_sasaran = :no_sasaran AND f.kd_progrkpd = :kd_progrkpd AND f.id_progrkpd = :id_progrkpd

                )c ON b.tahun = c.tahun AND b.urusan_id = c.urusan_rkpd AND b.bidang_id = b.bidang_rkpd AND b.no_misi = b.no_misi AND b.no_tujuan = c.no_tujuan AND b.no_sasaran = c.no_sasaran AND b.kd_progrkpd = c.kd_progrkpd AND b.id_progrkpd = b.id_progrkpd
                GROUP BY b.id, b.tahun, b.urusan_id, b.bidang_id, b.kd_urusan, b.kd_bidang, b.kd_unit, b.kd_sub, b.no_skpdMisi, b.no_skpdTujuan, b.no_skpdSasaran, b.no_renjaSas, b.no_renjaProg, b.id_renprog
                ORDER BY b.id ASC  
            ')
                    ->bindValue(':tahun', (DATE('Y')+1))
                    ->bindValue(':urusan_id', $model['urusan_id'])
                    ->bindValue(':bidang_id', $model['bidang_id'])
                    ->bindValue(':no_misi', $model['no_misi'])
                    ->bindValue(':no_tujuan', $model['no_tujuan'])
                    ->bindValue(':no_sasaran', $model['no_sasaran'])
                    ->bindValue(':kd_progrkpd', $model['kd_progrkpd'])
                    ->bindValue(':id_progrkpd', $model['id_progrkpd'])
                    ->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => '
                SELECT
                b.id, b.tahun, b.urusan_id, b.bidang_id, b.kd_urusan, b.kd_bidang, b.kd_unit, b.kd_sub, b.no_skpdMisi, b.no_skpdTujuan, b.no_skpdSasaran, b.no_renjaSas, b.no_renjaProg, b.id_renprog, b.uraian AS program,
                SUM(IFNULL(b.pagu_program_rkpd,0)) AS pagu_program_rkpd, SUM(IFNULL(b.pagu_program_renja,0)) AS pagu_program_renja, SUM(IFNULL(b.pagu_kegiatan,0)) AS pagu_kegiatan, SUM(IFNULL(b.biaya,0)) AS biaya,
                SUM(IFNULL(c.pagu_program_rkpd,0)) AS pagu_program_rkpd_awal, SUM(IFNULL(c.pagu_program_renja,0)) AS pagu_program_renja_awal, SUM(IFNULL(c.pagu_kegiatan,0)) AS pagu_kegiatan_awal, SUM(IFNULL(c.biaya,0)) AS biaya_awal
                /*a.created_at, a.updated_at, a.user_id, a.input_phased, a.status, a.status_phased,
                a.id_tahun, a.Kd_Perubahan_Rpjmd, a.Kd_Dokumen_Rpjmd, a.Kd_Usulan_Rpjmd, a.No_Misi_Rpjmd, a.No_Tujuan_Rpjmd, a.No_Sasaran_Rpjmd, a.Kd_Prog_Rpjmd, a.ID_Prog_Rpjmd
                */
                FROM
                (
                    SELECT
                    /*a.status_phased, a.input_status, b.status_phased, b.status, c.status_phased, c.status, f.status_phased, f.status,*/
                    c.id, c.urusan_id, c.bidang_id, c.uraian,
                    f.tahun, f.no_misi, f.no_tujuan, f.no_sasaran, f.kd_progrkpd, f.id_progrkpd, f.pagu_program AS pagu_program_rkpd, f.uraian AS program_rkpd, f.urusan_id AS urusan_rkpd, f.bidang_id AS bidang_rkpd,
                    c.kd_urusan, c.kd_bidang, c.kd_unit, c.kd_sub, c.no_skpdMisi, c.no_skpdTujuan, c.no_skpdSasaran, c.no_renjaSas, c.no_renjaProg, c.id_renprog, c.pagu_program AS pagu_program_renja, c.uraian AS program_renja,
                    b.id_renkeg, b.pagu_kegiatan, b.pagu_musrenbang, b.kd_bahas, b.uraian AS kegiatan_renja,
                    a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt, a.volume, a.satuan, a.biaya, a.uraian AS subkegiatan_renja
                    FROM t_subkegiatan a 
                    LEFT JOIN t_renja_kegiatan b ON a.renja_kegiatan_id = b.id 
                    LEFT JOIN t_renja_program c ON b.tahun = c.tahun AND b.kd_urusan = c.kd_urusan AND b.kd_bidang = c.kd_bidang AND b.kd_unit = c.kd_unit AND b.kd_sub = c.kd_sub AND b.no_skpdMisi = c.no_skpdMisi AND b.no_skpdTujuan = c.no_skpdTujuan AND b.no_skpdSasaran = c.no_skpdSasaran AND b.no_renjaSas = c.no_renjaSas AND b.no_renjaProg = c.no_renjaProg
                    LEFT JOIN ta_renstra d ON c.id_tahun = d.ID_Tahun AND c.Kd_Perubahan_Renstra = d.Kd_Perubahan AND c.Kd_Dokumen_Renstra = d.Kd_Dokumen AND c.Kd_Usulan_Renstra = d.Kd_Usulan AND c.Kd_Urusan_Renstra = d.Kd_Urusan AND c.Kd_Bidang_Renstra = d.Kd_Bidang AND c.Kd_Unit_Renstra = d.Kd_Unit AND c.No_Misi_Renstra = d.No_Misi AND c.No_Tujuan_Renstra = d.No_Tujuan AND c.No_Sasaran_Renstra = d.No_Sasaran AND c.Kd_Prog_Renstra = d.Kd_Prog AND c.ID_Prog_Renstra = d.ID_Prog 
                    LEFT JOIN ta_program_rpjmd e ON d.Kd_Urusan1 = e.Kd_Urusan1 AND d.Kd_Bidang1 = e.Kd_Bidang1 AND d.No_Misi1 = e.No_Misi AND d.No_Tujuan1 = e.No_Tujuan AND d.No_Sasaran1 = e.No_Sasaran AND d.Kd_Prog1 = e.Kd_Prog AND d.ID_Prog1 = e.Id_Prog 
                    LEFT JOIN t_rkpd_program f ON f.ID_Tahun = e.ID_Tahun AND f.Kd_Perubahan_Rpjmd = e.Kd_Perubahan AND f.Kd_Dokumen_Rpjmd = e.Kd_Dokumen AND f.Kd_Usulan_Rpjmd = e.Kd_Usulan AND f.No_Misi_Rpjmd = e.No_Misi AND f.No_Tujuan_Rpjmd = e.No_Tujuan AND f.No_Sasaran_Rpjmd = e.No_Sasaran AND f.Kd_Prog_Rpjmd = e.Kd_Prog AND f.ID_Prog_Rpjmd = e.Id_Prog
                    WHERE a.status_phased = 6 AND a.input_status = 2 AND f.tahun = :tahun AND f.urusan_id = :urusan_id AND f.bidang_id = :bidang_id AND f.no_misi = :no_misi AND f.no_tujuan = :no_tujuan AND f.no_sasaran = :no_sasaran AND f.kd_progrkpd = :kd_progrkpd AND f.id_progrkpd = :id_progrkpd

                )b
                LEFT JOIN
                (
                    SELECT
                    c.id, c.urusan_id, c.bidang_id, c.uraian,
                    f.tahun, f.no_misi, f.no_tujuan, f.no_sasaran, f.kd_progrkpd, f.id_progrkpd, f.pagu_program AS pagu_program_rkpd, f.uraian AS program_rkpd, f.urusan_id AS urusan_rkpd, f.bidang_id AS bidang_rkpd,
                    c.kd_urusan, c.kd_bidang, c.kd_unit, c.kd_sub, c.no_skpdMisi, c.no_skpdTujuan, c.no_skpdSasaran, c.no_renjaSas, c.no_renjaProg, c.id_renprog, c.pagu_program AS pagu_program_renja, c.uraian AS program_renja,
                    b.id_renkeg, b.pagu_kegiatan, b.pagu_musrenbang, b.kd_bahas, b.uraian AS kegiatan_renja,
                    a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt, a.volume, a.satuan, a.biaya, a.uraian AS subkegiatan_renja
                    FROM t_ba_subkegiatan a 
                    LEFT JOIN t_ba_renja_kegiatan b ON a.renja_kegiatan_id = b.id 
                    LEFT JOIN t_ba_renja_program c ON b.tahun = c.tahun AND b.kd_urusan = c.kd_urusan AND b.kd_bidang = c.kd_bidang AND b.kd_unit = c.kd_unit AND b.kd_sub = c.kd_sub AND b.no_skpdMisi = c.no_skpdMisi AND b.no_skpdTujuan = c.no_skpdTujuan AND b.no_skpdSasaran = c.no_skpdSasaran AND b.no_renjaSas = c.no_renjaSas AND b.no_renjaProg = c.no_renjaProg
                    LEFT JOIN ta_renstra d ON c.id_tahun = d.ID_Tahun AND c.Kd_Perubahan_Renstra = d.Kd_Perubahan AND c.Kd_Dokumen_Renstra = d.Kd_Dokumen AND c.Kd_Usulan_Renstra = d.Kd_Usulan AND c.Kd_Urusan_Renstra = d.Kd_Urusan AND c.Kd_Bidang_Renstra = d.Kd_Bidang AND c.Kd_Unit_Renstra = d.Kd_Unit AND c.No_Misi_Renstra = d.No_Misi AND c.No_Tujuan_Renstra = d.No_Tujuan AND c.No_Sasaran_Renstra = d.No_Sasaran AND c.Kd_Prog_Renstra = d.Kd_Prog AND c.ID_Prog_Renstra = d.ID_Prog 
                    LEFT JOIN ta_program_rpjmd e ON d.Kd_Urusan1 = e.Kd_Urusan1 AND d.Kd_Bidang1 = e.Kd_Bidang1 AND d.No_Misi1 = e.No_Misi AND d.No_Tujuan1 = e.No_Tujuan AND d.No_Sasaran1 = e.No_Sasaran AND d.Kd_Prog1 = e.Kd_Prog AND d.ID_Prog1 = e.Id_Prog 
                    LEFT JOIN t_ba_rkpd_program f ON f.ID_Tahun = e.ID_Tahun AND f.Kd_Perubahan_Rpjmd = e.Kd_Perubahan AND f.Kd_Dokumen_Rpjmd = e.Kd_Dokumen AND f.Kd_Usulan_Rpjmd = e.Kd_Usulan AND f.No_Misi_Rpjmd = e.No_Misi AND f.No_Tujuan_Rpjmd = e.No_Tujuan AND f.No_Sasaran_Rpjmd = e.No_Sasaran AND f.Kd_Prog_Rpjmd = e.Kd_Prog AND f.ID_Prog_Rpjmd = e.Id_Prog
                    WHERE a.status_phased = 5 AND a.input_status = 2 AND f.tahun = :tahun AND f.urusan_id = :urusan_id AND f.bidang_id = :bidang_id AND f.no_misi = :no_misi AND f.no_tujuan = :no_tujuan AND f.no_sasaran = :no_sasaran AND f.kd_progrkpd = :kd_progrkpd AND f.id_progrkpd = :id_progrkpd

                )c ON b.tahun = c.tahun AND b.urusan_id = c.urusan_rkpd AND b.bidang_id = b.bidang_rkpd AND b.no_misi = b.no_misi AND b.no_tujuan = c.no_tujuan AND b.no_sasaran = c.no_sasaran AND b.kd_progrkpd = c.kd_progrkpd AND b.id_progrkpd = b.id_progrkpd
                GROUP BY b.id, b.tahun, b.urusan_id, b.bidang_id, b.kd_urusan, b.kd_bidang, b.kd_unit, b.kd_sub, b.no_skpdMisi, b.no_skpdTujuan, b.no_skpdSasaran, b.no_renjaSas, b.no_renjaProg, b.id_renprog
                ORDER BY b.id ASC              

                        ',
            'params' => [
                    ':tahun' => $model['tahun'],
                    ':urusan_id' => $model['urusan_id'],
                    ':bidang_id' => $model['bidang_id'],
                    ':no_misi' => $model['no_misi'],
                    ':no_tujuan' => $model['no_tujuan'],
                    ':no_sasaran' => $model['no_sasaran'],
                    ':kd_progrkpd' => $model['kd_progrkpd'],
                    ':id_progrkpd' => $model['id_progrkpd']
            ],
            'totalCount' => $totalCount,
            'sort' =>false, // to remove the table header sorting
            /*
            'sort' => [
                'attributes' => [
                    'id',
                    'pagu_kegiatan',
                    'biaya',
                    'selisih',
                    'program',
                    'tahun',
                    'uraian'
                ],
            ],
            */
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        
        //untuk program
        $model_s = $this->findRkpdprogram($id);
        if ($model->load(Yii::$app->request->post())) {
            IF($model->save()){
                $historis = new \common\models\Historis();
                $historis->kd_historis = 5;
                $historis->id_ref = $model_s['id'];
                $historis->created_at = $model_s['created_at'];
                $historis->updated_at = strtotime(DATE('Y-m-d'));
                $historis->tahun = $model_s['tahun'];
                $historis->urusan_id = $model_s['urusan_id'];
                $historis->bidang_id = $model_s['bidang_id'];
                $historis->no_misi = $model_s['no_misi'];
                $historis->no_tujuan = $model_s['no_tujuan'];
                $historis->no_sasaran = $model_s['no_sasaran'];
                $historis->kd_progrkpd = $model_s['kd_progrkpd'];
                $historis->id_progrkpd = $model_s['id_progrkpd'];
                $historis->uraian = $model_s['uraian'];
                $historis->pagu_program = $model_s['pagu_program'];
                $historis->input_phased = $model_s['input_phased'];
                $historis->status = $model_s['status'];
                $historis->status_phased = 6;
                //$historis->alasan_perubahan = $historis->alasan_perubahan;
                $historis->user_id = Yii::$app->user->identity->id;
                IF($historis->save()){
                    Yii::$app->session->setFlash('kv-detail-success', 'Perubahan Tersimpan.');
                    return $this->redirect(['rkpdprogramview', 'id'=>$model->id]);
                }
            }
        }
        
        //untuk capaian program
        if (($capaian_post = Yii::$app->request->post()) && $capaian_post['RkpdProgramCapaian'] <> NULL) {
            $id_capaian = \common\models\RkpdProgramCapaian::find()->where([
                        'tahun' => $model->tahun, 
                        'urusan_id' => $model->urusan_id,
                        'bidang_id' => $model->bidang_id,
                        'no_misi' => $model->no_misi,
                        'no_tujuan' => $model->no_tujuan,
                        'no_sasaran' => $model->no_sasaran,
                        'kd_progrkpd' => $model->kd_progrkpd,
                        'id_progrkpd' => $model->id_progrkpd,
                        'no_indikator' => $capaian_post['RkpdProgramCapaian']['no_indikator']
                    ])->one();
            $historis = new \common\models\HistorisCapaian();
            $connection = \Yii::$app->db;
            $execute = $connection->createCommand()
                ->update('t_rkpd_program_capaian', 
                    [ //Bagian yang akan diubah @hoaaah
                        'uraian' => $capaian_post['RkpdProgramCapaian']['uraian'],
                        'target_angka' => $capaian_post['RkpdProgramCapaian']['target_angka'],
                    ],
                    [ //condition perubahan @hoaaah
                        'id' => $id_capaian['id'],
                    ]
                        );
            //var_dump($capaian_post['RkpdProgramCapaian']);
            //var_dump($id_capaian);
            IF($execute->execute()){
                $historis->kd_historis = 6;
                $historis->id_ref = $id_capaian['id'];
                $historis->created_at = $id_capaian['created_at'];
                $historis->updated_at = strtotime(DATE('Y-m-d'));
                $historis->tahun = $id_capaian['tahun'];
                $historis->urusan_id = $id_capaian['urusan_id'];
                $historis->bidang_id = $id_capaian['bidang_id'];
                $historis->no_misi = $id_capaian['no_misi'];
                $historis->no_tujuan = $id_capaian['no_tujuan'];
                $historis->no_sasaran = $id_capaian['no_sasaran'];
                $historis->kd_progrkpd = $id_capaian['kd_progrkpd'];
                $historis->id_progrkpd = $id_capaian['id_progrkpd'];
                $historis->no_indikator = $id_capaian['no_indikator'];
                $historis->tolok_ukur = $id_capaian['tolok_ukur'];
                $historis->target_angka = $id_capaian['target_angka'];
                $historis->target_uraian = $id_capaian['target_uraian'];
                $historis->kd_indikator_2 = $id_capaian['kd_indikator_2'];
                $historis->kd_indikator_3 = $id_capaian['kd_indikator_3'];
                $historis->keterangan = $id_capaian['keterangan'];
                $historis->uraian = $id_capaian['uraian'];
                $historis->input_phased = $id_capaian['input_phased'];
                $historis->status = $id_capaian['status'];
                $historis->status_phased = 6;
                //$historis->alasan_perubahan = $historis->alasan_perubahan;
                $historis->user_id = Yii::$app->user->identity->id;
                IF($historis->save()){
                    Yii::$app->session->setFlash('kv-detail-success', 'Perubahan Tersimpan.');
                    return $this->redirect(['rkpdprogramview', 'id'=>$model->id]);
                }
            }
        }

        $jadwal = $this->cekjadwal();
        //$proses = Proses::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 6])->andWhere('kd_kelurahan=:kd_kelurahan', [':kd_kelurahan' => Yii::$app->user->identity->tperan->kd_kelurahan])->one();


        $dataProvider->pagination->pageParam = 'program-page';          
        return $this->render('rkpdprogramview', [
            'model' => $model,
            'capaian' => $capaian,
            'dataProvider' => $dataProvider,
            'jadwal' => $jadwal,
        ]);
    }

    public function actionRenjaprogramview($id)
    {
        $model = $this->findRenjaprogram($id);
        $capaian = $this->findRenjaprogramcapaian($model->tahun, $model->urusan_id, $model->bidang_id, $model->kd_urusan, $model->kd_bidang, $model->kd_unit, $model->kd_sub, $model->no_skpdMisi, $model->no_skpdTujuan, $model->no_skpdSasaran, $model->no_renjaSas, $model->no_renjaProg, $model->id_renprog);

        $totalCount = Yii::$app->db->createCommand('
            SELECT COUNT(a.id) FROM
                (
                    SELECT
                    a.id, a.id_renja_kegiatan, a.kd_urusan, a.kd_bidang, a.kd_unit, a.kd_sub, a.no_skpdMisi, a.no_skpdTujuan, a.no_skpdSasaran, a.no_renjaSas, a.no_renjaProg, a.id_renprog, a.program_renja,
                    a.id_renkeg, a.kegiatan_renja, a.pagu_kegiatan, b.pagu_kegiatan AS pagu_kegiatan_awal, a.pagu_musrenbang, a.kd_bahas,
                    COUNT(a.id_subkegiatan) AS jumlah_subkegiatan, SUM(IFNULL(a.biaya,0)) AS biaya, SUM(IFNULL(b.biaya,0)) AS biaya_awal
                    FROM
                    (
                        SELECT
                        c.id, c.urusan_id, c.bidang_id, c.uraian,
                        c.kd_urusan, c.kd_bidang, c.kd_unit, c.kd_sub, c.no_skpdMisi, c.no_skpdTujuan, c.no_skpdSasaran, c.no_renjaSas, c.no_renjaProg, c.id_renprog, c.pagu_program AS pagu_program_renja, c.uraian AS program_renja,
                        b.id AS id_renja_kegiatan, b.id_renkeg, b.pagu_kegiatan, b.pagu_musrenbang, b.kd_bahas, b.uraian AS kegiatan_renja,
                        a.id AS id_subkegiatan,
                        a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt, a.volume, a.satuan, a.biaya, a.uraian AS subkegiatan_renja
                        FROM t_subkegiatan a 
                        LEFT JOIN t_renja_kegiatan b ON a.renja_kegiatan_id = b.id 
                        LEFT JOIN t_renja_program c ON b.tahun = c.tahun AND b.kd_urusan = c.kd_urusan AND b.kd_bidang = c.kd_bidang AND b.kd_unit = c.kd_unit AND b.kd_sub = c.kd_sub AND b.no_skpdMisi = c.no_skpdMisi AND b.no_skpdTujuan = c.no_skpdTujuan AND b.no_skpdSasaran = c.no_skpdSasaran AND b.no_renjaSas = c.no_renjaSas AND b.no_renjaProg = c.no_renjaProg
                        WHERE a.status_phased = 6 AND a.input_status = 2 AND b.tahun = :tahun AND b.kd_urusan = :kd_urusan AND  b.kd_bidang = :kd_bidang AND  b.kd_unit = :kd_unit AND  b.kd_sub = :kd_sub AND  b.no_skpdMisi = :no_skpdMisi AND b.no_skpdTujuan = :no_skpdTujuan AND b.no_skpdSasaran = :no_skpdSasaran AND b.no_renjaProg = :no_renjaProg AND b.id_renprog = :id_renprog
                    ) a LEFT JOIN
                    (
                        SELECT
                        c.id, c.urusan_id, c.bidang_id, c.uraian,
                        c.kd_urusan, c.kd_bidang, c.kd_unit, c.kd_sub, c.no_skpdMisi, c.no_skpdTujuan, c.no_skpdSasaran, c.no_renjaSas, c.no_renjaProg, c.id_renprog, c.pagu_program AS pagu_program_renja, c.uraian AS program_renja,
                        b.id AS id_renja_kegiatan, b.id_renkeg, b.pagu_kegiatan, b.pagu_musrenbang, b.kd_bahas, b.uraian AS kegiatan_renja,
                        a.id AS id_subkegiatan,
                        a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt, a.volume, a.satuan, a.biaya, a.uraian AS subkegiatan_renja
                        FROM t_ba_subkegiatan a 
                        LEFT JOIN t_ba_renja_kegiatan b ON a.renja_kegiatan_id = b.id 
                        LEFT JOIN t_ba_renja_program c ON b.tahun = c.tahun AND b.kd_urusan = c.kd_urusan AND b.kd_bidang = c.kd_bidang AND b.kd_unit = c.kd_unit AND b.kd_sub = c.kd_sub AND b.no_skpdMisi = c.no_skpdMisi AND b.no_skpdTujuan = c.no_skpdTujuan AND b.no_skpdSasaran = c.no_skpdSasaran AND b.no_renjaSas = c.no_renjaSas AND b.no_renjaProg = c.no_renjaProg
                        WHERE a.status_phased = 5 AND a.input_status = 2 AND b.tahun = :tahun AND b.kd_urusan = :kd_urusan AND  b.kd_bidang = :kd_bidang AND  b.kd_unit = :kd_unit AND  b.kd_sub = :kd_sub AND  b.no_skpdMisi = :no_skpdMisi AND b.no_skpdTujuan = :no_skpdTujuan AND b.no_skpdSasaran = :no_skpdSasaran AND b.no_renjaProg = :no_renjaProg AND b.id_renprog = :id_renprog

                    ) b ON a.id = b.id AND a.urusan_id = b.urusan_id AND a.kd_urusan = b.kd_urusan AND a.kd_bidang = b.kd_bidang AND a.kd_unit = b.kd_unit AND a.kd_sub = b.kd_sub
                    AND a.no_skpdMisi = b.no_skpdMisi AND a.no_skpdTujuan = b.no_skpdTujuan AND a.no_skpdSasaran = b.no_skpdSasaran AND a.no_renjaProg = b.no_renjaProg AND a.id_renprog = b.id_renprog
                    AND a.id_renkeg = b.id_renkeg AND a.id_subkegiatan = b.id_subkegiatan
                    GROUP BY a.id, a.kd_urusan, a.kd_bidang, a.kd_unit, a.kd_sub, a.no_skpdMisi, a.no_skpdTujuan, a.no_skpdSasaran, a.no_renjaSas, a.no_renjaProg, a.id_renprog, a.program_renja,
                    a.id_renkeg, a.kegiatan_renja, a.pagu_kegiatan, a.pagu_musrenbang, a.kd_bahas 
                ) a GROUP BY a.id   
            ')
                    ->bindValue(':tahun', $model->tahun)
                    ->bindValue(':kd_urusan', $model->kd_urusan)
                    ->bindValue(':kd_bidang', $model->kd_bidang)
                    ->bindValue(':kd_unit', $model->kd_unit)
                    ->bindValue(':kd_sub', $model->kd_sub)
                    ->bindValue(':no_skpdMisi', $model->no_skpdMisi)
                    ->bindValue(':no_skpdTujuan', $model->no_skpdTujuan)
                    ->bindValue(':no_skpdSasaran', $model->no_skpdSasaran)
                    ->bindValue(':no_renjaProg', $model->no_renjaProg)
                    ->bindValue(':id_renprog', $model->id_renprog)
                    ->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => '
                    SELECT
                    a.id, a.id_renja_kegiatan, a.kd_urusan, a.kd_bidang, a.kd_unit, a.kd_sub, a.no_skpdMisi, a.no_skpdTujuan, a.no_skpdSasaran, a.no_renjaSas, a.no_renjaProg, a.id_renprog, a.program_renja,
                    a.id_renkeg, a.kegiatan_renja, a.pagu_kegiatan, b.pagu_kegiatan AS pagu_kegiatan_awal, a.pagu_musrenbang, a.kd_bahas,
                    COUNT(a.id_subkegiatan) AS jumlah_subkegiatan, SUM(IFNULL(a.biaya,0)) AS biaya, SUM(IFNULL(b.biaya,0)) AS biaya_awal
                    FROM
                    (
                        SELECT
                        c.id, c.urusan_id, c.bidang_id, c.uraian,
                        c.kd_urusan, c.kd_bidang, c.kd_unit, c.kd_sub, c.no_skpdMisi, c.no_skpdTujuan, c.no_skpdSasaran, c.no_renjaSas, c.no_renjaProg, c.id_renprog, c.pagu_program AS pagu_program_renja, c.uraian AS program_renja,
                        b.id AS id_renja_kegiatan, b.id_renkeg, b.pagu_kegiatan, b.pagu_musrenbang, b.kd_bahas, b.uraian AS kegiatan_renja,
                        a.id AS id_subkegiatan,
                        a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt, a.volume, a.satuan, a.biaya, a.uraian AS subkegiatan_renja
                        FROM t_subkegiatan a 
                        LEFT JOIN t_renja_kegiatan b ON a.renja_kegiatan_id = b.id 
                        LEFT JOIN t_renja_program c ON b.tahun = c.tahun AND b.kd_urusan = c.kd_urusan AND b.kd_bidang = c.kd_bidang AND b.kd_unit = c.kd_unit AND b.kd_sub = c.kd_sub AND b.no_skpdMisi = c.no_skpdMisi AND b.no_skpdTujuan = c.no_skpdTujuan AND b.no_skpdSasaran = c.no_skpdSasaran AND b.no_renjaSas = c.no_renjaSas AND b.no_renjaProg = c.no_renjaProg
                        WHERE a.status_phased = 6 AND a.input_status = 2 AND b.tahun = :tahun AND b.kd_urusan = :kd_urusan AND  b.kd_bidang = :kd_bidang AND  b.kd_unit = :kd_unit AND  b.kd_sub = :kd_sub AND  b.no_skpdMisi = :no_skpdMisi AND b.no_skpdTujuan = :no_skpdTujuan AND b.no_skpdSasaran = :no_skpdSasaran AND b.no_renjaProg = :no_renjaProg AND b.id_renprog = :id_renprog
                    ) a LEFT JOIN
                    (
                        SELECT
                        c.id, c.urusan_id, c.bidang_id, c.uraian,
                        c.kd_urusan, c.kd_bidang, c.kd_unit, c.kd_sub, c.no_skpdMisi, c.no_skpdTujuan, c.no_skpdSasaran, c.no_renjaSas, c.no_renjaProg, c.id_renprog, c.pagu_program AS pagu_program_renja, c.uraian AS program_renja,
                        b.id AS id_renja_kegiatan, b.id_renkeg, b.pagu_kegiatan, b.pagu_musrenbang, b.kd_bahas, b.uraian AS kegiatan_renja,
                        a.id AS id_subkegiatan,
                        a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt, a.volume, a.satuan, a.biaya, a.uraian AS subkegiatan_renja
                        FROM t_ba_subkegiatan a 
                        LEFT JOIN t_ba_renja_kegiatan b ON a.renja_kegiatan_id = b.id 
                        LEFT JOIN t_ba_renja_program c ON b.tahun = c.tahun AND b.kd_urusan = c.kd_urusan AND b.kd_bidang = c.kd_bidang AND b.kd_unit = c.kd_unit AND b.kd_sub = c.kd_sub AND b.no_skpdMisi = c.no_skpdMisi AND b.no_skpdTujuan = c.no_skpdTujuan AND b.no_skpdSasaran = c.no_skpdSasaran AND b.no_renjaSas = c.no_renjaSas AND b.no_renjaProg = c.no_renjaProg
                        WHERE a.status_phased = 5 AND a.input_status = 2 AND b.tahun = :tahun AND b.kd_urusan = :kd_urusan AND  b.kd_bidang = :kd_bidang AND  b.kd_unit = :kd_unit AND  b.kd_sub = :kd_sub AND  b.no_skpdMisi = :no_skpdMisi AND b.no_skpdTujuan = :no_skpdTujuan AND b.no_skpdSasaran = :no_skpdSasaran AND b.no_renjaProg = :no_renjaProg AND b.id_renprog = :id_renprog

                    ) b ON a.id = b.id AND a.urusan_id = b.urusan_id AND a.kd_urusan = b.kd_urusan AND a.kd_bidang = b.kd_bidang AND a.kd_unit = b.kd_unit AND a.kd_sub = b.kd_sub
                    AND a.no_skpdMisi = b.no_skpdMisi AND a.no_skpdTujuan = b.no_skpdTujuan AND a.no_skpdSasaran = b.no_skpdSasaran AND a.no_renjaProg = b.no_renjaProg AND a.id_renprog = b.id_renprog
                    AND a.id_renkeg = b.id_renkeg AND a.id_subkegiatan = b.id_subkegiatan
                    GROUP BY a.id, a.kd_urusan, a.kd_bidang, a.kd_unit, a.kd_sub, a.no_skpdMisi, a.no_skpdTujuan, a.no_skpdSasaran, a.no_renjaSas, a.no_renjaProg, a.id_renprog, a.program_renja,
                    a.id_renkeg, a.kegiatan_renja, a.pagu_kegiatan, a.pagu_musrenbang, a.kd_bahas            
                
                        ',
            'params' => [
                        ':tahun' => $model->tahun,
                        ':kd_urusan' => $model->kd_urusan,
                        ':kd_bidang' => $model->kd_bidang,
                        ':kd_unit' => $model->kd_unit,
                        ':kd_sub' => $model->kd_sub,
                        ':no_skpdMisi' => $model->no_skpdMisi,
                        ':no_skpdTujuan' => $model->no_skpdTujuan,
                        ':no_skpdSasaran' => $model->no_skpdSasaran,
                        ':no_renjaProg' => $model->no_renjaProg,
                        ':id_renprog' => $model->id_renprog
            ],
            'totalCount' => $totalCount,
            'sort' =>false, // to remove the table header sorting
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        
        $dataProvider->pagination->pageParam = 'kegiatan-page';
        
        //untuk program
        $model_s = $this->findRenjaprogram($id);
        if ($model->load(Yii::$app->request->post())) {
            IF($model->save()){
                $historis = new \common\models\Historis();
                $historis->kd_historis = 7;
                $historis->id_ref = $model_s['id'];
                $historis->created_at = $model_s['created_at'];
                $historis->updated_at = strtotime(DATE('Y-m-d'));
                $historis->tahun = $model_s['tahun'];
                $historis->urusan_id = $model_s['urusan_id'];
                $historis->bidang_id = $model_s['bidang_id'];
                $historis->kd_urusan = $model_s['kd_urusan'];
                $historis->kd_bidang = $model_s['kd_bidang'];
                $historis->kd_unit = $model_s['kd_unit'];
                $historis->kd_sub = $model_s['kd_sub'];
                $historis->no_skpdMisi = $model_s['no_skpdMisi'];
                $historis->no_skpdTujuan = $model_s['no_skpdTujuan'];
                $historis->no_skpdSasaran = $model_s['no_skpdSasaran'];
                $historis->no_renjaSas = $model_s['no_renjaSas'];
                $historis->no_renjaProg = $model_s['no_renjaProg'];
                $historis->id_renprog = $model_s['id_renprog'];
                $historis->uraian = $model_s['uraian'];
                $historis->pagu_program = $model_s['pagu_program'];
                $historis->input_phased = $model_s['input_phased'];
                $historis->status = $model_s['status'];
                $historis->status_phased = 6;
                //$historis->alasan_perubahan = $historis->alasan_perubahan;
                $historis->user_id = Yii::$app->user->identity->id;
                IF($historis->save()){
                    Yii::$app->session->setFlash('kv-detail-success', 'Perubahan Tersimpan.');
                    return $this->redirect(['renjaprogramview', 'id'=>$model->id]);
                }
            }
        }
        
        //untuk capaian program
        if (($capaian_post = Yii::$app->request->post()) && $capaian_post['RenjaProgramCapaian'] <> NULL) {
            $id_capaian = \common\models\RenjaProgramCapaian::find()->where([
                        'tahun' => $model->tahun, 
                        'urusan_id' => $model->urusan_id,
                        'bidang_id' => $model->bidang_id,
                        'kd_urusan' => $model->kd_urusan,
                        'kd_bidang' => $model->kd_bidang,
                        'kd_unit' => $model->kd_unit,
                        'kd_sub' => $model->kd_sub,
                        'no_skpdMisi' => $model->no_skpdMisi,
                        'no_skpdTujuan' => $model->no_skpdTujuan,
                        'no_skpdSasaran' => $model->no_skpdSasaran,
                        'no_renjaSas' => $model->no_renjaSas,
                        'no_renjaProg' => $model->no_renjaProg,
                        'id_renprog' => $model->id_renprog,
                        'no_indikator' => $capaian_post['RenjaProgramCapaian']['no_indikator']
                    ])->one();
            $historis = new \common\models\HistorisCapaian();
            $connection = \Yii::$app->db;
            $execute = $connection->createCommand()
                ->update('t_renja_program_capaian', 
                    [ //Bagian yang akan diubah @hoaaah
                        'uraian' => $capaian_post['RenjaProgramCapaian']['uraian'],
                        'target_angka' => $capaian_post['RenjaProgramCapaian']['target_angka'],
                    ],
                    [ //condition perubahan @hoaaah
                        'id' => $id_capaian['id'],
                    ]
                        );
            //var_dump($capaian_post['RkpdProgramCapaian']);
            //var_dump($id_capaian);
            IF($execute->execute()){
                $historis->kd_historis = 8;
                $historis->id_ref = $id_capaian['id'];
                $historis->created_at = $id_capaian['created_at'];
                $historis->updated_at = strtotime(DATE('Y-m-d'));
                $historis->tahun = $id_capaian['tahun'];
                $historis->urusan_id = $id_capaian['urusan_id'];
                $historis->bidang_id = $id_capaian['bidang_id'];
                $historis->kd_urusan = $id_capaian['kd_urusan'];
                $historis->kd_bidang = $id_capaian['kd_bidang'];
                $historis->kd_unit = $id_capaian['kd_unit'];
                $historis->kd_sub = $id_capaian['kd_sub'];
                $historis->no_skpdMisi = $id_capaian['no_skpdMisi'];
                $historis->no_skpdTujuan = $id_capaian['no_skpdTujuan'];
                $historis->no_skpdSasaran = $id_capaian['no_skpdSasaran'];
                $historis->no_renjaSas = $id_capaian['no_renjaSas'];
                $historis->no_renjaProg = $id_capaian['no_renjaProg'];
                $historis->id_renprog = $id_capaian['id_renprog'];
                $historis->no_indikator = $id_capaian['no_indikator'];
                $historis->tolok_ukur = $id_capaian['tolok_ukur'];
                $historis->target_angka = $id_capaian['target_angka'];
                $historis->target_uraian = $id_capaian['target_uraian'];
                $historis->kd_indikator_2 = $id_capaian['kd_indikator_2'];
                $historis->kd_indikator_3 = $id_capaian['kd_indikator_3'];
                $historis->keterangan = $id_capaian['keterangan'];
                $historis->uraian = $id_capaian['uraian'];
                $historis->input_phased = $id_capaian['input_phased'];
                $historis->status = $id_capaian['status'];
                $historis->status_phased = 6;
                //$historis->alasan_perubahan = $historis->alasan_perubahan;
                $historis->user_id = Yii::$app->user->identity->id;
                IF($historis->save()){
                    Yii::$app->session->setFlash('kv-detail-success', 'Perubahan Tersimpan.');
                    return $this->redirect(['renjaprogramview', 'id'=>$model->id]);
                }
            }
        }

        $jadwal = $this->cekjadwal();

        return $this->render('renjaprogramview', [
            'model' => $model,
            'capaian' => $capaian,
            'dataProvider' => $dataProvider,
            'jadwal' => $jadwal
        ]);
    }   

    public function actionRenjakegiatanview($id)
    {
        $model = $this->findRenjakegiatan($id);
        $capaian = $this->findRenjakegiatancapaian($model->tahun, $model->kd_urusan, $model->kd_bidang, $model->kd_unit, $model->kd_sub, $model->no_skpdMisi, $model->no_skpdTujuan, $model->no_skpdSasaran, $model->no_renjaSas, $model->no_renjaProg, $model->id_renprog, $model->id_renkeg);

        $filter = NEW \backend\modules\musrenbangrkpd\models\SubkegiatanSearch();

        $totalCount = Yii::$app->db->createCommand('
                    SELECT
                    COUNT(a.id)
                    FROM
                    (
                    SELECT
                    id, tahun, renja_kegiatan_id, uraian AS aktivitas_usulan, kd_kecamatan, kd_kelurahan, rw, rt, volume, satuan, harga_satuan, biaya, keterangan
                    FROM t_subkegiatan WHERE status_phased = 6 AND input_status = 2 AND renja_kegiatan_id = :renja_kegiatan_id
                    ) a LEFT JOIN
                    (
                    SELECT
                    id, tahun, renja_kegiatan_id, uraian AS aktivitas_usulan, kd_kecamatan, kd_kelurahan, rw, rt, volume, satuan, harga_satuan, biaya, keterangan
                    FROM t_ba_subkegiatan WHERE status_phased = 5 AND input_status = 2 AND renja_kegiatan_id = :renja_kegiatan_id
                    ) b ON a.id = b.id
                    LEFT JOIN
                    r_kecamatan c ON a.kd_kecamatan = c.id 
                    LEFT JOIN
                    r_desa d ON a.kd_kelurahan = d.id   
            ')
                    ->bindValue(':renja_kegiatan_id', $id)
                    ->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => '
                    SELECT
                    a.id, a.tahun, a.renja_kegiatan_id, a.aktivitas_usulan, a.kd_kecamatan, c.kecamatan, a.kd_kelurahan, d.desa, a.rw, a.rt, a.volume, a.satuan, a.harga_satuan, a.input_status,
                    a.biaya, b.biaya AS biaya_awal,
                    a.keterangan
                    FROM
                    (
                    SELECT
                    id, tahun, renja_kegiatan_id, uraian AS aktivitas_usulan, kd_kecamatan, kd_kelurahan, rw, rt, volume, satuan, harga_satuan, biaya, keterangan, input_status
                    FROM t_subkegiatan WHERE status_phased = 6 AND input_status = 2 AND renja_kegiatan_id = :renja_kegiatan_id
                    ) a LEFT JOIN
                    (
                    SELECT
                    id, tahun, renja_kegiatan_id, uraian AS aktivitas_usulan, kd_kecamatan, kd_kelurahan, rw, rt, volume, satuan, harga_satuan, biaya, keterangan
                    FROM t_ba_subkegiatan WHERE status_phased = 5 AND input_status = 2 AND renja_kegiatan_id = :renja_kegiatan_id
                    ) b ON a.id = b.id
                    LEFT JOIN
                    r_kecamatan c ON a.kd_kecamatan = c.id 
                    LEFT JOIN
                    r_desa d ON a.kd_kelurahan = d.id        
                
                        ',
            'params' => [
                        ':renja_kegiatan_id' => $id
            ],
            'totalCount' => $totalCount,
            'sort' =>false, // to remove the table header sorting
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        
        $dataProvider->pagination->pageParam = 'subkegiatan-page';
        
        //untuk program
        $model_s = $this->findRenjakegiatan($id);
        //var_dump($model);
        if ($model->load(Yii::$app->request->post())) {
            IF($model->save()){
                $historis = new \common\models\Historis();
                $historis->kd_historis = 9;
                $historis->id_ref = $model_s['id'];
                $historis->created_at = $model_s['created_at'];
                $historis->updated_at = strtotime(DATE('Y-m-d'));
                $historis->tahun = $model_s['tahun'];
                $historis->kd_urusan = $model_s['kd_urusan'];
                $historis->kd_bidang = $model_s['kd_bidang'];
                $historis->kd_unit = $model_s['kd_unit'];
                $historis->kd_sub = $model_s['kd_sub'];
                $historis->no_skpdMisi = $model_s['no_skpdMisi'];
                $historis->no_skpdTujuan = $model_s['no_skpdTujuan'];
                $historis->no_skpdSasaran = $model_s['no_skpdSasaran'];
                $historis->no_renjaSas = $model_s['no_renjaSas'];
                $historis->no_renjaProg = $model_s['no_renjaProg'];
                $historis->id_renprog = $model_s['id_renprog'];
                $historis->id_renkeg = $model_s['id_renkeg'];
                $historis->uraian = $model_s['uraian'];
                $historis->lokasi = $model_s['lokasi'];
                $historis->lokasi_maps = $model_s['lokasi_maps'];
                $historis->kelompok_sasaran = $model_s['kelompok_sasaran'];
                $historis->status_kegiatan = $model_s['status_kegiatan'];
                $historis->pagu_kegiatan = $model_s['pagu_kegiatan'];
                $historis->pagu_musrenbang = $model_s['pagu_musrenbang'];
                $historis->kd_asb = $model_s['kd_asb'];
                $historis->info_asb = $model_s['info_asb'];
                $historis->kd_bahas = $model_s['kd_bahas'];
                $historis->input_phased = $model_s['input_phased'];
                $historis->status = $model_s['status'];
                $historis->status_phased = 6;
                //$historis->alasan_perubahan = $historis->alasan_perubahan;
                $historis->user_id = Yii::$app->user->identity->id;
                IF($historis->save()){
                    Yii::$app->session->setFlash('kv-detail-success', 'Perubahan Tersimpan.');
                    return $this->redirect(['renjakegiatanview', 'id'=>$model->id]);
                }
            }
        }
        
        //untuk capaian program
        if (($capaian_post = Yii::$app->request->post()) && $capaian_post['RenjaKegiatanCapaian'] <> NULL) {
            $id_capaian = \common\models\RenjaKegiatanCapaian::find()->where([
                        'tahun' => $model->tahun, 
                        'kd_urusan' => $model->kd_urusan,
                        'kd_bidang' => $model->kd_bidang,
                        'kd_unit' => $model->kd_unit,
                        'kd_sub' => $model->kd_sub,
                        'no_skpdMisi' => $model->no_skpdMisi,
                        'no_skpdTujuan' => $model->no_skpdTujuan,
                        'no_skpdSasaran' => $model->no_skpdSasaran,
                        'no_renjaSas' => $model->no_renjaSas,
                        'no_renjaProg' => $model->no_renjaProg,
                        'id_renprog' => $model->id_renprog,
                        'id_renkeg' => $model->id_renkeg,
                        'no_indikator' => $capaian_post['RenjaKegiatanCapaian']['no_indikator']
                    ])->one();
            $historis = new \common\models\HistorisCapaian();
            $connection = \Yii::$app->db;
            $execute = $connection->createCommand()
                ->update('t_renja_kegiatan_capaian', 
                    [ //Bagian yang akan diubah @hoaaah
                        'uraian' => $capaian_post['RenjaKegiatanCapaian']['uraian'],
                        'target_angka' => $capaian_post['RenjaKegiatanCapaian']['target_angka'],
                    ],
                    [ //condition perubahan @hoaaah
                        'id' => $id_capaian['id'],
                    ]
                        );
            //var_dump($capaian_post['RkpdProgramCapaian']);
            //var_dump($id_capaian);
            IF($execute->execute()){
                $historis->kd_historis = 10;
                $historis->id_ref = $id_capaian['id'];
                $historis->created_at = $id_capaian['created_at'];
                $historis->updated_at = strtotime(DATE('Y-m-d'));
                $historis->tahun = $id_capaian['tahun'];
                $historis->kd_urusan = $id_capaian['kd_urusan'];
                $historis->kd_bidang = $id_capaian['kd_bidang'];
                $historis->kd_unit = $id_capaian['kd_unit'];
                $historis->kd_sub = $id_capaian['kd_sub'];
                $historis->no_skpdMisi = $id_capaian['no_skpdMisi'];
                $historis->no_skpdTujuan = $id_capaian['no_skpdTujuan'];
                $historis->no_skpdSasaran = $id_capaian['no_skpdSasaran'];
                $historis->no_renjaSas = $id_capaian['no_renjaSas'];
                $historis->no_renjaProg = $id_capaian['no_renjaProg'];
                $historis->id_renprog = $id_capaian['id_renprog'];
                $historis->id_renkeg = $id_capaian['id_renkeg'];
                $historis->no_indikator = $id_capaian['no_indikator'];
                $historis->tolok_ukur = $id_capaian['tolok_ukur'];
                $historis->target_angka = $id_capaian['target_angka'];
                $historis->target_uraian = $id_capaian['target_uraian'];
                $historis->kd_indikator_2 = $id_capaian['kd_indikator_2'];
                $historis->kd_indikator_3 = $id_capaian['kd_indikator_3'];
                $historis->keterangan = $id_capaian['keterangan'];
                $historis->uraian = $id_capaian['uraian'];
                $historis->input_phased = $id_capaian['input_phased'];
                $historis->status = $id_capaian['status'];
                $historis->status_phased = 6;
                //$historis->alasan_perubahan = $historis->alasan_perubahan;
                $historis->user_id = Yii::$app->user->identity->id;
                IF($historis->save()){
                    Yii::$app->session->setFlash('kv-detail-success', 'Perubahan Tersimpan.');
                    return $this->redirect(['renjakegiatanview', 'id'=>$model->id]);
                }
            }
        }

        $jadwal = $this->cekjadwal();        
       
        return $this->render('renjakegiatanview', [
            'model' => $model,
            'capaian' => $capaian,
            'dataProvider' => $dataProvider,
            'jadwal' => $jadwal,
            'filter' => $filter,
        ]);
    }        


    public function actionDetail($id)
    {
        $model = $this->findSubkegiatan($id);
        $status = NULL;
        IF($model->input_status == 3){
            $status = $this->findStatus($id);
        }
        $jadwal = \common\models\Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 3])->one();  
        if($model!==null){
            $photo = $this->findPhoto($id);
            return $this->renderAjax('usulanrinci', [
                'model' => $model,
                'photo' => $photo,
                'status' => $status,
                'jadwal' => $jadwal,
            ]);           
        } else{
            return "Terjadi kesalahan dengan inputan ini, mungkin kegiatan sudah dihapus. Anda hanya dapat menolak usulan ini.";
        }
    }


    /**
     * Finds the Subkegiatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subkegiatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findRkpdprogram($id)
    {
        if (($model = \common\models\RkpdProgram::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findRenjaprogram($id)
    {
        if (($model = \common\models\RenjaProgram::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findRenjakegiatan($id)
    {
        if (($model = \common\models\RenjaKegiatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findRkpdprogramcapaian($tahun, $urusan_id, $bidang_id, $no_misi, $no_tujuan, $no_sasaran, $kd_progrkpd, $id_progrkpd)
    {
        if (($model = \common\models\RkpdProgramCapaian::find()->where([
                        'tahun' => $tahun, 
                        'urusan_id' => $urusan_id,
                        'bidang_id' => $bidang_id,
                        'no_misi' => $no_misi,
                        'no_tujuan' => $no_tujuan,
                        'no_sasaran' => $no_sasaran,
                        'kd_progrkpd' => $kd_progrkpd,
                        'id_progrkpd' => $id_progrkpd
                    ])->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findRenjaprogramcapaian($tahun, $urusan_id, $bidang_id, $kd_urusan, $kd_bidang, $kd_unit, $kd_sub, $no_skpdMisi, $no_skpdTujuan, $no_skpdSasaran, $no_renjaSas, $no_renjaProg, $id_renprog)
    {
        if (($model = \common\models\RenjaProgramCapaian::find()->where([
                        'tahun' => $tahun, 
                        'urusan_id' => $urusan_id,
                        'bidang_id' => $bidang_id,
                        'kd_urusan' => $kd_urusan,
                        'kd_bidang' => $kd_bidang,
                        'kd_unit' => $kd_unit,
                        'kd_sub' => $kd_sub,
                        'no_skpdMisi' => $no_skpdMisi,
                        'no_skpdTujuan' => $no_skpdTujuan,
                        'no_skpdSasaran' => $no_skpdSasaran,
                        'no_renjaSas' => $no_renjaSas,
                        'no_renjaProg' => $no_renjaProg,
                        'id_renprog' => $id_renprog
                    ])->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page doesn\'t exist.');
        }
    }

    protected function findRenjakegiatancapaian($tahun, $kd_urusan, $kd_bidang, $kd_unit, $kd_sub, $no_skpdMisi, $no_skpdTujuan, $no_skpdSasaran, $no_renjaSas, $no_renjaProg, $id_renprog, $id_renkeg)
    {
        if (($model = \common\models\RenjaKegiatanCapaian::find()->where([
                        'tahun' => $tahun,
                        'kd_urusan' => $kd_urusan,
                        'kd_bidang' => $kd_bidang,
                        'kd_unit' => $kd_unit,
                        'kd_sub' => $kd_sub,
                        'no_skpdMisi' => $no_skpdMisi,
                        'no_skpdTujuan' => $no_skpdTujuan,
                        'no_skpdSasaran' => $no_skpdSasaran,
                        'no_renjaSas' => $no_renjaSas,
                        'no_renjaProg' => $no_renjaProg,
                        'id_renprog' => $id_renprog,
                        'id_renkeg' => $id_renkeg
                    ])->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page doesn\'t exist.');
        }
    }    

    protected function findSubkegiatan($id)
    {
        if (($model = \common\models\Subkegiatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }    

    protected function findPhoto($id)
    {
        if (($model = SubkegiatanPhoto::find()->where('musrenbang_id='.$id)->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }  

    protected function findKegiatan($id)
    {
        if (($model = RenjaKegiatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findStatus($id)
    {
        if (($model = TStatus::find()->where('id_ref='.$id)->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    } 

    protected function cekjadwal(){
        //control cek jadwal --@hoaaah
        $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 6])->one();
        IF( DATE('Y-m-d') >= $jadwal['tgl_mulai'] && DATE('Y-m-d') <= $jadwal['tgl_selesai'] ){
            return true;
        }else{
            return false;
        }
    }

}
