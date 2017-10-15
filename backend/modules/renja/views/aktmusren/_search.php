<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\renja\models\RenjaKegiatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="renja-kegiatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'uraian')->textInput(
                ['class' => 'form-control input-sm pull-right','placeholder' => Yii::t('app', 'Uraian Kegiatan')])->label(false) ?>

    <?php ActiveForm::end(); ?>

</div>
