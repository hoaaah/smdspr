<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tperan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tperans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tperan-view">

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
            'user_id',
            'kd_urusan',
            'kd_bidang',
            'kd_unit',
            'kd_sub',
            'kd_kecamatan',
            'kd_kelurahan',
            'rw',
            'rt',
        ],
    ]) ?>

</div>
