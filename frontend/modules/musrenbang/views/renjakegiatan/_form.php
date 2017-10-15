<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TRenjaKegiatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trenja-kegiatan-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <?= $form->field($model, 'renja_program_id')->textInput() ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($model, 'id_renkeg')->textInput() ?>

    <?= $form->field($model, 'uraian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lokasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lokasi_maps')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kelompok_sasaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_kegiatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pagu_kegiatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pagu_musrenbang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kd_asb')->textInput() ?>

    <?= $form->field($model, 'info_asb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kd_bahas')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'input_phased')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'status_phased')->textInput() ?>

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
                $.pjax.reload({container:'#trenja-kegiatan-pjax'});
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
                $.pjax.reload({container:'#trenja-kegiatan-pjax'});
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