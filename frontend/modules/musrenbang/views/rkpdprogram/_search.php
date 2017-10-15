<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\musrenbang\models\TRkpdProgramSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trkpd-program-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'id')])->label(false) ?>

    <?= $form->field($model, 'tahun')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'tahun')])->label(false) ?>

    <?= $form->field($model, 'urusan_id')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'urusan_id')])->label(false) ?>

    <?= $form->field($model, 'bidang_id')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'bidang_id')])->label(false) ?>

    <?= $form->field($model, 'no_misi')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'no_misi')])->label(false) ?>

    <?php // echo $form->field($model, 'no_tujuan') ?>

    <?php // echo $form->field($model, 'no_sasaran') ?>

    <?php // echo $form->field($model, 'kd_progrkpd') ?>

    <?php // echo $form->field($model, 'id_progrkpd') ?>

    <?php // echo $form->field($model, 'uraian') ?>

    <?php // echo $form->field($model, 'pagu_program') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'input_phased') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'status_phased') ?>

    <?php // echo $form->field($model, 'id_tahun') ?>

    <?php // echo $form->field($model, 'Kd_Perubahan_Rpjmd') ?>

    <?php // echo $form->field($model, 'Kd_Dokumen_Rpjmd') ?>

    <?php // echo $form->field($model, 'Kd_Usulan_Rpjmd') ?>

    <?php // echo $form->field($model, 'No_Misi_Rpjmd') ?>

    <?php // echo $form->field($model, 'No_Tujuan_Rpjmd') ?>

    <?php // echo $form->field($model, 'No_Sasaran_Rpjmd') ?>

    <?php // echo $form->field($model, 'Kd_Prog_Rpjmd') ?>

    <?php // echo $form->field($model, 'ID_Prog_Rpjmd') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
