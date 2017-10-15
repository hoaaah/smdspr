<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tperan */

$this->title = 'Data Lokasi '.$model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Lokasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->user->username;
?>
<div class="tperan-view">

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
/*            'user_id',
            'kd_urusan',
            'kd_bidang',
            'kd_unit',
            'kd_sub',
 */ 
            'kd_kecamatan',
            [   'attribute'=>'Kecamatan',
                'value'=> $model->kecamatan->kecamatan,
            ],   
            'kd_kelurahan',            
            [   'attribute'=>'Kelurahan/Desa',
                'value'=> $model->kelurahan->desa,
            ],                     
            'rw',
            'rt',
        ],
    ]) ?>

</div>
