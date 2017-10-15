<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?php //echo $form->field($model, 'oldpassword')->passwordInput(['placeholder' => 'Password Lama'])->label('Password Lama') ?>
                <?= $form->field($model, 'password_hash')->passwordInput(['placeholder' => 'Password Baru'])->label('Password Baru') ?>
                <?php //echo  Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

            <?php ActiveForm::end(); ?>