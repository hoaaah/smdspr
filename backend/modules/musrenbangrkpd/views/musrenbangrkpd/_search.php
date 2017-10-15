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
        <div class="col-sm-4">
            <?php // $data = ArrayHelper::map($query, 'kd_skpd','Nm_Sub_Unit');
            echo $form->field($model, 'kd_bahas')->widget(Select2::classname(), [
                'data' => [
                        '2' => 'Tampilkan Semua',
                        '0' => 'Tampilkan Hanya Kegiatan SKPD',
                        '1' => 'Tampilkan Hanya Kegiatan Musrenbang',
                ],
                'options' => ['placeholder' => 'Filter Kegiatan ...'],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ])->label(false);
            ?>    
        </div>
        <div class="col-sm-6">
            <?php $data = ArrayHelper::map($query, 'kd_skpd','Nm_Sub_Unit');
            echo $form->field($model, 'kd_skpd')->widget(Select2::classname(), [
                'data' => $data,
                'options' => ['placeholder' => 'Pilih SKPD ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
            ?>    
        </div>
        <div class="col-sm-2">
            <?= Html::submitButton('Tampilkan', ['class' => 'btn btn-sm btn-primary']) ?>
            <?php // Html::resetButton('Reset', ['class' => 'btn btn-xs btn-default']) ?>
            <?php ActiveForm::end(); ?>       
        </div>
    </div>

</div>
