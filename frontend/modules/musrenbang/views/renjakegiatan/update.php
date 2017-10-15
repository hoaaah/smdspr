<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TRenjaKegiatan */

$this->title = 'Update Trenja Kegiatan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Trenja Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trenja-kegiatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
