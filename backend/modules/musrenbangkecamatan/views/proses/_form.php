<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Proses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proses-form">
<div class="row">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-6">
        <div class="alert alert-info">
            Masukkan informasi mengenai berita acara musrenbang.
        </div><!--alert-->
        <?= $form->field($model, 'tahun')->textInput(['maxlength' => true])->input('tahun', ['placeholder' => DATE('Y')+1]) ?>

        <?= $form->field($model, 'no_ba')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'tanggal_ba')->widget(
            DatePicker::className(), [
                // inline too, not bad
                 'inline' => false, 
                 // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-m-d'
                ]
        ]);?>          
    </div><!--col-->
    <div class="col-lg-6">
        <div class="alert alert-info">
            Masukkan informasi mengenai penandatangan berita acara.
        </div><!--alert-->
        <?= $form->field($model, 'penandatangan')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nip_penandatangan')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'jabatan_penandatangan')->textInput(['maxlength' => true]) ?>        
    </div><!--col-->    

    <div class="col-lg-12">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>



    <?php ActiveForm::end(); ?>

</div>
</div>