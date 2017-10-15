<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tperan */

$this->title = 'Update Tperan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tperans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tperan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
