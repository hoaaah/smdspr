<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaPeriode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-periode-form">
    <div class="row">
        <?php $form = ActiveForm::begin(); ?>
        <?php  IF(!$model->isNewRecord): ?>
        <div class="col-sm-6">
        <?php echo $form->field($model, 'ID_Tahun')->textInput(['class' => 'form-control input-sm']) ?>
        </div>
        <div class="col-sm-6">
        <?= $form->field($model, 'Aktive')->checkbox() ?>
        </div>    
        <?php endif;?>
    </div>
    <div class="row">
        <div class="col-sm-6">
        <?= $form->field($model, 'Tahun1')->textInput(['class' => 'form-control input-sm']) ?>
        </div>
        <div class="col-sm-6">
        <?= $form->field($model, 'Tahun2')->textInput(['class' => 'form-control input-sm']) ?>
        </div>
        <div class="col-sm-6">
        <?= $form->field($model, 'Tahun3')->textInput(['class' => 'form-control input-sm']) ?>
        </div>
        <div class="col-sm-6">
        <?= $form->field($model, 'Tahun4')->textInput(['class' => 'form-control input-sm']) ?>
        </div>
        <div class="col-sm-6">
        <?= $form->field($model, 'Tahun5')->textInput(['class' => 'form-control input-sm']) ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-sm btn-success' : 'btn btn-sm btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
