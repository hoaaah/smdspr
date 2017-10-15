<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\musrenbang\models\TRenjaKegiatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trenja-kegiatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'id')])->label(false) ?>

    <?= $form->field($model, 'renja_program_id')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'renja_program_id')])->label(false) ?>

    <?= $form->field($model, 'tahun')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'tahun')])->label(false) ?>

    <?= $form->field($model, 'kd_urusan')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'kd_urusan')])->label(false) ?>

    <?= $form->field($model, 'kd_bidang')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'kd_bidang')])->label(false) ?>

    <?php // echo $form->field($model, 'kd_unit') ?>

    <?php // echo $form->field($model, 'kd_sub') ?>

    <?php // echo $form->field($model, 'no_skpdMisi') ?>

    <?php // echo $form->field($model, 'no_skpdTujuan') ?>

    <?php // echo $form->field($model, 'no_skpdSasaran') ?>

    <?php // echo $form->field($model, 'no_renjaSas') ?>

    <?php // echo $form->field($model, 'no_renjaProg') ?>

    <?php // echo $form->field($model, 'id_renprog') ?>

    <?php // echo $form->field($model, 'id_renkeg') ?>

    <?php // echo $form->field($model, 'uraian') ?>

    <?php // echo $form->field($model, 'lokasi') ?>

    <?php // echo $form->field($model, 'lokasi_maps') ?>

    <?php // echo $form->field($model, 'kelompok_sasaran') ?>

    <?php // echo $form->field($model, 'status_kegiatan') ?>

    <?php // echo $form->field($model, 'pagu_kegiatan') ?>

    <?php // echo $form->field($model, 'pagu_musrenbang') ?>

    <?php // echo $form->field($model, 'kd_asb') ?>

    <?php // echo $form->field($model, 'info_asb') ?>

    <?php // echo $form->field($model, 'kd_bahas') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'input_phased') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'status_phased') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
