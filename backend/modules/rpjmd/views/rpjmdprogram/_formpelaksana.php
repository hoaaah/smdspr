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
            'options'=>['id'=>'tapelaksanaprogrpjmd-kd_bidang'],
            'pluginOptions'=>[
                'depends'=>['tapelaksanaprogrpjmd-kd_urusan'],
                'placeholder'=>'Pilih Bidang ...',
                'url'=>Url::to(['bidang'])
            ]
        ]); ?>

    <?php echo $form->field($model, 'Kd_Unit')->widget(DepDrop::classname(), [
            'pluginOptions'=>[
                'depends'=>['tapelaksanaprogrpjmd-kd_urusan', 'tapelaksanaprogrpjmd-kd_bidang'],
                'placeholder'=>'Pilih Unit',
                'url'=>Url::to(['unit'])
            ]
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
list($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog) = explode('.', $id);
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
                $.pjax.reload({container:'#pelaksana-pjax{$ID_Tahun}{$Kd_Prov}{$Kd_Kab_Kota}{$Kd_Perubahan}{$Kd_Dokumen}{$Kd_Usulan}{$No_Misi}{$No_Tujuan}{$No_Sasaran}{$Kd_Prog}{$Id_Prog}'});
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