<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\musrenbangdesa\models\ProsesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proses-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'kd_urusan') ?>

    <?= $form->field($model, 'kd_bidang') ?>

    <?= $form->field($model, 'kd_unit') ?>

    <?php // echo $form->field($model, 'kd_sub') ?>

    <?php // echo $form->field($model, 'kd_kecamatan') ?>

    <?php // echo $form->field($model, 'kd_kelurahan') ?>

    <?php // echo $form->field($model, 'rw') ?>

    <?php // echo $form->field($model, 'rt') ?>

    <?php // echo $form->field($model, 'no_ba') ?>

    <?php // echo $form->field($model, 'tanggal_ba') ?>

    <?php // echo $form->field($model, 'input_phased') ?>

    <?php // echo $form->field($model, 'penandatangan') ?>

    <?php // echo $form->field($model, 'nip_penandatangan') ?>

    <?php // echo $form->field($model, 'jabatan_penandatangan') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
