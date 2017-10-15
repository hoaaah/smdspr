<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaPemdaUmum */

$this->title = 'Update Ta Pemda Umum: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Ta Pemda Umums', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-pemda-umum-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
