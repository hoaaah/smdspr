<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\renja\models\RenjaProgramSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="renja-program-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'uraian')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'Uraian Program')])->label(false) ?>

    <?php ActiveForm::end(); ?>

</div>
