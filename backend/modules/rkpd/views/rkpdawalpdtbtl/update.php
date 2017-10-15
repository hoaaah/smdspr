<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RkpdProgram */

$this->title = 'Update Rkpd Program: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rkpd Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rkpd-program-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'capaian' => (empty($capaian)) ? [new \common\models\RkpdProgramCapaian] : $capaian
    ]) ?>

</div>
