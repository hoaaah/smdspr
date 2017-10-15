<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model common\models\RkpdProgram */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
    $connection = \Yii::$app->db;           
    $skpd = $connection->createCommand('SELECT CONCAT(Kd_Urusan,".", Kd_Bidang) AS Kd_Bidang, Nm_Bidang FROM r_bidang');
    $rpjmd = $connection->createCommand('SELECT CONCAT(ID_Tahun, ".", Kd_Perubahan, ".", Kd_Dokumen, ".", Kd_Usulan, ".", No_Misi, ".", No_Tujuan, ".", No_Sasaran, ".", Kd_Prog, ".", ID_Prog, ".", Kd_Urusan1, ".", Kd_Bidang1 ) AS Kd_RPJMD, Ket_Program FROM ta_program_rpjmd WHERE ID_Tahun = 1 AND Kd_Perubahan = 1 AND Kd_Dokumen = 1 AND Kd_Usulan = 1 AND No_Misi = 1 AND No_Tujuan = 1 AND No_Sasaran = 1');
    $query = $skpd->queryAll();
    $query = $rpjmd->queryAll();
?> 
<div class="rkpd-program-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form' ,'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <?php 
            echo $form->field($model, 'no_misi')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\TaMisiRPJMD::find()->where('no_misi NOT IN (98,99) AND ID_Tahun = (SELECT MAX(ID_Tahun) FROM ta_misi_rpjmd)')->all(),'No_Misi','Ur_Misi'),
                'options' => ['placeholder' => 'Pilih Misi ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
    ?>
    <?php  echo $form->field($model, 'no_tujuan')->widget(DepDrop::classname(), [
            'options'=>['id'=>'rkpdprogram-no_tujuan'],
            'pluginOptions'=>[
                'depends'=>['rkpdprogram-no_misi'],
                'placeholder'=>'Pilih Tujuan',
                'url'=>Url::to(['tujuan'])
            ]
        ]); ?>
    <?php echo $form->field($model, 'no_sasaran')->widget(DepDrop::classname(), [
            'pluginOptions'=>[
                'depends'=>['rkpdprogram-no_misi', 'rkpdprogram-no_tujuan'],
                'placeholder'=>'Pilih Sasaran',
                'url'=>Url::to(['sasaran'])
            ]
        ]);
    ?>

    <?php 
            echo $form->field($model, 'urusan_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\Urusan::find()->all(),'Kd_Urusan','Nm_Urusan'),
                'options' => ['placeholder' => 'Pilih Urusan ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
    ?>
    <?php  echo $form->field($model, 'bidang_id')->widget(DepDrop::classname(), [
            'options'=>['id'=>'rkpdprogram-bidang_id'],
            'pluginOptions'=>[
                'depends'=>['rkpdprogram-urusan_id'],
                'placeholder'=>'Pilih Bidang',
                'url'=>Url::to(['bidang'])
            ]
        ]); ?>
       

    <?php // $form->field($model, 'no_misi')->textInput() ?>

    <?php // $form->field($model, 'no_tujuan')->textInput() ?>

    <?php // $form->field($model, 'no_sasaran')->textInput() ?>

    <?php // $form->field($model, 'id_sasrkpd')->textInput() ?>

    <?php echo $model->isNewRecord ? '' : $form->field($model, 'kd_progrkpd')->textInput() ?>

    <?= $form->field($model, 'uraian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pagu_program')->textInput() ?>

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
                            <div class="col-sm-6">
                                <?php echo $form->field($capaian, "[{$index}]kd_indikator_2")->dropDownList(ArrayHelper::map(\common\models\Rindikator2::find()->all(),'id','jn_indikator'), ['prompt'=>'Jenis Target...'])->label(false);?>                                
                            </div>
                            <div class="col-sm-6">
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