<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Proses */

$this->title = 'Berita Acara '.$model->no_ba;
$this->params['breadcrumbs'][] = ['label' => 'Usulan SKPD', 'url' => ['subkegiatan/index']];
$this->params['breadcrumbs'][] = ['label' => 'Berita Acara', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->no_ba;
?>
<div class="proses-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Anda yakin ingin menghapus berita acara ini?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tahun',
            'kelurahan.desa',
            'no_ba',
            'tanggal_ba:date',
            'penandatangan',
            'nip_penandatangan',
            'jabatan_penandatangan',
        ],
    ]) ?>

</div>
