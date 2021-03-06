<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Group;
use common\models\Peran;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1>Data User</h1>
    <p>Silahkan isi informasi berikut sesuai data user:</p>

<div class="site-signup">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Data User</h3>
        </div>


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

                    <div class="form-group">
                        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
