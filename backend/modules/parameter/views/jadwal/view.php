<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Jadwal */

$this->title = 'Jadwal: '.$model->id;
$this->params['breadcrumbs'][] = 'Parameter';
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Input', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwal-view">

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
            'input_phased',
            'tahun',
            'tgl_mulai',
            'tgl_selesai',
            'keterangan',
            'created_at',
            'updated_at',
            'user_id',
        ],
    ]) ?>

</div>
