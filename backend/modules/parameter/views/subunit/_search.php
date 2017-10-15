<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\parameter\models\TaSubUnitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-sub-unit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Tahun')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'Tahun')])->label(false) ?>

    <?= $form->field($model, 'Kd_Urusan')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'Kd_Urusan')])->label(false) ?>

    <?= $form->field($model, 'Kd_Bidang')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'Kd_Bidang')])->label(false) ?>

    <?= $form->field($model, 'Kd_Unit')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'Kd_Unit')])->label(false) ?>

    <?= $form->field($model, 'Kd_Sub')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'Kd_Sub')])->label(false) ?>

    <?php // echo $form->field($model, 'Nm_Pimpinan') ?>

    <?php // echo $form->field($model, 'Nip_Pimpinan') ?>

    <?php // echo $form->field($model, 'Jbt_Pimpinan') ?>

    <?php // echo $form->field($model, 'Alamat') ?>

    <?php // echo $form->field($model, 'Ur_Visi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
