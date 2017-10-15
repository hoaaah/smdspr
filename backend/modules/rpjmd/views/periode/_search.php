<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\rpjmd\models\TaPeriodeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-periode-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Tahun1')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'Year')])->label(false) ?>

    <?php ActiveForm::end(); ?>

</div>
