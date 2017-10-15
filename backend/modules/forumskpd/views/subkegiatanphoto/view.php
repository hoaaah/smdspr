<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SubkegiatanPhoto */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Subkegiatan Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subkegiatan-photo-view">

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
            'musrenbang_id',
            'file',
            'caption',
            'created_at',
            'updated_at',
            'user_id',
        ],
    ]) ?>

</div>
