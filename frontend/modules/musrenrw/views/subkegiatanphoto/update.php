<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SubkegiatanPhoto */

$this->title = 'Update Subkegiatan Photo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Subkegiatan Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subkegiatan-photo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
