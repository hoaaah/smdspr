<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TRpjmdPrioritas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trpjmd-prioritas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $model->isNewRecord ? '' : $form->field($model, 'ID_Tahun')->textInput() ?>

    <?= $form->field($model, 'Kd_Prioritas')->textInput() ?>

    <?= $form->field($model, 'Uraian')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-xs btn-success' : 'btn btn-xs btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
