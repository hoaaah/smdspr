<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\rpjmd\models\TaMisiRPJMDSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-misi-renstra-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'Ur_Misi')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'Misi')])->label(false) ?>
                
    <?php ActiveForm::end(); ?>

</div>
