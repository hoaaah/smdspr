<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Jadwal */

$this->title = 'Update Jadwal: ' . $model->id;
$this->params['breadcrumbs'][] = 'Parameter';
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Input', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jadwal-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
