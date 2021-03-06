<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model common\models\RpjmdProgram */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rpjmd-program-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName() ,'options' => ['enctype' => 'multipart/form-data']]); ?>
    <h3>Data Program</h3>
    <p>Lengkapi data berikut berkaitan dengan program:</p>    

    <?= $form->field($model, 'Ket_Program')->textInput(['maxlength' => true]) ?>
    <hr>

    <h3>Data Pagu</h3>
    <p>Lengkapi data di bawah ini dengan pagu program setiap tahunnya:</p>

    <div class="row">
        <div class="col-sm-2">
        <?= $form->field($pagu, 'PaguTahun1')->textInput() ?>
        </div>
        <div class="col-sm-2">
        <?= $form->field($pagu, 'PaguTahun2')->textInput() ?>
        </div>
        <div class="col-sm-2">   
        <?= $form->field($pagu, 'PaguTahun3')->textInput() ?>
        </div>
        <div class="col-sm-2">   
        <?= $form->field($pagu, 'PaguTahun4')->textInput() ?>
        </div>
        <div class="col-sm-2">   
        <?= $form->field($pagu, 'PaguTahun5')->textInput() ?>
        </div>
        <div class="col-sm-2">   
        <?= $form->field($pagu, 'Satuan')->textInput() ?>
        </div>
    </div> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
IF($model->isNewRecord){

$script = <<<JS
$('form#{$model->formName()}').on('beforeSubmit',function(e)
{
    var \$form = $(this);
    $.post(
        \$form.attr("action"), //serialize Yii2 form 
        \$form.serialize()
    )
        .done(function(result){
            if(result == 1)
            {
                $("#myModalDes").modal('hide'); //hide modal after submit
                //$(\$form).trigger("reset"); //reset form to reuse it to input
                $.pjax.reload({container:'#program-pjax'});
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
$('form#{$model->formName()}').on('beforeSubmit',function(e)
{
    var \$form = $(this);
    $.post(
        \$form.attr("action"), //serialize Yii2 form 
        \$form.serialize()
    )
        .done(function(result){
            if(result == 1)
            {
                $("#myModalubah").modal('hide'); //hide modal after submit
                //$(\$form).trigger("reset"); //reset form to reuse it to input
                $.pjax.reload({container:'#program-pjax'});
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