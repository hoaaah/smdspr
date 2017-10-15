<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model common\models\Renstra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="renstra-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form' ,'options' => ['enctype' => 'multipart/form-data']]); ?>
    <h3>Data Program</h3>
    <p>Lengkapi data berikut berkaitan dengan program:</p>    

    <?php
        $connection = \Yii::$app->db;           
        $rpjmd = $connection->createCommand('SELECT
        CONCAT(a.ID_Tahun, ".",a.Kd_Prov, ".",a.Kd_Kab_Kota, ".", a.Kd_Perubahan, ".", a.Kd_Dokumen, ".", a.Kd_Usulan, ".", a.No_Misi, ".", a.No_Tujuan, ".", a.No_Sasaran, ".", a.Kd_Prog, ".",a.Id_Prog) AS Id,
        b.Ket_Program
        FROM 
        ta_pelaksana_prog_rpjmd a
        INNER JOIN ta_program_rpjmd b ON a.ID_Tahun = b.ID_Tahun AND a.Kd_Prov = b.Kd_Prov AND a.Kd_Kab_Kota = b.Kd_Kab_Kota AND a.Kd_Perubahan = b.Kd_Perubahan AND a.Kd_Dokumen = b.Kd_Dokumen AND a.Kd_Usulan = b.Kd_Usulan AND a.No_Misi = b.No_Misi AND a.No_Tujuan = b.No_Tujuan AND a.No_Sasaran = b.No_Sasaran AND a.Kd_Prog = b.Kd_Prog AND a.Id_Prog = b.Id_Prog
        WHERE a.Kd_Urusan = '.Yii::$app->user->identity->tperan->kd_urusan.' AND a.Kd_Bidang = '.Yii::$app->user->identity->tperan->kd_bidang.' AND a.Kd_Unit = '.Yii::$app->user->identity->tperan->kd_unit);
        $query = $rpjmd->queryAll();
    ?> 
    <?php 
            echo $form->field($model, 'Ur_Sasaran')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($query,'Id','Ket_Program'),
                'options' => ['placeholder' => 'Penyelarasan Program RPJMD ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
    ?>  

    <?php 
            echo $form->field($model, 'No_Misi')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\TaMisiSKPD::find()->where('no_misi NOT IN (98,99) AND ID_Tahun = (SELECT MAX(ID_Tahun) FROM ta_misi_skpd)')->andWhere([
                        'Kd_Urusan' => Yii::$app->user->identity->tperan->kd_urusan,
                        'Kd_Bidang' => Yii::$app->user->identity->tperan->kd_bidang,
                        'Kd_Unit' => Yii::$app->user->identity->tperan->kd_unit,
                        ])->all(),'No_Misi','Ur_Misi'),
                'options' => ['placeholder' => 'Pilih Misi ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
    ?>
    <?php  echo $form->field($model, 'No_Tujuan')->widget(DepDrop::classname(), [
            'options'=>['id'=>'renstra-no_tujuan'],
            'pluginOptions'=>[
                'depends'=>['renstra-no_misi'],
                'placeholder'=>'Pilih Tujuan',
                'url'=>Url::to(['tujuan'])
            ]
        ]); ?>
    <?php echo $form->field($model, 'No_Sasaran')->widget(DepDrop::classname(), [
            'pluginOptions'=>[
                'depends'=>['renstra-no_misi', 'renstra-no_tujuan'],
                'placeholder'=>'Pilih Sasaran',
                'url'=>Url::to(['sasaran'])
            ]
        ]);
    ?>

    <?php IF(!$model->isNewRecord) echo $form->field($model, 'Kd_Prog')->textInput() ?>

    <?= $form->field($model, 'Ket_Program')->textInput(['maxlength' => true]) ?>

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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 

$script = <<<JS
$('form#dynamic-form').on('beforeSubmit',function(e)
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
                $.pjax.reload({container:'#misi-pjax'});
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