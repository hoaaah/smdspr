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
    <h3>Data Program</h3>
    <p>Lengkapi data berikut berkaitan dengan program:</p>    

    <?php //echo  $form->field($model, 'ID_Tahun')->textInput() ?>

    <?php 
            echo $form->field($model, 'No_Misi')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\TaMisiRPJMD::find()->where('no_misi NOT IN (98,99) AND ID_Tahun = (SELECT MAX(ID_Tahun) FROM ta_misi_rpjmd)')->all(),'No_Misi','Ur_Misi'),
                'options' => ['placeholder' => 'Pilih Misi ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
    ?>
    <?php  echo $form->field($model, 'No_Tujuan')->widget(DepDrop::classname(), [
            'options'=>['id'=>'rpjmdprogram-no_tujuan'],
            'pluginOptions'=>[
                'depends'=>['rpjmdprogram-no_misi'],
                'placeholder'=>'Pilih Tujuan',
                'url'=>Url::to(['tujuan'])
            ]
        ]); ?>
    <?php echo $form->field($model, 'No_Sasaran')->widget(DepDrop::classname(), [
            'pluginOptions'=>[
                'depends'=>['rpjmdprogram-no_misi', 'rpjmdprogram-no_tujuan'],
                'placeholder'=>'Pilih Sasaran',
                'url'=>Url::to(['sasaran'])
            ]
        ]);
    ?>

    <?php IF(!$model->isNewRecord) echo $form->field($model, 'Kd_Prog')->textInput() ?>

    <?php //echo   $form->field($model, 'Id_Prog')->textInput() ?>

    <?= $form->field($model, 'Ket_Program')->textInput(['maxlength' => true]) ?>
    <hr>
    <h3>Data Bidang Program</h3>
    <p>Lengkapi data di bawah ini dengan data urusan dan bidang dari program:</p>    

    <?php 
            echo $form->field($model, 'Kd_Urusan1')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\Urusan::find()->all(),'Kd_Urusan','Nm_Urusan'),
                'options' => ['placeholder' => 'Pilih Urusan ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
    ?>
    <?php  echo $form->field($model, 'Kd_Bidang1')->widget(DepDrop::classname(), [
            'options'=>['id'=>'rpjmdprogram-kd_bidang1'],
            'pluginOptions'=>[
                'depends'=>['rpjmdprogram-kd_urusan1'],
                'placeholder'=>'Pilih Bidang ...',
                'url'=>Url::to(['bidang'])
            ]
        ]); ?>

    <hr>
    <h3>Data Pagu</h3>
    <p>Lengkapi data di bawah ini dengan pagu program setiap tahunnya:</p>

    <div class="row">
        <div class="col-sm-2">
        <?= $form->field($pagu, 'PaguTahun1')->textInput() ?>
        </div>
        <div class="col-sm-2">
        <?= $form->field($pagu, 'PaguTahun2')->textInput() ?>
        </div>
        <div class="col-sm-2">   
        <?= $form->field($pagu, 'PaguTahun3')->textInput() ?>
        </div>
        <div class="col-sm-2">   
        <?= $form->field($pagu, 'PaguTahun4')->textInput() ?>
        </div>
        <div class="col-sm-2">   
        <?= $form->field($pagu, 'PaguTahun5')->textInput() ?>
        </div>
        <div class="col-sm-2">   
        <?= $form->field($pagu, 'Satuan')->textInput() ?>
        </div>
    </div> 


    <hr>
    <?php /*
    <h3>Data Indikator/Capaian</h3>
    <p>Lengkapi data di bawah ini dengan indikator program setiap tahunnya, jika di salah satu tahun tidak dianggarkan maka isi indikator dengan 0 :</p> 
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
            'No_ind_Prog',
            'Tolak_Ukur',
            'Kondisi_Kinerja_Awal',
            'Kondisi_Kinerja_Akhir',
            'NilaiTahun1',
            'NilaiTahun2',
            'NilaiTahun3',
            'NilaiTahun4',
            'NilaiTahun5',
            'Target_Uraian',
            'Satuan',
            'Jn_Indikator',
            'Jn_Indikator2',
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
                        <?= $form->field($capaian, "[{$index}]No_ind_Prog")->textInput(['maxlength' => true]) ?>

                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($capaian, "[{$index}]Tolak_Ukur")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($capaian, "[{$index}]Target_Uraian")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- end:row -->

                        <div class="row">
                            <div class="col-sm-2">
                                <?= $form->field($capaian, "[{$index}]NilaiTahun1")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($capaian, "[{$index}]NilaiTahun2")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($capaian, "[{$index}]NilaiTahun3")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($capaian, "[{$index}]NilaiTahun4")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($capaian, "[{$index}]NilaiTahun5")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($capaian, "[{$index}]Satuan")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($capaian, "[{$index}]Kondisi_Kinerja_Awal")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($capaian, "[{$index}]Kondisi_Kinerja_akhir")->textInput(['maxlength' => true]) ?>
                            </div>                            
                        </div><!-- end:row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <?php echo $form->field($capaian, "[{$index}]Jn_Indikator")->dropDownList(ArrayHelper::map(\common\models\Rindikator2::find()->all(),'id','jn_indikator'), ['prompt'=>'Jenis Target...'])->label(false);?>                                
                            </div>
                            <div class="col-sm-6">
                                <?php echo $form->field($capaian, "[{$index}]Jn_Indikator2")->dropDownList(ArrayHelper::map(\common\models\Rindikator3::find()->all(),'id','jn_indikator'), ['prompt'=>'Tipe Target'])->label(false);?>
                            </div>                            
                        </div><!-- end:row -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>    
    <?php DynamicFormWidget::end(); */?>  


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
                $("#myModalDes").modal('hide'); //hide modal after submit
                //$(\$form).trigger("reset"); //reset form to reuse it to input
                $.pjax.reload({container:'#program-pjax'});
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
                $.pjax.reload({container:'#program-pjax'});
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