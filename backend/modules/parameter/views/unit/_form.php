<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model common\models\Unit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unit-form">

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
    <?php
    //here are for preselected select2 ----@hoaaah
    // echo Html::hiddenInput('Kd_Urusan', $model->Kd_Urusan, ['id'=>'Kd_Urusan' ]);
    // echo Html::hiddenInput('Kd_Bidang', $model->Kd_Bidang, ['id'=>'Kd_Bidang' ]);

    IF(isset($data)){
	    $data = \common\models\Bidang::find()
	           ->where([
	            'Kd_Urusan'=> $data->Kd_Urusan,
	            'Kd_Bidang' => $data->Kd_Bidang,
	            ])
	           ->select(['Kd_Bidang AS id','Nm_Bidang AS name'])->asArray()->all();
    }
    echo $form->field($model, 'Kd_Bidang')->widget(DepDrop::classname(), [
            'options'=>['id'=>'unit-kd_bidang', 'placeholder' => 'Pilih Bidang ...'],
            'pluginOptions'=>[
                'depends'=>['unit-kd_urusan'],
                'placeholder'=>'Pilih Bidang ...',
                'url'=>Url::to(['bidang']),
                //'params' => ['Kd_Urusan1', 'Kd_Bidang1'] //got from hiddeninput
            ],
            'data' => $model->Kd_Bidang ? ArrayHelper::map($data,'id','name') : [],
        ])->label(false);
    ?>

    <?php
 //    echo Html::hiddenInput('Kd_Urusan1', $model->Kd_Urusan, ['id'=>'Kd_Urusan1' ]);
 //    echo Html::hiddenInput('Kd_Bidang1', $model->Kd_Bidang, ['id'=>'Kd_Bidang1' ]);

	// echo $form->field($model, 'Kd_Bidang')->widget(DepDrop::classname(), [
	// 'options' => ['placeholder' => 'Select ...'],
	// 'type' => DepDrop::TYPE_SELECT2,
	// 'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
	// 'pluginOptions'=>[
	//     'depends'=>['unit-kd_urusan'],
	//     'url' => Url::to(['bidang1']),
	//     'placeholder'=>'Pilih Bidang ...',
	//     'loadingText' => 'Loading child level 1 ...',
	//     'params'=>['Kd_Urusan1', 'Kd_Bidang1']///SPECIFYING THE PARAM
	// ]
	// ]);
    ?>

    <?= $form->field($model, 'Kd_Unit')->textInput() ?>

    <?= $form->field($model, 'Nm_Unit')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Tambah') : Yii::t('app', 'Ubah'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
                $.pjax.reload({container:'#unit-pjax'});
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
                $("#myModalUbah").modal('hide'); //hide modal after submit
                //$(\$form).trigger("reset"); //reset form to reuse it to input
                $.pjax.reload({container:'#unit-pjax'});
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