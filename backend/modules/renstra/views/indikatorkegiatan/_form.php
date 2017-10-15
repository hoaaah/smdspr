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

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, "No_ID")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, "Kondisi_Kinerja_Awal")->textInput(['maxlength' => true]) ?>
        </div>
    </div><!-- end:row -->

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, "Tolak_Ukur")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, "Target_Uraian")->textInput(['maxlength' => true]) ?>
        </div>
    </div><!-- end:row -->

    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, "NilaiTahun1")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, "NilaiTahun2")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, "NilaiTahun3")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, "NilaiTahun4")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, "NilaiTahun5")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, "Satuan")->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?php echo $form->field($model, "Kd_Indikator_1")->dropDownList(ArrayHelper::map(\common\models\Rindikator1::find()->all(),'id','jn_indikator'), ['prompt'=>'Jenis Target...'])->label(false);?>                                
        </div>
        <div class="col-sm-4">
            <?php echo $form->field($model, "Kd_Indikator_2")->dropDownList(ArrayHelper::map(\common\models\Rindikator2::find()->all(),'id','jn_indikator'), ['prompt'=>'Tipe Target'])->label(false);?>
        </div>
        <div class="col-sm-4">
            <?php echo $form->field($model, "Kd_Indikator_3")->dropDownList(ArrayHelper::map(\common\models\Rindikator3::find()->all(),'id','jn_indikator'), ['prompt'=>'Tipe Target'])->label(false);?>
        </div>                            
    </div><!-- end:row -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 

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
                $("#myModalIndikatorubah").modal('hide'); //hide modal after submit
                //$(\$form).trigger("reset"); //reset form to reuse it to input
                $.pjax.reload({container:'#indikator-pjax'});
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

?>    