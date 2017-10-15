<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\widgets\MaskedInput;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\widgets\DepDrop;
use common\models\Desa;
use common\models\Kecamatan;


/* @var $this yii\web\View */
/* @var $model common\models\Subkegiatan */

$this->title = 'Usulan Lokasi';
$this->params['breadcrumbs'][] = ['label' => 'Rencana Kerja', 'url' => ['Renjaprogram/index']];
//$this->params['breadcrumbs'][] = ['label' => 'Kegiatan '.$kegiatan->uraian, 'url' => ['Renjakegiatan/'.$kegiatan->id]];
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'Usulan Lokasi <small>Kegiatan '.$kegiatan->uraian.'</small>'
?>
<?php // Yii::$app->params['uploadUrl'] ?>

<div class="subkegiatan-tambah">
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

                                <?= $form->field($model, 'rt')->textInput() ?>

                                <?php // $form->field($model, 'lokasi')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'volume')->textInput(['id' => 'volume']) ?>

                                <?= $form->field($model, 'satuan')->textInput() ?>

                                <?= $form->field($model, 'harga_satuan')->textInput(['id' => 'harga_satuan']) ?>

                                <?php echo $form->field($model, 'biaya')->textInput(['id' => 'biaya']);
                                /*MaskedInput::widget([
                                    'name' => 'biaya',
                                    'id' => 'biaya',
                                    'clientOptions' => [
                                        'alias' =>  'decimal',
                                        'radixPoint'=> ",",
                                        'groupSeparator' => '.',
                                        'autoGroup' => true,
                                        //'removeMaskOnSubmit' => true
                                    ],
                                ]);*/
                                 ?>

                                <?= $form->field($model, 'keterangan')->textarea(['rows' => 3]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Tambahkan Foto atau dokumentasi untuk melengkapi usulan anda (jika diperlukan)
                                <div class="pull-right">
                                    <button type="button" class="add_field_button btn btn-info btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-warning btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>                                
                            </div>
                            <div class="panel-body">
                                <?php 
                                    //echo $form->field($photo, 'image')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'], 'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']]]);
                                    echo $form->field($photo, 'image1')->fileInput();
                                    echo $form->field($photo, 'image2')->fileInput()->label(false);
                                    echo $form->field($photo, 'image3')->fileInput()->label(false);
                                    echo $form->field($photo, 'image4')->fileInput()->label(false);
                                ?>
                                <?= $form->field($photo, 'catatan')->textarea(['rows' => 2]) ?>
                            </div>
                        </div>
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

$this->registerJs('
$(document).ready(function() {
    var max_fields      = 4; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append(\'<div><div class="form-group field-subkegiatanphoto-image"><input type="hidden" name="SubkegiatanPhoto[image\'+ x +\']" value=""><input type="file" id="subkegiatanphoto-image\'+ x +\'" name="SubkegiatanPhoto[image\'+ x +\']"><a href="#" class="remove_field">hapus</a></div></div>\'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent(\'div\').remove(); x--;
    })
});
    ');

?>