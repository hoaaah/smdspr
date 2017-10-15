<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model common\models\RenjaProgram */
/* @var $form yii\widgets\ActiveForm */
$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Indikator: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Indikator: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>

<div class="renja-kegiatan-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form' ,'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php echo $model->isNewRecord ? '' : $form->field($model, 'no_renjaProg')->textInput() ?>

    <?= $form->field($model, 'uraian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pagu_kegiatan')->textInput() ?>

    <?= $form->field($model, 'kd_bahas')->checkbox() ?>

    <?= $form->field($model, 'info_asb')->textInput() ?>

    <?= $form->field($model, 'pagu_musrenbang')->textInput() ?>    

    <?php //untuk input capaian ?>  

    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $capaian[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'no_indikator',
            'tolok_ukur',
            'target_angka',
            'target_uraian',
            'keterangan',
            'uraian',
            'kd_indikator_1',
            'kd_indikator_2',
            'kd_indikator_3',
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i> Indikator
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah Indikator</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($capaian as $index => $capaian): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-address">Indikator/Capaian</span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (!$capaian->isNewRecord) {
                                echo Html::activeHiddenInput($capaian, "[{$index}]id");
                            }
                        ?>
                        <?= $form->field($capaian, "[{$index}]no_indikator")->textInput(['maxlength' => true]) ?>

                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($capaian, "[{$index}]tolok_ukur")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($capaian, "[{$index}]uraian")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- end:row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($capaian, "[{$index}]target_angka")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($capaian, "[{$index}]target_uraian")->textInput(['maxlength' => true]) ?>
                            </div>                            
                        </div><!-- end:row -->

                        <div class="row">
                            <div class="col-sm-4">
                                <?php echo $form->field($capaian, "[{$index}]kd_indikator_1")->dropDownList(ArrayHelper::map(\common\models\Rindikator1::find()->all(),'id','jn_indikator'), ['prompt'=>'Jenis Indikator...'])->label(false);?>                                
                            </div>
                            <div class="col-sm-4">
                                <?php echo $form->field($capaian, "[{$index}]kd_indikator_2")->dropDownList(ArrayHelper::map(\common\models\Rindikator2::find()->all(),'id','jn_indikator'), ['prompt'=>'Jenis Target...'])->label(false);?>                                
                            </div>
                            <div class="col-sm-4">
                                <?php echo $form->field($capaian, "[{$index}]kd_indikator_3")->dropDownList(ArrayHelper::map(\common\models\Rindikator3::find()->all(),'id','jn_indikator'), ['prompt'=>'Tipe Target'])->label(false);?>
                            </div>                            
                        </div><!-- end:row -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>    
    <?php DynamicFormWidget::end(); ?>    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
$this->registerJs(
"$('form#{$model->formName()}').on('beforeSubmit',function(e)
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