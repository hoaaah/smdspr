<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Sub;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\RenjaProgramSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="renja-program-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-sm-6">
            <?php $data = ArrayHelper::map($query, 'kd_skpd','Nm_Sub_Unit');
            echo $form->field($model, 'kd_sub')->widget(Select2::classname(), [
                'data' => $data,
                'options' => ['placeholder' => 'Pilih SKPD ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
            ?>    
        </div>
            <?php // echo $form->field($model, 'kd_sub') ?>
        <div class="col-sm-6">
            <?php  echo $form->field($model, 'uraian' )->input('uraian', ['placeholder' => "Uraian Kegiatan..."])->label(false); ?>
        </div>
    </div>
    <div class= "row">
        <div class="col-sm-12">
            <?= Html::submitButton('Cari', ['class' => 'btn btn-xs btn-primary']) ?>
            <?php // Html::resetButton('Reset', ['class' => 'btn btn-xs btn-default']) ?>
            <?php ActiveForm::end(); ?>    
        </div>
    </div>



</div>
