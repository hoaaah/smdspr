<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tperans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tperan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tperan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'kd_urusan',
            'kd_bidang',
            'kd_unit',
            // 'kd_sub',
            // 'kd_kecamatan',
            // 'kd_kelurahan',
            // 'rw',
            // 'rt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
