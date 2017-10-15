<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaMisiRPJMD */

$this->title = 'Ubah Misi: ' . $model->Ur_Misi;
$this->params['breadcrumbs'][] = 'RPJMD';
$this->params['breadcrumbs'][] = ['label' => 'Misi-Tujuan-Sasaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_Tahun, 'url' => ['view', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Perubahan' => $model->Kd_Perubahan, 'Kd_Dokumen' => $model->Kd_Dokumen, 'Kd_Usulan' => $model->Kd_Usulan, 'No_Misi' => $model->No_Misi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-misi-rpjmd-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
