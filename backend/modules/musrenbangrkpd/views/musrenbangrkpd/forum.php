<div class="row">
<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\data\SqlDataProvider;
use yii\widgets\Pjax;
use backend\assets\UsulanAsset;
use yii\bootstrap\Modal;
$image = backend\assets\UsulanAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\musrenbangdesa\models\SubkegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sinkronisasi RKPD-Renja '.(DATE('Y')+1);
$this->params['breadcrumbs'][] = ['label' => 'Musrenbang RKPD', 'url' => '#'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subkegiatan-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Musrenbang RKPD 2017</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">                 
                <?= GridView::widget([
                        'id' => 'kv-grid-rkpd',                    
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'export' => false, 
                        'responsive'=>true,
                        'hover'=>true,
                        //'panel'=>['type'=>'primary', 'heading'=>'Daftar Kegiatan Rencana Kerja 2017'],                        
                        'summary' => "<small>Menampilkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> Usulan</small>",
                        'emptyText' => '<small><i>Tidak ada Usulan sampai saat ini.</i></small>',
                        'pjax'=>true,
                        'pjaxSettings'=>[
                            'options' => ['id' => 'rkpd-pjax', 'timeout' => 5000],
                        ],                                            
                        'columns' => [
                            //['class' => 'kartik\grid\SerialColumn'],
                            // [
                            //     'class' => 'kartik\grid\ExpandRowColumn',
                            //     'value' => function ($model, $key, $index, $column) {

                            //         return GridView::ROW_COLLAPSED;
                            //     },
                            //     'expandIcon' => '<span class="label label-default">+++</span>',
                            //     'expandTitle' => 'Program Renja',
                            //     'collapseIcon' => '<span class="label label-default">+++</span>',
                            //     'collapseTitle' => 'Tutup',                                
                            //     'allowBatchToggle'=>true,
                            //     'detail'=>function ($model, $key, $index, $column) {
                            //         $program_id = [];
                            //         $id = $model['id'];
                            //         $connection = \Yii::$app->db;  
                            //         $program = $connection->createCommand("
                            //                 SELECT
                            //                     d.id
                            //                 FROM
                            //                     t_rkpd_program AS a
                            //                 INNER JOIN ta_program_rpjmd AS b ON a.id_tahun = b.ID_Tahun
                            //                 AND a.Kd_Perubahan_Rpjmd = b.Kd_Perubahan
                            //                 AND a.Kd_Dokumen_Rpjmd = b.Kd_Dokumen
                            //                 AND a.Kd_Usulan_Rpjmd = b.Kd_Usulan
                            //                 AND a.No_Misi_Rpjmd = b.No_Misi
                            //                 AND a.No_Tujuan_Rpjmd = b.No_Tujuan
                            //                 AND a.No_Sasaran_Rpjmd = b.No_Sasaran
                            //                 AND a.Kd_Prog_Rpjmd = b.Kd_Prog
                            //                 AND a.ID_Prog_Rpjmd = b.Id_Prog
                            //                 INNER JOIN ta_renstra AS c ON c.ID_Tahun = b.ID_Tahun
                            //                 AND c.No_Misi1 = b.No_Misi
                            //                 AND c.No_Tujuan1 = b.No_Tujuan
                            //                 AND c.No_Sasaran1 = b.No_Sasaran
                            //                 AND c.Kd_Prog1 = b.Kd_Prog
                            //                 AND c.ID_Prog1 = b.Id_Prog
                            //                 INNER JOIN t_renja_program AS d ON d.id_tahun = c.ID_Tahun
                            //                 AND d.Kd_Perubahan_Renstra = c.Kd_Perubahan
                            //                 AND d.Kd_Dokumen_Renstra = c.Kd_Dokumen
                            //                 AND d.Kd_Usulan_Renstra = c.Kd_Usulan
                            //                 AND d.Kd_Urusan_Renstra = c.Kd_Urusan
                            //                 AND d.Kd_Bidang_Renstra = c.Kd_Bidang
                            //                 AND d.Kd_Unit_Renstra = c.Kd_Unit
                            //                 AND d.No_Misi_Renstra = c.No_Misi
                            //                 AND d.No_Tujuan_Renstra = c.No_Tujuan
                            //                 AND d.No_Sasaran_Renstra = c.No_Sasaran
                            //                 AND d.Kd_Prog_Renstra = c.Kd_Prog
                            //                 AND d.ID_Prog_Renstra = c.ID_Prog
                            //                 WHERE
                            //                     a.id = $id

                            //             ")->queryAll();
                            //         foreach($program AS $p){
                            //             $program_id = $program['id'];
                            //         }

                            //         $totalCount = Yii::$app->db->createCommand('
                            //                 SELECT COUNT(b.id)
                            //                 FROM
                            //                 (
                            //                     SELECT
                            //                     /*a.status_phased, a.input_status, b.status_phased, b.status, c.status_phased, c.status, f.status_phased, f.status,*/
                            //                     c.id, c.urusan_id, c.bidang_id, c.uraian,
                            //                     f.tahun, f.no_misi, f.no_tujuan, f.no_sasaran, f.kd_progrkpd, f.id_progrkpd, f.pagu_program AS pagu_program_rkpd, f.uraian AS program_rkpd, f.urusan_id AS urusan_rkpd, f.bidang_id AS bidang_rkpd,
                            //                     c.kd_urusan, c.kd_bidang, c.kd_unit, c.kd_sub, c.no_skpdMisi, c.no_skpdTujuan, c.no_skpdSasaran, c.no_renjaSas, c.no_renjaProg, c.id_renprog, c.pagu_program AS pagu_program_renja, c.uraian AS program_renja,
                            //                     b.id_renkeg, b.pagu_kegiatan, b.pagu_musrenbang, b.kd_bahas, b.uraian AS kegiatan_renja,
                            //                     a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt, a.volume, a.satuan, a.biaya, a.uraian AS subkegiatan_renja
                            //                     FROM t_subkegiatan a 
                            //                     LEFT JOIN t_renja_kegiatan b ON a.renja_kegiatan_id = b.id 
                            //                     LEFT JOIN t_renja_program c ON b.tahun = c.tahun AND b.kd_urusan = c.kd_urusan AND b.kd_bidang = c.kd_bidang AND b.kd_unit = c.kd_unit AND b.kd_sub = c.kd_sub AND b.no_skpdMisi = c.no_skpdMisi AND b.no_skpdTujuan = c.no_skpdTujuan AND b.no_skpdSasaran = c.no_skpdSasaran AND b.no_renjaSas = c.no_renjaSas AND b.no_renjaProg = c.no_renjaProg
                            //                     LEFT JOIN ta_renstra d ON c.id_tahun = d.ID_Tahun AND c.Kd_Perubahan_Renstra = d.Kd_Perubahan AND c.Kd_Dokumen_Renstra = d.Kd_Dokumen AND c.Kd_Usulan_Renstra = d.Kd_Usulan AND c.Kd_Urusan_Renstra = d.Kd_Urusan AND c.Kd_Bidang_Renstra = d.Kd_Bidang AND c.Kd_Unit_Renstra = d.Kd_Unit AND c.No_Misi_Renstra = d.No_Misi AND c.No_Tujuan_Renstra = d.No_Tujuan AND c.No_Sasaran_Renstra = d.No_Sasaran AND c.Kd_Prog_Renstra = d.Kd_Prog AND c.ID_Prog_Renstra = d.ID_Prog 
                            //                     LEFT JOIN ta_program_rpjmd e ON d.Kd_Urusan1 = e.Kd_Urusan1 AND d.Kd_Bidang1 = e.Kd_Bidang1 AND d.No_Misi1 = e.No_Misi AND d.No_Tujuan1 = e.No_Tujuan AND d.No_Sasaran1 = e.No_Sasaran AND d.Kd_Prog1 = e.Kd_Prog AND d.ID_Prog1 = e.Id_Prog 
                            //                     LEFT JOIN t_rkpd_program f ON f.ID_Tahun = e.ID_Tahun AND f.Kd_Perubahan_Rpjmd = e.Kd_Perubahan AND f.Kd_Dokumen_Rpjmd = e.Kd_Dokumen AND f.Kd_Usulan_Rpjmd = e.Kd_Usulan AND f.No_Misi_Rpjmd = e.No_Misi AND f.No_Tujuan_Rpjmd = e.No_Tujuan AND f.No_Sasaran_Rpjmd = e.No_Sasaran AND f.Kd_Prog_Rpjmd = e.Kd_Prog AND f.ID_Prog_Rpjmd = e.Id_Prog
                            //                     WHERE a.status_phased = 6 AND a.input_status = 2 AND f.tahun = :tahun AND f.urusan_id = :urusan_id AND f.bidang_id = :bidang_id AND f.no_misi = :no_misi AND f.no_tujuan = :no_tujuan AND f.no_sasaran = :no_sasaran AND f.kd_progrkpd = :kd_progrkpd AND f.id_progrkpd = :id_progrkpd

                            //                 )b
                            //                 LEFT JOIN
                            //                 (
                            //                     SELECT
                            //                     c.id, c.urusan_id, c.bidang_id, c.uraian,
                            //                     f.tahun, f.no_misi, f.no_tujuan, f.no_sasaran, f.kd_progrkpd, f.id_progrkpd, f.pagu_program AS pagu_program_rkpd, f.uraian AS program_rkpd, f.urusan_id AS urusan_rkpd, f.bidang_id AS bidang_rkpd,
                            //                     c.kd_urusan, c.kd_bidang, c.kd_unit, c.kd_sub, c.no_skpdMisi, c.no_skpdTujuan, c.no_skpdSasaran, c.no_renjaSas, c.no_renjaProg, c.id_renprog, c.pagu_program AS pagu_program_renja, c.uraian AS program_renja,
                            //                     b.id_renkeg, b.pagu_kegiatan, b.pagu_musrenbang, b.kd_bahas, b.uraian AS kegiatan_renja,
                            //                     a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt, a.volume, a.satuan, a.biaya, a.uraian AS subkegiatan_renja
                            //                     FROM t_ba_subkegiatan a 
                            //                     LEFT JOIN t_ba_renja_kegiatan b ON a.renja_kegiatan_id = b.id 
                            //                     LEFT JOIN t_ba_renja_program c ON b.tahun = c.tahun AND b.kd_urusan = c.kd_urusan AND b.kd_bidang = c.kd_bidang AND b.kd_unit = c.kd_unit AND b.kd_sub = c.kd_sub AND b.no_skpdMisi = c.no_skpdMisi AND b.no_skpdTujuan = c.no_skpdTujuan AND b.no_skpdSasaran = c.no_skpdSasaran AND b.no_renjaSas = c.no_renjaSas AND b.no_renjaProg = c.no_renjaProg
                            //                     LEFT JOIN ta_renstra d ON c.id_tahun = d.ID_Tahun AND c.Kd_Perubahan_Renstra = d.Kd_Perubahan AND c.Kd_Dokumen_Renstra = d.Kd_Dokumen AND c.Kd_Usulan_Renstra = d.Kd_Usulan AND c.Kd_Urusan_Renstra = d.Kd_Urusan AND c.Kd_Bidang_Renstra = d.Kd_Bidang AND c.Kd_Unit_Renstra = d.Kd_Unit AND c.No_Misi_Renstra = d.No_Misi AND c.No_Tujuan_Renstra = d.No_Tujuan AND c.No_Sasaran_Renstra = d.No_Sasaran AND c.Kd_Prog_Renstra = d.Kd_Prog AND c.ID_Prog_Renstra = d.ID_Prog 
                            //                     LEFT JOIN ta_program_rpjmd e ON d.Kd_Urusan1 = e.Kd_Urusan1 AND d.Kd_Bidang1 = e.Kd_Bidang1 AND d.No_Misi1 = e.No_Misi AND d.No_Tujuan1 = e.No_Tujuan AND d.No_Sasaran1 = e.No_Sasaran AND d.Kd_Prog1 = e.Kd_Prog AND d.ID_Prog1 = e.Id_Prog 
                            //                     LEFT JOIN t_ba_rkpd_program f ON f.ID_Tahun = e.ID_Tahun AND f.Kd_Perubahan_Rpjmd = e.Kd_Perubahan AND f.Kd_Dokumen_Rpjmd = e.Kd_Dokumen AND f.Kd_Usulan_Rpjmd = e.Kd_Usulan AND f.No_Misi_Rpjmd = e.No_Misi AND f.No_Tujuan_Rpjmd = e.No_Tujuan AND f.No_Sasaran_Rpjmd = e.No_Sasaran AND f.Kd_Prog_Rpjmd = e.Kd_Prog AND f.ID_Prog_Rpjmd = e.Id_Prog
                            //                     WHERE a.status_phased = 5 AND a.input_status = 2 AND f.tahun = :tahun AND f.urusan_id = :urusan_id AND f.bidang_id = :bidang_id AND f.no_misi = :no_misi AND f.no_tujuan = :no_tujuan AND f.no_sasaran = :no_sasaran AND f.kd_progrkpd = :kd_progrkpd AND f.id_progrkpd = :id_progrkpd

                            //                 )c ON b.tahun = c.tahun AND b.urusan_id = c.urusan_rkpd AND b.bidang_id = b.bidang_rkpd AND b.no_misi = b.no_misi AND b.no_tujuan = c.no_tujuan AND b.no_sasaran = c.no_sasaran AND b.kd_progrkpd = c.kd_progrkpd AND b.id_progrkpd = b.id_progrkpd
                            //                 GROUP BY b.id, b.tahun, b.urusan_id, b.bidang_id, b.kd_urusan, b.kd_bidang, b.kd_unit, b.kd_sub, b.no_skpdMisi, b.no_skpdTujuan, b.no_skpdSasaran, b.no_renjaSas, b.no_renjaProg, b.id_renprog
                            //                 ORDER BY b.id ASC  
                            //             ')
                            //                     ->bindValue(':tahun', (DATE('Y')+1))
                            //                     ->bindValue(':urusan_id', 1)
                            //                     ->bindValue(':bidang_id', 1)
                            //                     ->bindValue(':no_misi', 1)
                            //                     ->bindValue(':no_tujuan', 1)
                            //                     ->bindValue(':no_sasaran', 1)
                            //                     ->bindValue(':kd_progrkpd', 1)
                            //                     ->bindValue(':id_progrkpd', 1)
                            //                     ->queryScalar();

                            //         $dataProvider = new SqlDataProvider([
                            //             'sql' => '
                            //                 SELECT
                            //                     a.id,
                            //                     a.tahun,
                            //                     a.kd_urusan,
                            //                     a.kd_bidang,
                            //                     a.kd_unit,
                            //                     a.kd_sub,
                            //                     a.no_skpdMisi,
                            //                     a.no_skpdTujuan,
                            //                     a.no_skpdSasaran,
                            //                     a.no_renjaSas,
                            //                     a.no_renjaProg,
                            //                     a.id_renprog,
                            //                     a.uraian,
                            //                     a.pagu_program,
                            //                     IFNULL(b.pagu_program,0) AS pagu_program_awal,
                            //                     SUM(a.pagu_kegiatan) AS pagu_kegiatan,
                            //                     SUM(IFNULL(b.pagu_kegiatan,0)) AS pagu_kegiatan_awal,
                            //                     SUM(a.biaya) AS biaya,
                            //                     SUM(IFNULL(b.biaya,0)) AS biaya_awal
                            //                 FROM
                            //                     (
                            //                         SELECT
                            //                             t_renja_program.id,
                            //                             t_renja_program.tahun,
                            //                             t_renja_program.kd_urusan,
                            //                             t_renja_program.kd_bidang,
                            //                             t_renja_program.kd_unit,
                            //                             t_renja_program.kd_sub,
                            //                             t_renja_program.no_skpdMisi,
                            //                             t_renja_program.no_skpdTujuan,
                            //                             t_renja_program.no_skpdSasaran,
                            //                             t_renja_program.no_renjaSas,
                            //                             t_renja_program.no_renjaProg,
                            //                             t_renja_program.id_renprog,
                            //                             t_renja_program.uraian,
                            //                             t_renja_program.pagu_program,
                            //                             0 AS pagu_kegiatan,
                            //                             SUM(
                            //                                 IFNULL(t_subkegiatan.biaya, 0)
                            //                             ) AS biaya
                            //                         FROM
                            //                             t_renja_program
                            //                         LEFT JOIN t_renja_kegiatan ON t_renja_kegiatan.tahun = t_renja_program.tahun
                            //                         AND t_renja_kegiatan.kd_urusan = t_renja_program.kd_urusan
                            //                         AND t_renja_kegiatan.kd_bidang = t_renja_program.kd_bidang
                            //                         AND t_renja_kegiatan.kd_unit = t_renja_program.kd_unit
                            //                         AND t_renja_kegiatan.kd_sub = t_renja_program.kd_sub
                            //                         AND t_renja_kegiatan.no_skpdMisi = t_renja_program.no_skpdMisi
                            //                         AND t_renja_kegiatan.no_skpdTujuan = t_renja_program.no_skpdTujuan
                            //                         AND t_renja_kegiatan.no_skpdSasaran = t_renja_program.no_skpdSasaran
                            //                         AND t_renja_kegiatan.no_renjaSas = t_renja_program.no_renjaSas
                            //                         AND t_renja_kegiatan.no_renjaProg = t_renja_program.no_renjaProg
                            //                         AND t_renja_kegiatan.id_renprog = t_renja_program.id_renprog
                            //                         LEFT JOIN t_subkegiatan ON t_subkegiatan.renja_kegiatan_id = t_renja_kegiatan.id
                            //                         WHERE
                            //                             t_renja_program.id IN :program_id
                            //                         GROUP BY
                            //                             t_renja_program.id,
                            //                             t_renja_program.tahun,
                            //                             t_renja_program.kd_urusan,
                            //                             t_renja_program.kd_bidang,
                            //                             t_renja_program.kd_unit,
                            //                             t_renja_program.kd_sub,
                            //                             t_renja_program.no_skpdMisi,
                            //                             t_renja_program.no_skpdTujuan,
                            //                             t_renja_program.no_skpdSasaran,
                            //                             t_renja_program.no_renjaSas,
                            //                             t_renja_program.no_renjaProg,
                            //                             t_renja_program.id_renprog,
                            //                             t_renja_program.uraian,
                            //                             t_renja_program.pagu_program
                            //                         UNION ALL
                            //                             SELECT
                            //                                 t_renja_program.id,
                            //                                 t_renja_program.tahun,
                            //                                 t_renja_program.kd_urusan,
                            //                                 t_renja_program.kd_bidang,
                            //                                 t_renja_program.kd_unit,
                            //                                 t_renja_program.kd_sub,
                            //                                 t_renja_program.no_skpdMisi,
                            //                                 t_renja_program.no_skpdTujuan,
                            //                                 t_renja_program.no_skpdSasaran,
                            //                                 t_renja_program.no_renjaSas,
                            //                                 t_renja_program.no_renjaProg,
                            //                                 t_renja_program.id_renprog,
                            //                                 t_renja_program.uraian,
                            //                                 t_renja_program.pagu_program,
                            //                                 SUM(
                            //                                     IFNULL(
                            //                                         t_renja_kegiatan.pagu_kegiatan,
                            //                                         0
                            //                                     )
                            //                                 ) AS pagu_kegiatan,
                            //                                 0 AS biaya
                            //                             FROM
                            //                                 t_renja_program
                            //                             LEFT JOIN t_renja_kegiatan ON t_renja_kegiatan.tahun = t_renja_program.tahun
                            //                             AND t_renja_kegiatan.kd_urusan = t_renja_program.kd_urusan
                            //                             AND t_renja_kegiatan.kd_bidang = t_renja_program.kd_bidang
                            //                             AND t_renja_kegiatan.kd_unit = t_renja_program.kd_unit
                            //                             AND t_renja_kegiatan.kd_sub = t_renja_program.kd_sub
                            //                             AND t_renja_kegiatan.no_skpdMisi = t_renja_program.no_skpdMisi
                            //                             AND t_renja_kegiatan.no_skpdTujuan = t_renja_program.no_skpdTujuan
                            //                             AND t_renja_kegiatan.no_skpdSasaran = t_renja_program.no_skpdSasaran
                            //                             AND t_renja_kegiatan.no_renjaSas = t_renja_program.no_renjaSas
                            //                             AND t_renja_kegiatan.no_renjaProg = t_renja_program.no_renjaProg
                            //                             AND t_renja_kegiatan.id_renprog = t_renja_program.id_renprog
                            //                             WHERE
                            //                                 t_renja_program.id IN :program_id
                            //                             GROUP BY
                            //                                 t_renja_program.id,
                            //                                 t_renja_program.tahun,
                            //                                 t_renja_program.kd_urusan,
                            //                                 t_renja_program.kd_bidang,
                            //                                 t_renja_program.kd_unit,
                            //                                 t_renja_program.kd_sub,
                            //                                 t_renja_program.no_skpdMisi,
                            //                                 t_renja_program.no_skpdTujuan,
                            //                                 t_renja_program.no_skpdSasaran,
                            //                                 t_renja_program.no_renjaSas,
                            //                                 t_renja_program.no_renjaProg,
                            //                                 t_renja_program.id_renprog,
                            //                                 t_renja_program.uraian,
                            //                                 t_renja_program.pagu_program
                            //                     ) a
                            //                 LEFT JOIN (
                            //                     SELECT
                            //                         t_ba_renja_program.id,
                            //                         t_ba_renja_program.tahun,
                            //                         t_ba_renja_program.kd_urusan,
                            //                         t_ba_renja_program.kd_bidang,
                            //                         t_ba_renja_program.kd_unit,
                            //                         t_ba_renja_program.kd_sub,
                            //                         t_ba_renja_program.no_skpdMisi,
                            //                         t_ba_renja_program.no_skpdTujuan,
                            //                         t_ba_renja_program.no_skpdSasaran,
                            //                         t_ba_renja_program.no_renjaSas,
                            //                         t_ba_renja_program.no_renjaProg,
                            //                         t_ba_renja_program.id_renprog,
                            //                         t_ba_renja_program.uraian,
                            //                         t_ba_renja_program.pagu_program,
                            //                         0 AS pagu_kegiatan,
                            //                         SUM(
                            //                             IFNULL(t_ba_subkegiatan.biaya, 0)
                            //                         ) AS biaya
                            //                     FROM
                            //                         t_ba_renja_program
                            //                     LEFT JOIN t_ba_renja_kegiatan ON t_ba_renja_kegiatan.tahun = t_ba_renja_program.tahun
                            //                     AND t_ba_renja_kegiatan.kd_urusan = t_ba_renja_program.kd_urusan
                            //                     AND t_ba_renja_kegiatan.kd_bidang = t_ba_renja_program.kd_bidang
                            //                     AND t_ba_renja_kegiatan.kd_unit = t_ba_renja_program.kd_unit
                            //                     AND t_ba_renja_kegiatan.kd_sub = t_ba_renja_program.kd_sub
                            //                     AND t_ba_renja_kegiatan.no_skpdMisi = t_ba_renja_program.no_skpdMisi
                            //                     AND t_ba_renja_kegiatan.no_skpdTujuan = t_ba_renja_program.no_skpdTujuan
                            //                     AND t_ba_renja_kegiatan.no_skpdSasaran = t_ba_renja_program.no_skpdSasaran
                            //                     AND t_ba_renja_kegiatan.no_renjaSas = t_ba_renja_program.no_renjaSas
                            //                     AND t_ba_renja_kegiatan.no_renjaProg = t_ba_renja_program.no_renjaProg
                            //                     AND t_ba_renja_kegiatan.id_renprog = t_ba_renja_program.id_renprog
                            //                     LEFT JOIN t_ba_subkegiatan ON t_ba_subkegiatan.renja_kegiatan_id = t_ba_renja_kegiatan.id
                            //                     WHERE
                            //                         t_ba_renja_program.id IN :program_id
                            //                     GROUP BY
                            //                         t_ba_renja_program.id,
                            //                         t_ba_renja_program.tahun,
                            //                         t_ba_renja_program.kd_urusan,
                            //                         t_ba_renja_program.kd_bidang,
                            //                         t_ba_renja_program.kd_unit,
                            //                         t_ba_renja_program.kd_sub,
                            //                         t_ba_renja_program.no_skpdMisi,
                            //                         t_ba_renja_program.no_skpdTujuan,
                            //                         t_ba_renja_program.no_skpdSasaran,
                            //                         t_ba_renja_program.no_renjaSas,
                            //                         t_ba_renja_program.no_renjaProg,
                            //                         t_ba_renja_program.id_renprog,
                            //                         t_ba_renja_program.uraian,
                            //                         t_ba_renja_program.pagu_program
                            //                     UNION ALL
                            //                         SELECT
                            //                             t_ba_renja_program.id,
                            //                             t_ba_renja_program.tahun,
                            //                             t_ba_renja_program.kd_urusan,
                            //                             t_ba_renja_program.kd_bidang,
                            //                             t_ba_renja_program.kd_unit,
                            //                             t_ba_renja_program.kd_sub,
                            //                             t_ba_renja_program.no_skpdMisi,
                            //                             t_ba_renja_program.no_skpdTujuan,
                            //                             t_ba_renja_program.no_skpdSasaran,
                            //                             t_ba_renja_program.no_renjaSas,
                            //                             t_ba_renja_program.no_renjaProg,
                            //                             t_ba_renja_program.id_renprog,
                            //                             t_ba_renja_program.uraian,
                            //                             t_ba_renja_program.pagu_program,
                            //                             SUM(
                            //                                 IFNULL(
                            //                                     t_ba_renja_kegiatan.pagu_kegiatan,
                            //                                     0
                            //                                 )
                            //                             ) AS pagu_kegiatan,
                            //                             0 AS biaya
                            //                         FROM
                            //                             t_ba_renja_program
                            //                         LEFT JOIN t_ba_renja_kegiatan ON t_ba_renja_kegiatan.tahun = t_ba_renja_program.tahun
                            //                         AND t_ba_renja_kegiatan.kd_urusan = t_ba_renja_program.kd_urusan
                            //                         AND t_ba_renja_kegiatan.kd_bidang = t_ba_renja_program.kd_bidang
                            //                         AND t_ba_renja_kegiatan.kd_unit = t_ba_renja_program.kd_unit
                            //                         AND t_ba_renja_kegiatan.kd_sub = t_ba_renja_program.kd_sub
                            //                         AND t_ba_renja_kegiatan.no_skpdMisi = t_ba_renja_program.no_skpdMisi
                            //                         AND t_ba_renja_kegiatan.no_skpdTujuan = t_ba_renja_program.no_skpdTujuan
                            //                         AND t_ba_renja_kegiatan.no_skpdSasaran = t_ba_renja_program.no_skpdSasaran
                            //                         AND t_ba_renja_kegiatan.no_renjaSas = t_ba_renja_program.no_renjaSas
                            //                         AND t_ba_renja_kegiatan.no_renjaProg = t_ba_renja_program.no_renjaProg
                            //                         AND t_ba_renja_kegiatan.id_renprog = t_ba_renja_program.id_renprog
                            //                         WHERE
                            //                             t_ba_renja_program.id IN :program_id
                            //                         GROUP BY
                            //                             t_ba_renja_program.id,
                            //                             t_ba_renja_program.tahun,
                            //                             t_ba_renja_program.kd_urusan,
                            //                             t_ba_renja_program.kd_bidang,
                            //                             t_ba_renja_program.kd_unit,
                            //                             t_ba_renja_program.kd_sub,
                            //                             t_ba_renja_program.no_skpdMisi,
                            //                             t_ba_renja_program.no_skpdTujuan,
                            //                             t_ba_renja_program.no_skpdSasaran,
                            //                             t_ba_renja_program.no_renjaSas,
                            //                             t_ba_renja_program.no_renjaProg,
                            //                             t_ba_renja_program.id_renprog,
                            //                             t_ba_renja_program.uraian,
                            //                             t_ba_renja_program.pagu_program
                            //                 ) b ON a.id = b.id
                            //                 AND a.tahun = b.tahun
                            //                 AND a.kd_urusan = b.kd_urusan
                            //                 AND a.kd_bidang = b.kd_bidang
                            //                 AND a.kd_unit = b.kd_unit
                            //                 AND a.kd_sub = b.kd_sub
                            //                 AND a.no_skpdMisi = b.no_skpdMisi
                            //                 AND a.no_skpdTujuan = b.no_skpdTujuan
                            //                 AND a.no_skpdSasaran = b.no_skpdSasaran
                            //                 AND a.no_renjaSas = b.no_renjaSas
                            //                 AND a.no_renjaProg = b.no_renjaProg
                            //                 AND a.id_renprog = b.id_renprog
                            //                 GROUP BY
                            //                     a.id,
                            //                     a.tahun,
                            //                     a.kd_urusan,
                            //                     a.kd_bidang,
                            //                     a.kd_unit,
                            //                     a.kd_sub,
                            //                     a.no_skpdMisi,
                            //                     a.no_skpdTujuan,
                            //                     a.no_skpdSasaran,
                            //                     a.no_renjaSas,
                            //                     a.no_renjaProg,
                            //                     a.id_renprog,
                            //                     a.uraian,
                            //                     a.pagu_program            

                            //                         ',
                            //             'params' => [
                            //                     ':program_id' => $program_id,
                            //             ],
                            //             'totalCount' => $totalCount,
                            //             'sort' =>false, // to remove the table header sorting
                            //             'pagination' => [
                            //                 'pageSize' => 50,
                            //             ],
                            //         ]);
                            //         $dataProvider->pagination->pageParam = 'program-page';
                            //         //$dataProvider->sort->sortParam = 'program-sort';

                            //         return Yii::$app->controller->renderPartial('_program', [
                            //             'model'=>$model,
                            //             'dataProvider' => $dataProvider,
                            //             ]);
                            //     },
                            //     'detailOptions'=>[
                            //         'class'=> 'kv-state-enable',
                            //     ],

                            // ],
                            //'tahun',
                            [
                                'label' => 'Program RKPD',
                                //'attribute' => 'Program',
                                'format' => 'raw',
                                'contentOptions' => ['style' => ['max-width' => '280px;', 'overflow' => 'hidden;' ]],
                                'value' => function($model){
                                    return Html::a($model['uraian'], ['rkpdprogramview', 'id' => $model['id']]/*, ['target'=>'_blank', 'data-pjax'=>"0"]*/);
                                }
                            ],
                            [
                                'label' => '-',
                                'format' => 'raw',
                                'value'=> function($model){
                                    return 'Awal/Forum SKPD<br /><hr />Saat Ini';
                                }
                                
                            ],                            
                            [
                                'label' => 'Program RKPD',
                                'format' => 'raw',
                                'value'=> function($model){
                                    $program_id = [];
                                    $id = $model['id'];
                                    $connection = \Yii::$app->db;  
                                    $program = $connection->createCommand("
                                            SELECT
                                                d.id
                                            FROM
                                                t_rkpd_program AS a
                                            INNER JOIN ta_program_rpjmd AS b ON a.id_tahun = b.ID_Tahun
                                            AND a.Kd_Perubahan_Rpjmd = b.Kd_Perubahan
                                            AND a.Kd_Dokumen_Rpjmd = b.Kd_Dokumen
                                            AND a.Kd_Usulan_Rpjmd = b.Kd_Usulan
                                            AND a.No_Misi_Rpjmd = b.No_Misi
                                            AND a.No_Tujuan_Rpjmd = b.No_Tujuan
                                            AND a.No_Sasaran_Rpjmd = b.No_Sasaran
                                            AND a.Kd_Prog_Rpjmd = b.Kd_Prog
                                            AND a.ID_Prog_Rpjmd = b.Id_Prog
                                            INNER JOIN ta_renstra AS c ON c.ID_Tahun = b.ID_Tahun
                                            AND c.No_Misi1 = b.No_Misi
                                            AND c.No_Tujuan1 = b.No_Tujuan
                                            AND c.No_Sasaran1 = b.No_Sasaran
                                            AND c.Kd_Prog1 = b.Kd_Prog
                                            AND c.ID_Prog1 = b.Id_Prog
                                            INNER JOIN t_renja_program AS d ON d.id_tahun = c.ID_Tahun
                                            AND d.Kd_Perubahan_Renstra = c.Kd_Perubahan
                                            AND d.Kd_Dokumen_Renstra = c.Kd_Dokumen
                                            AND d.Kd_Usulan_Renstra = c.Kd_Usulan
                                            AND d.Kd_Urusan_Renstra = c.Kd_Urusan
                                            AND d.Kd_Bidang_Renstra = c.Kd_Bidang
                                            AND d.Kd_Unit_Renstra = c.Kd_Unit
                                            AND d.No_Misi_Renstra = c.No_Misi
                                            AND d.No_Tujuan_Renstra = c.No_Tujuan
                                            AND d.No_Sasaran_Renstra = c.No_Sasaran
                                            AND d.Kd_Prog_Renstra = c.Kd_Prog
                                            AND d.ID_Prog_Renstra = c.ID_Prog
                                            WHERE
                                                a.id = $id

                                        ")->queryAll();
                                    // foreach($program AS $p){
                                    //     $program_id = $program['id'];
                                    // } 
                                    return print_r($program);                                   
                                    //return number_format($model['pagu_program_awal'], 0, ',' ,'.').'<br /><hr />'.number_format($model['pagu_program'], 0, ',' ,'.');
                                }
                                
                            ],
                            [
                                'label' => 'Program Renja',
                                'format' => 'raw',
                                'value'=> function($model){
                                    return number_format($model['pagu_program_renja_awal'], 0, ',' ,'.').'<br /><hr />'.number_format($model['pagu_program_renja'], 0, ',' ,'.');
                                }
                                
                            ],
                            [
                                'label' => 'Kegiatan Renja',
                                'format' => 'raw',
                                'value'=> function($model){
                                    return number_format($model['pagu_kegiatan_renja_awal'], 0, ',' ,'.').'<br /><hr />'.number_format($model['pagu_kegiatan_renja'], 0, ',' ,'.');
                                }
                                
                            ],                             
                            [
                                'label' => 'Aktivitas Usulan',
                                'format' => 'raw',
                                'value'=> function($model){
                                    return number_format($model['biaya_awal'], 0, ',' ,'.').'<br /><hr />'.number_format($model['biaya'], 0, ',' ,'.');
                                }
                                
                            ],    
                            /*                                            
                            [
                                'label' => 'Pembahasan Musren RKPD',
                                'format' => 'raw',
                                'value'=> function($model){
                                    return '970.000.000';
                                }
                                
                            ],                                                                                                            
                            [
                                'label' => 'Perbandingan',
                                'format' => 'raw',
                                'value'=> function($model){
                                    return Html::a('<button type="button" class="btn btn-xs btn-default">Ubah Capaian Program</button>', '#',['onclick'=>'detail(this,1);return false;']);
                                }
                                
                            ], 

                            ['class' => 'yii\grid\ActionColumn'],
                            */
                        ],
                    ]); ?>                
            </div> <!--box-body-->

        <p>
            <?php // Html::a('Tambah Usulan', ['create'], ['class' => 'btn btn-xs btn-success']) ?>
        </p>            
        </div><!--box-->
    </div><!--col12-->

</div><!--subkegiatan-->
</div><!--row-->
<?php 
$this->registerJs('
        function kegiatan(obj,person_id){
            /*
                <table> 
                    <tr>
                        <td>
                            <a> */
            var a = obj; // get element anchor
            var td = $(a).parent(); // get parent dari element anchor = td
            var tr = $(td).parent(); // get element tr
            var tdCount = $(tr).children().length; // get jumlah kolom pada tr
            var table = $(tr).parent(); // get element table
            $(table).children(".trDetail").remove(); // initialise, drop all of child with class trDetail
             
            var trDetail = document.createElement("tr"); // create element tr for detail
            $(trDetail).attr("class","trDetail"); // add class trDetail for element tr 
            var tdDetail = document.createElement("td"); // create element td for detail tr
            $(tdDetail).attr("colspan",tdCount); // add element coolspan at td
            $(tdDetail).html("<span class=\'fa fa-spinner fa-spin\'></span>"); // loader kaka.. <img src="http://www.hafidmukhlasin.com/wp-includes/images/smilies/icon_smile.gif" alt=":)" class="wp-smiley"> 
             
            // get content via ajax
            $.get("'.\yii\helpers\Url::to(['musrenbangrkpd/kegiatan']).'&id="+person_id, function( data ) {
              $(tdDetail).html( data );
            }).fail(function() {
                alert( "Terjadi Kesalahan Coba refresh halaman ini." );
              });
            $(trDetail).append(tdDetail); // add td to tr
            $(tr).after(trDetail);  // add tr to table
        }
     
', \yii\web\View::POS_HEAD) ?>
<?php 
$this->registerJs('
        function subkegiatan(obj,person_id){
            /*
                <table> 
                    <tr>
                        <td>
                            <a> */
            var a = obj; // get element anchor
            var td = $(a).parent(); // get parent dari element anchor = td
            var tr = $(td).parent(); // get element tr
            var tdCount = $(tr).children().length; // get jumlah kolom pada tr
            var table = $(tr).parent(); // get element table
            $(table).children(".trDetail").remove(); // initialise, drop all of child with class trDetail
             
            var trDetail = document.createElement("tr"); // create element tr for detail
            $(trDetail).attr("class","trDetail"); // add class trDetail for element tr 
            var tdDetail = document.createElement("td"); // create element td for detail tr
            $(tdDetail).attr("colspan",tdCount); // add element coolspan at td
            $(tdDetail).html("<span class=\'fa fa-spinner fa-spin\'></span>"); // loader kaka.. <img src="http://www.hafidmukhlasin.com/wp-includes/images/smilies/icon_smile.gif" alt=":)" class="wp-smiley"> 
             
            // get content via ajax
            $.get("'.\yii\helpers\Url::to(['musrenbangrkpd/subkegiatan']).'&id="+person_id, function( data ) {
              $(tdDetail).html( data );
            }).fail(function() {
                alert( "Terjadi Kesalahan Coba refresh halaman ini." );
              });
            $(trDetail).append(tdDetail); // add td to tr
            $(tr).after(trDetail);  // add tr to table
        }
     
', \yii\web\View::POS_HEAD) ?>
<?php
Modal::begin([
    'id' => 'myModal',
    'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
]);
 
echo '...';
 
Modal::end();

Modal::begin([
    'id' => 'myModalkegiatan',
    'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
]);
 
echo '...';
 
Modal::end();

$this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
");
$this->registerJs("
    $('#myModalkegiatan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
       
");
$this->registerJs('');
?>

