<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\musrenbangdesa\models\SubkegiatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subkegiatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'renja_kegiatan_id') ?>

    <?= $form->field($model, 'uraian') ?>

    <?= $form->field($model, 'kd_kecamatan') ?>

    <?= $form->field($model, 'kd_kelurahan') ?>

    <?php // echo $form->field($model, 'rw') ?>

    <?php // echo $form->field($model, 'rt') ?>

    <?php // echo $form->field($model, 'lokasi') ?>

    <?php // echo $form->field($model, 'volume') ?>

    <?php // echo $form->field($model, 'satuan') ?>

    <?php // echo $form->field($model, 'harga_satuan') ?>

    <?php // echo $form->field($model, 'biaya') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'kd_asb') ?>

    <?php // echo $form->field($model, 'input_phased') ?>

    <?php // echo $form->field($model, 'status_phased') ?>

    <?php // echo $form->field($model, 'input_status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
