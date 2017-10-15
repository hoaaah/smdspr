<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaPeriode */

$this->title = 'Tambah Periode';
$this->params['breadcrumbs'][] = 'RPJMD';
$this->params['breadcrumbs'][] = ['label' => 'Periode', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-periode-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
