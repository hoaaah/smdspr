<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaPeriode */

$this->title = 'Ubah Periode: ' . $model->ID_Tahun;
$this->params['breadcrumbs'][] = 'RPJMD';
$this->params['breadcrumbs'][] = ['label' => 'Periode', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_Tahun, 'url' => ['view', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ta-periode-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
