<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Peran;
use common\models\Desa;
use common\models\Kecamatan;

/* @var $this yii\web\View */
/* @var $model common\models\Tperan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tperan-form">

    <?php $form = ActiveForm::begin(); ?>
<!-- Ini Bagian Untuk Backend SKPD, untuk public cukup Kecamatan-RT @hoaaah
    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'kd_urusan')->textInput() ?>

    <?= $form->field($model, 'kd_bidang')->textInput() ?>

    <?= $form->field($model, 'kd_unit')->textInput() ?>

    <?= $form->field($model, 'kd_sub')->textInput() ?>
-->

    <?php echo $form->field($model, 'kd_kecamatan')->dropDownList(ArrayHelper::map(Kecamatan::find()->all(),'kd_kecamatan','kecamatan'), [   'prompt'=>'Pilih Kecamatan', 
            'onchange' =>'$.post( "'.Yii::$app->urlManager->createUrl('tperan/desa?id=').'"+$(this).val(), function( data ) {
                          $( "#'.Html::getInputId($model, 'kd_kelurahan').'" ).html( data );
                          });' 
        ]);?>

    <?php echo $form->field($model, 'kd_kelurahan')->dropDownList(ArrayHelper::map(Desa::find()->all(),'id','desa'), ['prompt'=>'Pilih Kelurahan/Desa']);?>
    
    <?= $form->field($model, 'rw')->textInput() ?>

    <?= $form->field($model, 'rt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
