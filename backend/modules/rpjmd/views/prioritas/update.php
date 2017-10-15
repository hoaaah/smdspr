<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TRpjmdPrioritas */

$this->title = 'Ubah Prioritas: ' . $model->id;
$this->params['breadcrumbs'][] = 'RPJMD';
$this->params['breadcrumbs'][] = ['label' => 'Prioritas Daerah', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trpjmd-prioritas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
