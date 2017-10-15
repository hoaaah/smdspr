<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaPemdaUmum */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-pemda-umum-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <?= $form->field($model, 'Kd_Prov')->textInput() ?>

    <?= $form->field($model, 'Kd_Kab_Kota')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Ur_Visi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_Provinsi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_Pemda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_PimpDaerah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jab_PimpDaerah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_Sekda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nip_Sekda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jbt_Sekda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Ibukota')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJs(<<<JS
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
                    $.pjax.reload({container:'#ta-pemda-umum-pjax'});
                }else
                {
                    $("#message").html(result);
                }
            }).fail(function(){
                console.log("server error");
            });
        return false;
    });
JS
);
?>