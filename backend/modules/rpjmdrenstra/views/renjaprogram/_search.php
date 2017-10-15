<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\rkpdrenja\models\RenjaProgramSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="renja-program-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'urusan_id') ?>

    <?= $form->field($model, 'bidang_id') ?>

    <?= $form->field($model, 'kd_urusan') ?>

    <?php // echo $form->field($model, 'kd_bidang') ?>

    <?php // echo $form->field($model, 'kd_unit') ?>

    <?php // echo $form->field($model, 'kd_sub') ?>

    <?php // echo $form->field($model, 'no_skpdMisi') ?>

    <?php // echo $form->field($model, 'no_skpdTujuan') ?>

    <?php // echo $form->field($model, 'no_skpdSasaran') ?>

    <?php // echo $form->field($model, 'no_renjaSas') ?>

    <?php // echo $form->field($model, 'no_renjaProg') ?>

    <?php // echo $form->field($model, 'id_renprog') ?>

    <?php // echo $form->field($model, 'uraian') ?>

    <?php // echo $form->field($model, 'pagu_program') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'input_phased') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'status_phased') ?>

    <?php // echo $form->field($model, 'rkpd_program_id') ?>

    <?php // echo $form->field($model, 'id_tahun') ?>

    <?php // echo $form->field($model, 'Kd_Perubahan_Renstra') ?>

    <?php // echo $form->field($model, 'Kd_Dokumen_Renstra') ?>

    <?php // echo $form->field($model, 'Kd_Usulan_Renstra') ?>

    <?php // echo $form->field($model, 'Kd_Urusan_Renstra') ?>

    <?php // echo $form->field($model, 'Kd_Bidang_Renstra') ?>

    <?php // echo $form->field($model, 'Kd_Unit_Renstra') ?>

    <?php // echo $form->field($model, 'No_Misi_Renstra') ?>

    <?php // echo $form->field($model, 'No_Tujuan_Renstra') ?>

    <?php // echo $form->field($model, 'No_Sasaran_Renstra') ?>

    <?php // echo $form->field($model, 'Kd_Prog_Renstra') ?>

    <?php // echo $form->field($model, 'ID_Prog_Renstra') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
