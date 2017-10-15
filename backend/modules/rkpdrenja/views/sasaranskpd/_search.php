<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\rkpdrenja\models\TaSasaranSKPDSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-sasaran-skpd-search">

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

    <?php // echo $form->field($model, 'Ur_Sasaran') ?>

    <?php // echo $form->field($model, 'No_Misi1') ?>

    <?php // echo $form->field($model, 'No_Tujuan1') ?>

    <?php // echo $form->field($model, 'No_Sasaran1') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
