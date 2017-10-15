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

    <?php 
            echo $form->field($model, 'No_Misi')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\TaMisiRPJMD::find()->where('no_misi NOT IN (98,99) AND ID_Tahun = '.$ID_Tahun)->all(),'No_Misi','Ur_Misi'),
                'options' => ['placeholder' => 'Pilih Misi ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
    ?>
    <?php  echo $form->field($model, 'No_Tujuan')->widget(DepDrop::classname(), [
            'options'=>['id'=>'tasasaranrpjmd-no_tujuan'],
            'pluginOptions'=>[
                'depends'=>['tasasaranrpjmd-no_misi'],
                'placeholder'=>'Pilih Tujuan',
                'url'=>Url::to(['tujuan'])
            ]
        ]); ?>
    <?php echo $form->field($model, 'No_Sasaran')->widget(DepDrop::classname(), [
            'pluginOptions'=>[
                'depends'=>['tasasaranrpjmd-no_misi', 'tasasaranrpjmd-no_tujuan'],
                'placeholder'=>'Pilih Sasaran',
                'url'=>Url::to(['sasaran'])
            ]
        ]);
    ?>

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
                $("#myModal").modal('hide'); //hide modal after submit
                //$(\$form).trigger("reset"); //reset form to reuse it to input
                $.pjax.reload({container:'#sasaran-pjax{$id}'});
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
                $("#myModalDesubah").modal('hide'); //hide modal after submit
                //$(\$form).trigger("reset"); //reset form to reuse it to input
                $.pjax.reload({container:'#sasaran-pjax{$model->Kd_Prioritas}'});
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