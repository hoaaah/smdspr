<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\TaMisiSKPD */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    $connection = \Yii::$app->db;           
    $skpd = $connection->createCommand('SELECT CONCAT(Kd_Urusan,".", Kd_Bidang) AS Kd_Bidang, Nm_Bidang FROM r_bidang');
    $misi = $connection->createCommand('SELECT No_Misi, Ur_Misi  FROM Ta_Misi_RPJMD 
            WHERE Kd_Perubahan = (SELECT MAX(Kd_Perubahan) FROM Ta_Misi_RPJMD WHERE ID_Tahun = 1)');
    $skpd = $skpd->queryAll();
    $misi = $misi->queryAll();
?>  

<div class="ta-misi-skpd-form">
<div class="box box-success">
<div class="box-header">
Tambah Misi
</div>
<div class="box-body">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="col-md-12">
        <?= $form->field($model, 'ID_Tahun')->textInput(['maxlength' => true, 'placeholder' => 'ID_Tahun', 'class' => 'form-control input-sm']) ?>

        <?= $form->field($model, 'Ur_Misi')->textInput(['maxlength' => true, 'placeholder' => 'Ur_Misi', 'class' => 'form-control input-sm']) ?>

        <?php 
                echo $form->field($model, 'No_Misi1')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map($misi,'No_Misi','Ur_Misi'),
                    'options' => ['placeholder' => 'Penyelarasan Misi RPJMD ...', 'class' => 'form-control input-sm'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false);
        ?>
    </div>
    <div class="col-md-12"> <!--for tujuan dan sasaran -->

        <div class="padding-v-md">
            <div class="line line-dashed"></div>
        </div>

        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper',
            'widgetBody' => '.container-items',
            'widgetItem' => '.tujuan-item',
            'limit' => 10,
            'min' => 1,
            'insertButton' => '.add-tujuan',
            'deleteButton' => '.remove-tujuan',
            'model' => $tujuan[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'Ur_Tujuan',
            ],
        ]); ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tujuan</th>
                    <th style="width: 450px;">Sasaran</th>
                    <th class="text-center" style="width: 90px;">
                        <button type="button" class="add-tujuan btn btn-success btn-xs"><span class="fa fa-plus"></span></button>
                    </th>
                </tr>
            </thead>
            <tbody class="container-items">
            <?php foreach ($tujuan as $indexTujuan => $tujuan): ?>
                <tr class="tujuan-item">
                    <td class="vcenter">
                        <?php
                            // necessary for update action.
                            if (! $tujuan->isNewRecord) {
                                echo Html::activeHiddenInput($tujuan, "[{$indexTujuan}]id");
                            }
                        ?>
                        <?= $form->field($tujuan, "[{$indexTujuan}]Ur_Tujuan")->label(false)->textInput(['maxlength' => true]) ?>
                    </td>
                    <td>
                        <?= $this->render('_form-sasaran', [
                            'form' => $form,
                            'indexTujuan' => $indexTujuan,
                            'sasaran' => $sasaran[$indexTujuan],
                        ]) ?>
                    </td>
                    <td class="text-center vcenter" style="width: 90px; verti">
                        <button type="button" class="remove-tujuan btn btn-danger btn-xs"><span class="fa fa-minus"></span></button>
                    </td>
                </tr>
             <?php endforeach; ?>
            </tbody>
        </table>
        <?php DynamicFormWidget::end(); ?>    
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div><!--box-->
</div>
