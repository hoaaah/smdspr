<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Group;
use common\models\Peran;
use common\models\Kecamatan;
use kartik\select2\Select2;
use kartik\widgets\DepDrop;

$this->title = 'Tambah User';
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-form">
    <h1>Data User</h1>
    <p>Lengkapi data di bawah ini dengan data user:</p>

    <div class="row">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="col-lg-5">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="col-lg-5">
                <?= $form->field($model, 'email') ?>
        </div>
    </div>    
    <div class="row">        
        <div class="col-lg-5">
                <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
    </div>
    <div class="row">         
        <div class="col-lg-5">
                <?= $form->field($model, 'nama') ?>
        </div>
        <div class="col-lg-5">
                <?= $form->field($model, 'contact') ?>
        </div>
    </div>  
    <div class="row">       
        <div class="col-lg-5">
                <?= $form->field($model, 'jabatan') ?>
        </div>
        <div class="col-lg-5">
                <?php echo $form->field($model, 'kd_user')->dropDownList(ArrayHelper::map(Group::find()->all(),'id','name'), ['prompt'=>'Pilih Jenis User']);?>
        </div>
        <div class="col-lg-5">
                <?php echo $form->field($model, 'kd_peran')->dropDownList(ArrayHelper::map(Peran::find()->all(),'id','name'), ['prompt'=>'Pilih Peran Anda']);?>
        </div>
        <div class="col-lg-5">
                <?= $form->field($model, 'alamat') ?>
        </div>
    </div>
    <div class="row"> 
        <div class="col-lg-5">        
            <h1>Data SKPD</h1>
            <p>Lengkapi data di bawah ini dengan data SKPD dari User (Untuk User SKPD):</p>
            <?php 
            $skpd = \Yii::$app->db->createCommand('SELECT CONCAT(Kd_Urusan,".", Kd_Bidang,".",Kd_Unit,".",Kd_Sub) AS kd_skpd, Nm_Sub_Unit FROM r_sub_unit');
            $query = $skpd->queryAll();
            $data = ArrayHelper::map($query, 'kd_skpd','Nm_Sub_Unit');
            echo $form->field($modelPeran, 'skpd')->widget(Select2::classname(), [
                'data' => $data,
                'options' => ['placeholder' => 'Pilih SKPD ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
            ?>  
        </div>
        <div class="col-lg-5">
            <h1>Data Lokasi</h1>
            <p>Lengkapi data di bawah ini dengan data Lokasi User (Untuk User Musrenbang):</p>        
            <?php echo $form->field($modelPeran, 'kd_kecamatan')->dropDownList(ArrayHelper::map(Kecamatan::find()->all(),'kd_kecamatan','kecamatan'), ['prompt'=>'Pilih Kecamatan...']);?>

            <?php  echo $form->field($modelPeran, 'kd_kelurahan')->widget(DepDrop::classname(), [
                    'options'=>['id'=>'tperan-kd_kelurahan'],
                    'pluginOptions'=>[
                        'depends'=>['tperan-kd_kecamatan'],
                        'placeholder'=>'Pilih Kelurahan/Desa...',
                        'url'=>Url::to(['kelurahan'])
                    ]
                ]); ?>            
            <?php // echo $form->field($modelPeran, 'kd_kelurahan')->dropDownList(ArrayHelper::map(Desa::find()->all(),'id','desa'), ['prompt'=>'Pilih Kelurahan/Desa']);?>
            <?= $form->field($modelPeran, 'rw')->textInput() ?>

        </div>        
    </div> 
    <div class="row">  
        <div class="col-lg-5">

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
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