<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\renstra\models\TaIndikatorKegiatanSkpdSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-indikator-kegiatan-skpd-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID_Tahun') ?>

    <?= $form->field($model, 'Kd_Prov') ?>

    <?= $form->field($model, 'Kd_Kab_Kota') ?>

    <?= $form->field($model, 'Kd_Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang') ?>

    <?php // echo $form->field($model, 'Kd_Unit') ?>

    <?php // echo $form->field($model, 'No_Misi') ?>

    <?php // echo $form->field($model, 'No_Tujuan') ?>

    <?php // echo $form->field($model, 'No_Sasaran') ?>

    <?php // echo $form->field($model, 'Kd_Prog') ?>

    <?php // echo $form->field($model, 'ID_Prog') ?>

    <?php // echo $form->field($model, 'Kd_Keg') ?>

    <?php // echo $form->field($model, 'No_ID') ?>

    <?php // echo $form->field($model, 'Kd_Indikator_1') ?>

    <?php // echo $form->field($model, 'Kd_Indikator_2') ?>

    <?php // echo $form->field($model, 'Kd_Indikator_3') ?>

    <?php // echo $form->field($model, 'Tolak_Ukur') ?>

    <?php // echo $form->field($model, 'Target_Uraian') ?>

    <?php // echo $form->field($model, 'Kondisi_Kinerja_Awal') ?>

    <?php // echo $form->field($model, 'NilaiTahun1') ?>

    <?php // echo $form->field($model, 'NilaiTahun2') ?>

    <?php // echo $form->field($model, 'NilaiTahun3') ?>

    <?php // echo $form->field($model, 'NilaiTahun4') ?>

    <?php // echo $form->field($model, 'NilaiTahun5') ?>

    <?php // echo $form->field($model, 'Satuan') ?>

    <?php // echo $form->field($model, 'Keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
