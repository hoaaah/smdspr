<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Subkegiatan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Subkegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subkegiatan-view">

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
            'renja_kegiatan_id',
            'uraian',
            'kd_kecamatan',
            'kd_kelurahan',
            'rw',
            'rt',
            'lokasi',
            'volume',
            'satuan',
            'harga_satuan',
            'biaya',
            'keterangan:ntext',
            'kd_asb',
            'input_phased',
            'status_phased',
            'input_status',
            'created_at',
            'updated_at',
            'user_id',
        ],
    ]) ?>

</div>
