<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\rpjmd\models\TRpjmdPrioritasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trpjmd-prioritas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Uraian')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => 'Prioritas'])->label(false) ?>

    <?php ActiveForm::end(); ?>

</div>
