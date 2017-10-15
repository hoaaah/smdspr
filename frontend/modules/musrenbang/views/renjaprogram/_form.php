<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TRenjaProgram */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trenja-program-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'urusan_id')->textInput() ?>

    <?= $form->field($model, 'bidang_id')->textInput() ?>

    <?= $form->field($model, 'kd_urusan')->textInput() ?>

    <?= $form->field($model, 'kd_bidang')->textInput() ?>

    <?= $form->field($model, 'kd_unit')->textInput() ?>

    <?= $form->field($model, 'kd_sub')->textInput() ?>

    <?= $form->field($model, 'no_skpdMisi')->textInput() ?>

    <?= $form->field($model, 'no_skpdTujuan')->textInput() ?>

    <?= $form->field($model, 'no_skpdSasaran')->textInput() ?>

    <?= $form->field($model, 'no_renjaSas')->textInput() ?>

    <?= $form->field($model, 'no_renjaProg')->textInput() ?>

    <?= $form->field($model, 'id_renprog')->textInput() ?>

    <?= $form->field($model, 'uraian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pagu_program')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'input_phased')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'status_phased')->textInput() ?>

    <?= $form->field($model, 'rkpd_program_id')->textInput() ?>

    <?= $form->field($model, 'id_tahun')->textInput() ?>

    <?= $form->field($model, 'Kd_Perubahan_Renstra')->textInput() ?>

    <?= $form->field($model, 'Kd_Dokumen_Renstra')->textInput() ?>

    <?= $form->field($model, 'Kd_Usulan_Renstra')->textInput() ?>

    <?= $form->field($model, 'Kd_Urusan_Renstra')->textInput() ?>

    <?= $form->field($model, 'Kd_Bidang_Renstra')->textInput() ?>

    <?= $form->field($model, 'Kd_Unit_Renstra')->textInput() ?>

    <?= $form->field($model, 'No_Misi_Renstra')->textInput() ?>

    <?= $form->field($model, 'No_Tujuan_Renstra')->textInput() ?>

    <?= $form->field($model, 'No_Sasaran_Renstra')->textInput() ?>

    <?= $form->field($model, 'Kd_Prog_Renstra')->textInput() ?>

    <?= $form->field($model, 'ID_Prog_Renstra')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php IF($model->isNewRecord){

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
                $("#myModal").modal('hide'); //hide modal after submit
                //$(\$form).trigger("reset"); //reset form to reuse it to input
                $.pjax.reload({container:'#trenja-program-pjax'});
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
                $.pjax.reload({container:'#trenja-program-pjax'});
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