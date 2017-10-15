<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RenjaKegiatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="renja-kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kd_urusan')->textInput() ?>

    <?= $form->field($model, 'kd_bidang')->textInput() ?>

    <?= $form->field($model, 'kd_unit')->textInput() ?>

    <?= $form->field($model, 'kd_sub')->textInput() ?>

    <?= $form->field($model, 'no_skpdMisi')->textInput() ?>

    <?= $form->field($model, 'no_skpdTujuan')->textInput() ?>

    <?= $form->field($model, 'no_skpdSasaran')->textInput() ?>

    <?= $form->field($model, 'no_renjaSas')->textInput() ?>

    <?= $form->field($model, 'no_renjaProg')->textInput() ?>

    <?= $form->field($model, 'id_renprog')->textInput() ?>

    <?= $form->field($model, 'id_renkeg')->textInput() ?>

    <?= $form->field($model, 'uraian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lokasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lokasi_maps')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kelompok_sasaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_kegiatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kd_bahas')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'input_phased')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'status_phased')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
