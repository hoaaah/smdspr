<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\RkpdProgramCapaian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rkpd-program-capaian-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>


    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, "no_indikator")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, "tolok_ukur")->textInput(['maxlength' => true]) ?>
        </div>
    </div><!-- end:row -->

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, "target_angka")->textInput(['maxlength' => true]) ?>
        </div>    
        <div class="col-sm-6">
            <?= $form->field($model, "target_uraian")->textInput(['maxlength' => true]) ?>
        </div>
    </div><!-- end:row -->

    <div class="row">
        <div class="col-sm-6">
            <?php echo $form->field($model, "kd_indikator_2")->dropDownList(ArrayHelper::map(\common\models\Rindikator2::find()->all(),'id','jn_indikator'), ['prompt'=>'Jenis Target...'])->label(false);?>                                    
        </div>
        <div class="col-sm-6">
            <?php echo $form->field($model, "kd_indikator_3")->dropDownList(ArrayHelper::map(\common\models\Rindikator3::find()->all(),'id','jn_indikator'), ['prompt'=>'Tipe Target'])->label(false);?> 
        </div>                            
    </div><!-- end:row -->    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
                $("#myModalIndubah").modal('hide'); //hide modal after submit
                //$(\$form).trigger("reset"); //reset form to reuse it to input
                $.pjax.reload({container:'#capaian-pjax{$id_program->id}'});
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
$this->registerJs($script); ?>