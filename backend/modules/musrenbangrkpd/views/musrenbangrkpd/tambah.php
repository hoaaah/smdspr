<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Subkegiatan */

$this->title = 'Usulan Lokasi';
$this->params['breadcrumbs'][] = ['label' => 'Rencana Kerja', 'url' => ['Renjaprogram/index']];
//$this->params['breadcrumbs'][] = ['label' => 'Kegiatan '.$kegiatan->uraian, 'url' => ['Renjakegiatan/'.$kegiatan->id]];
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'Usulan Lokasi <small>Kegiatan '.$kegiatan->uraian.'</small>'
?>
<div class="subkegiatan-create">
    <?= DetailView::widget([
        'model' => $kegiatan,
        'attributes' => [
            'id',
            'tahun',
            'uraian',   
           	[   'attribute'=>'Pagu',
                'value'=> "Rp ".number_format($kegiatan->pagu_kegiatan,0,",","."),
            ],                   
            [   'attribute'=>'Diinput Tahap',
                'value'=> $kegiatan->phased->keterangan,
            ],            
            'status',
            [   'attribute'=>'Capaian Tahap',
                'value'=> $kegiatan->statusPhased->keterangan,
            ],           
            [   'attribute'=>'User',
                'value'=> $kegiatan->user->nama,
            ],    
            'created_at:date',
            'updated_at:date',                       
        ],
    ]) ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uraian')->textarea(['rows' => 2],['maxlength' => true]) ?>

    <?php // echo $form->field($modelPeran, 'kd_kecamatan')->dropDownList(ArrayHelper::map(Kecamatan::find()->all(),'kd_kecamatan','kecamatan'), ['prompt'=>'Pilih Kecamatan']);?>
    <?php // echo $form->field($modelPeran, 'kd_kelurahan')->dropDownList(ArrayHelper::map(Desa::find()->all(),'id','desa'), ['prompt'=>'Pilih Kelurahan/Desa']);?>

    <?= $form->field($model, 'rt')->textInput() ?>

    <?= $form->field($model, 'lokasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'volume')->textInput() ?>

    <?= $form->field($model, 'biaya')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
