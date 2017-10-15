<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $tujuan common\models\RkpdProgram */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="rkpd-program-form">

    <?php $form = ActiveForm::begin(['id' => $tujuan->formName() ,'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php echo $tujuan->isNewRecord ? '' : $form->field($tujuan, 'No_Tujuan')->textInput() ?>

    <?= $form->field($tujuan, 'Ur_Tujuan')->textInput(['maxlength' => true]) ?>

    <?php //untuk input sasaran ?>  

    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>
    <?php /* DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $sasaran[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'No_Sasaran',
            'Ur_Sasaran',
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i> Sasaran
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah Sasaran</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($sasaran as $index => $sasaran): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-address">Sasaran</span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (!$sasaran->isNewRecord) {
                                echo Html::activeHiddenInput($sasaran, "[{$index}]id");
                            }
                        ?>

                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($sasaran, "[{$index}]No_Sasaran")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($sasaran, "[{$index}]Ur_Sasaran")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- end:row -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>    
    <?php DynamicFormWidget::end(); */ ?>    

    <div class="form-group">
        <?= Html::submitButton($tujuan->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $tujuan->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
IF($tujuan->isNewRecord){
list($ID_Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi) = explode('.', $id);
$script = <<<JS
$('form#{$tujuan->formName()}').on('beforeSubmit',function(e)
{
    var \$form = $(this);
    $.post(
        \$form.attr("action"), //serialize Yii2 form 
        \$form.serialize()
    )
        .done(function(result){
            if(result == 1)
            {
                $("#myModalTujuan").modal('hide'); //hide modal after submit
                //$(\$form).trigger("reset"); //reset form to reuse it to input
                $.pjax.reload({container:'#tujuan-pjax{$ID_Tahun}{$Kd_Urusan}{$Kd_Bidang}{$Kd_Unit}{$No_Misi}'});
            }else
            {
                $("#message").html(result);
            }
        }).fail(function(){
            console.log("server error");
        });
    return false;
});

JS;
$this->registerJs($script);
}ELSE{

$script = <<<JS
$('form#{$tujuan->formName()}').on('beforeSubmit',function(e)
{
    var \$form = $(this);
    $.post(
        \$form.attr("action"), //serialize Yii2 form 
        \$form.serialize()
    )
        .done(function(result){
            if(result == 1)
            {
                $("#myModalTujuanubah").modal('hide'); //hide modal after submit
                //$(\$form).trigger("reset"); //reset form to reuse it to input
                $.pjax.reload({container:'#tujuan-pjax{$tujuan->ID_Tahun}{$tujuan->Kd_Urusan}{$tujuan->Kd_Bidang}{$tujuan->Kd_Unit}{$tujuan->No_Misi}'});
            }else
            {
                $("#message").html(result);
            }
        }).fail(function(){
            console.log("server error");
        });
    return false;
});

JS;
$this->registerJs($script);
}
?>