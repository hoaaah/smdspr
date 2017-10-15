<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\rpjmd\models\TaPeriodeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-periode-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID_Tahun') ?>

    <?= $form->field($model, 'Kd_Prov') ?>

    <?= $form->field($model, 'Kd_Kab_Kota') ?>

    <?= $form->field($model, 'Tahun1') ?>

    <?= $form->field($model, 'Tahun2') ?>

    <?php // echo $form->field($model, 'Tahun3') ?>

    <?php // echo $form->field($model, 'Tahun4') ?>

    <?php // echo $form->field($model, 'Tahun5') ?>

    <?php // echo $form->field($model, 'Aktive') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
