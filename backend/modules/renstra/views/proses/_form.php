<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaPeriode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-periode-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_Tahun')->textInput() ?>

    <?= $form->field($model, 'Kd_Prov')->textInput() ?>

    <?= $form->field($model, 'Kd_Kab_Kota')->textInput() ?>

    <?= $form->field($model, 'Tahun1')->textInput() ?>

    <?= $form->field($model, 'Tahun2')->textInput() ?>

    <?= $form->field($model, 'Tahun3')->textInput() ?>

    <?= $form->field($model, 'Tahun4')->textInput() ?>

    <?= $form->field($model, 'Tahun5')->textInput() ?>

    <?= $form->field($model, 'Aktive')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
