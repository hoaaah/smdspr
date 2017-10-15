<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
$image = frontend\assets\UsulanAsset::register($this);
/* @var $this yii\web\View */
/* @var $model common\models\Subkegiatan */

$this->title = 'Ubah Usulan: ' . Html::encode($model->uraian);
$this->params['breadcrumbs'][] = ['label' => 'Rencana Kerja', 'url' => ['Renjakegiatan/index']];
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="subkegiatan-update">
    <div class="body-content">
        <div id="page-wrapper">  
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            Info Kegiatan
                        </div>
                        <div class="panel-body">
                            <?= DetailView::widget([
                                'model' => $kegiatan,
                                'attributes' => [
                                    'tahun',
                                    'uraian',   
                                   	[   'attribute'=>'Pagu Kegiatan ini',
                                        'value'=> "Rp ".number_format($kegiatan->pagu_kegiatan,0,",","."),
                                    ],  
                                    [   'attribute'=>'Pagu Musrenbang',
                                        'value'=> "Rp ".number_format($kegiatan->pagu_musrenbang,0,",","."),
                                    ],                  
                                    /*
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
                                    */
                                    [
                                        'attribute' => 'info_asb',
                                        'format' => 'raw',
                                        'value' => '<b class="text-danger">'.Html::encode($kegiatan->info_asb).'</b>',
                                    ],                      
                                ],
                            ]) ?>
                        </div>
                    </div> <!-- well -->
                    <div class="col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Masukkan informasi berkaitan usulan anda.
                            </div>
                            <div class="panel-body">                    
                                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                                <?= $form->field($model, 'uraian')->textarea(['rows' => 2],['maxlength' => true]) ?>

                                <?php // echo $form->field($modelPeran, 'kd_kecamatan')->dropDownList(ArrayHelper::map(Kecamatan::find()->all(),'kd_kecamatan','kecamatan'), ['prompt'=>'Pilih Kecamatan']);?>
                                <?php // echo $form->field($modelPeran, 'kd_kelurahan')->dropDownList(ArrayHelper::map(Desa::find()->all(),'id','desa'), ['prompt'=>'Pilih Kelurahan/Desa']);?>

                                <?= $form->field($model, 'rt')->textInput() ?>

                                <?php // $form->field($model, 'lokasi')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'volume')->textInput(['id' => 'volume']) ?>

                                <?= $form->field($model, 'satuan')->textInput() ?>

                                <?= $form->field($model, 'harga_satuan')->textInput(['id' => 'harga_satuan']) ?>

                                <?= $form->field($model, 'biaya')->textInput(['id' => 'biaya']) ?>

                                <?= $form->field($model, 'keterangan')->textarea(['rows' => 3]) ?>
                            </div>
                        </div>
                    </div>
		            <div class="col-lg-4"> 
		                <?php foreach($photo as $photo) :?>            
		                <div class="panel panel-default">
		                    <div class="panel-heading">
		                        <h3 class="panel-title"><?= Html::encode($photo->caption) ?></h3>
		                    </div>
		                    <div class="panel-body">
		                        <?php echo Html::img($image->baseUrl.'/'.$photo->file, ['class' => 'pull-left img-responsive']); ?>
		                    </div>
		                </div>
		                <?php endforeach;?>                             
		            </div>
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissible">
                            <h4>
                                <i class="icon fa fa-ban"></i>
                                Perhatian Sebelum Simpan
                            </h4>
                            <p><?= Html::encode($kegiatan->info_asb) ?></p>
                            <p>Perhatikan kembali volume dan harga satuan dan infokan keterangan volume. Kesalahan harga satuan dan volume akan berakibat ditolaknya usulan. </p>
                        </div>
                        <?= $form->field($historis, 'alasan_perubahan')->textarea(['rows' => 2],['maxlength' => true]) ?>
                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div><!-- row -->
        </div> <!--page wrapper-->
    </div><!-- body content-->
</div>

<?php
$this->registerJs("$('#volume, #harga_satuan').keyup(function(){
        var volume = $('#volume').val(),
            harga_satuan = $('#harga_satuan').val(),
            biaya = 0;
        harga_satuan = harga_satuan - 0;//convert to integer
        volume = volume - 0;//convert to integer
        biaya = volume * harga_satuan;
        if(isNaN(biaya)) { var biaya = 0;}
        $('#biaya').val(biaya);
});"); 
?>
