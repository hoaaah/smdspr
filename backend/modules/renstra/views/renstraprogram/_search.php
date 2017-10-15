<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\renstra\models\RenstraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="renstra-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID_Tahun') ?>

    <?= $form->field($model, 'Kd_Prov') ?>

    <?= $form->field($model, 'Kd_Kab_Kota') ?>

    <?= $form->field($model, 'Kd_Perubahan') ?>

    <?= $form->field($model, 'Kd_Dokumen') ?>

    <?php // echo $form->field($model, 'Kd_Usulan') ?>

    <?php // echo $form->field($model, 'Kd_Urusan') ?>

    <?php // echo $form->field($model, 'Kd_Bidang') ?>

    <?php // echo $form->field($model, 'Kd_Unit') ?>

    <?php // echo $form->field($model, 'No_Misi') ?>

    <?php // echo $form->field($model, 'No_Tujuan') ?>

    <?php // echo $form->field($model, 'No_Sasaran') ?>

    <?php // echo $form->field($model, 'Kd_Prog') ?>

    <?php // echo $form->field($model, 'ID_Prog') ?>

    <?php // echo $form->field($model, 'Tgl_Perubahan') ?>

    <?php // echo $form->field($model, 'Nm_Prov') ?>

    <?php // echo $form->field($model, 'Nm_Kab') ?>

    <?php // echo $form->field($model, 'Nm_Urusan') ?>

    <?php // echo $form->field($model, 'Nm_Bidang') ?>

    <?php // echo $form->field($model, 'Nm_Unit') ?>

    <?php // echo $form->field($model, 'Ur_Misi') ?>

    <?php // echo $form->field($model, 'Ur_Tujuan') ?>

    <?php // echo $form->field($model, 'Ur_Sasaran') ?>

    <?php // echo $form->field($model, 'Ket_Program') ?>

    <?php // echo $form->field($model, 'Kd_Urusan1') ?>

    <?php // echo $form->field($model, 'Kd_Bidang1') ?>

    <?php // echo $form->field($model, 'No_Misi1') ?>

    <?php // echo $form->field($model, 'No_Tujuan1') ?>

    <?php // echo $form->field($model, 'No_Sasaran1') ?>

    <?php // echo $form->field($model, 'Kd_Prog1') ?>

    <?php // echo $form->field($model, 'ID_Prog1') ?>

    <?php // echo $form->field($model, 'Ur_Misi1') ?>

    <?php // echo $form->field($model, 'Ur_Tujuan1') ?>

    <?php // echo $form->field($model, 'Ur_Sasaran1') ?>

    <?php // echo $form->field($model, 'Ket_Program1') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
