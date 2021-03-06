<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaMisiSKPD */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-misi-skpd-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_Tahun')->textInput() ?>

    <?= $form->field($model, 'Kd_Prov')->textInput() ?>

    <?= $form->field($model, 'Kd_Kab_Kota')->textInput() ?>

    <?= $form->field($model, 'Kd_Urusan')->textInput() ?>

    <?= $form->field($model, 'Kd_Bidang')->textInput() ?>

    <?= $form->field($model, 'Kd_Unit')->textInput() ?>

    <?= $form->field($model, 'No_Misi')->textInput() ?>

    <?= $form->field($model, 'Ur_Misi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'No_Misi1')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
