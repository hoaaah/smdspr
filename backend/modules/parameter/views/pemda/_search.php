<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\parameter\models\TaPemdaUmumSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-pemda-umum-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'ID')])->label(false) ?>

    <?= $form->field($model, 'Kd_Prov')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'Kd_Prov')])->label(false) ?>

    <?= $form->field($model, 'Kd_Kab_Kota')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'Kd_Kab_Kota')])->label(false) ?>

    <?= $form->field($model, 'Ur_Visi')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'Ur_Visi')])->label(false) ?>

    <?= $form->field($model, 'Nm_Provinsi')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'Nm_Provinsi')])->label(false) ?>

    <?php // echo $form->field($model, 'Nm_Pemda') ?>

    <?php // echo $form->field($model, 'Nm_PimpDaerah') ?>

    <?php // echo $form->field($model, 'Jab_PimpDaerah') ?>

    <?php // echo $form->field($model, 'Nm_Sekda') ?>

    <?php // echo $form->field($model, 'Nip_Sekda') ?>

    <?php // echo $form->field($model, 'Jbt_Sekda') ?>

    <?php // echo $form->field($model, 'Ibukota') ?>

    <?php // echo $form->field($model, 'Alamat') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
