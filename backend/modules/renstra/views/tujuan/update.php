<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaTujuanSKPD */

$this->title = 'Update Ta Tujuan Skpd: ' . $model->ID_Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Tujuan Skpds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_Tahun, 'url' => ['view', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-tujuan-skpd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
