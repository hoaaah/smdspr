<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaIndikatorKegiatanSkpd */

$this->title = $model->ID_Tahun;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ta Indikator Kegiatan Skpds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-indikator-kegiatan-skpd-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran, 'Kd_Prog' => $model->Kd_Prog, 'ID_Prog' => $model->ID_Prog, 'Kd_Keg' => $model->Kd_Keg, 'No_ID' => $model->No_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran, 'Kd_Prog' => $model->Kd_Prog, 'ID_Prog' => $model->ID_Prog, 'Kd_Keg' => $model->Kd_Keg, 'No_ID' => $model->No_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID_Tahun',
            'Kd_Prov',
            'Kd_Kab_Kota',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'No_Misi',
            'No_Tujuan',
            'No_Sasaran',
            'Kd_Prog',
            'ID_Prog',
            'Kd_Keg',
            'No_ID',
            'Kd_Indikator_1',
            'Kd_Indikator_2',
            'Kd_Indikator_3',
            'Tolak_Ukur',
            'Target_Uraian',
            'Kondisi_Kinerja_Awal',
            'NilaiTahun1',
            'NilaiTahun2',
            'NilaiTahun3',
            'NilaiTahun4',
            'NilaiTahun5',
            'Satuan',
            'Keterangan',
        ],
    ]) ?>

</div>
