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
            echo $form->field($model, 'Kd_Urusan')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\Urusan::find()->all(),'Kd_Urusan','Nm_Urusan'),
                'options' => ['placeholder' => 'Pilih Urusan ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
    ?>
    <?php  echo $form->field($model, 'Kd_Bidang')->widget(DepDrop::classname(), [
            'options'=>['id'=>'tapelaksanakegskpd-kd_bidang'],
            'pluginOptions'=>[
                'depends'=>['tapelaksanakegskpd-kd_urusan'],
                'placeholder'=>'Pilih Bidang ...',
                'url'=>Url::to(['bidang'])
            ]
        ]); ?>

    <?php echo $form->field($model, 'Kd_Unit')->widget(DepDrop::classname(), [
            'pluginOptions'=>[
                'depends'=>['tapelaksanakegskpd-kd_urusan', 'tapelaksanakegskpd-kd_bidang'],
                'placeholder'=>'Pilih Unit',
                'url'=>Url::to(['unit'])
            ]
        ]);
    ?>

    <?php echo $form->field($model, 'Kd_Sub')->widget(DepDrop::classname(), [
            'pluginOptions'=>[
                'depends'=>['tapelaksanakegskpd-kd_urusan', 'tapelaksanakegskpd-kd_bidang', 'tapelaksanakegskpd-kd_unit'],
                'placeholder'=>'Pilih Sub',
                'url'=>Url::to(['sub'])
            ]
        ]);
    ?>    

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
                $("#myModalPelaksana").modal('hide'); //hide modal after submit
                //$(\$form).trigger("reset"); //reset form to reuse it to input
                $.pjax.reload({container:'#pelaksana-pjax'});
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