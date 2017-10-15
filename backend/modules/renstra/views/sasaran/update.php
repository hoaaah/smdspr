<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaSasaranSKPD */

$this->title = 'Update Ta Sasaran Skpd: ' . $model->ID_Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Sasaran Skpds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_Tahun, 'url' => ['view', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-sasaran-skpd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
