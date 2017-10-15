<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TRenjaKegiatan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Trenja Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trenja-kegiatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'renja_program_id',
            'tahun',
            'kd_urusan',
            'kd_bidang',
            'kd_unit',
            'kd_sub',
            'no_skpdMisi',
            'no_skpdTujuan',
            'no_skpdSasaran',
            'no_renjaSas',
            'no_renjaProg',
            'id_renprog',
            'id_renkeg',
            'uraian',
            'lokasi',
            'lokasi_maps',
            'kelompok_sasaran',
            'status_kegiatan',
            'pagu_kegiatan',
            'pagu_musrenbang',
            'kd_asb',
            'info_asb',
            'kd_bahas',
            'created_at',
            'updated_at',
            'user_id',
            'input_phased',
            'status',
            'status_phased',
        ],
    ]) ?>

</div>
