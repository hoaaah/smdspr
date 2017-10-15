<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaIndikatorProgRenstra */

$this->title = $model->ID_Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Indikator Prog Renstras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-indikator-prog-renstra-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Perubahan' => $model->Kd_Perubahan, 'Kd_Dokumen' => $model->Kd_Dokumen, 'Kd_Usulan' => $model->Kd_Usulan, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran, 'Kd_Prog' => $model->Kd_Prog, 'ID_Prog' => $model->ID_Prog, 'No_Ind_Prog' => $model->No_Ind_Prog], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Perubahan' => $model->Kd_Perubahan, 'Kd_Dokumen' => $model->Kd_Dokumen, 'Kd_Usulan' => $model->Kd_Usulan, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran, 'Kd_Prog' => $model->Kd_Prog, 'ID_Prog' => $model->ID_Prog, 'No_Ind_Prog' => $model->No_Ind_Prog], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
            'Kd_Perubahan',
            'Kd_Dokumen',
            'Kd_Usulan',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'No_Misi',
            'No_Tujuan',
            'No_Sasaran',
            'Kd_Prog',
            'ID_Prog',
            'No_Ind_Prog',
            'Jn_Indikator',
            'Jn_Indikator2',
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
