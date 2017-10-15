<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TRkpdProgram */

$this->title = 'Update Trkpd Program: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Trkpd Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trkpd-program-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
