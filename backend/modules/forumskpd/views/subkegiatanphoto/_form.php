<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
/* @var $this yii\web\View */
/* @var $model common\models\SubkegiatanPhoto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subkegiatan-photo-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'musrenbang_id')->textInput() ?>

    <?php 

    echo $form->field($model, 'image')->widget(FileInput::classname(), [
        'options'=>['accept'=>'image/*'],
        'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']
    ]]);
    /**
    * uncomment for multiple file upload
    *
    echo $form->field($model, 'image[]')->widget(FileInput::classname(), [
        'options'=>['accept'=>'image/*', 'multiple'=>true],
        'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']
    ]]);
    *
    */
    
    ?>

    <?= $form->field($model, 'caption')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
