<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RkpdProgram */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rkpd-program-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'urusan_id')->textInput() ?>

    <?= $form->field($model, 'bidang_id')->textInput() ?>

    <?php // $form->field($model, 'no_misi')->textInput() ?>

    <?php // $form->field($model, 'no_tujuan')->textInput() ?>

    <?php // $form->field($model, 'no_sasaran')->textInput() ?>

    <?php // $form->field($model, 'id_sasrkpd')->textInput() ?>

    <?= $form->field($model, 'id_progrkpd')->textInput() ?>

    <?= $form->field($model, 'uraian')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
$this->registerJs(
"$('form#{$model->formName()}')on('beforeSubmit',function(e)
{
    var \$form = $(this);
    $.post(
        \$form.attr(\"action\"), //serialize Yii2 form 
        \$form.serialize()
    )
        .done(function(result){
            if(result == 1)
            {
                $(\$form).trigger(\"reset\");
                $.pjax.reload({container:'#rkpdGrid'});
            }else
            {
                $(\"#message\").html(result);
            }
        }).fail(function(){
            console.log(\"server error\");
        });
    return false;
});"
); ?>