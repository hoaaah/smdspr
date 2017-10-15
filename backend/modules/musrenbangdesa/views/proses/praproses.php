<div class="row">
<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\assets\UsulanAsset;
use yii\bootstrap\Modal;
$image = backend\assets\UsulanAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\musrenbangdesa\models\SubkegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proses Berita Acara '.$model->no_ba;
$this->params['breadcrumbs'][] = ['label' => 'Musrenbang Desa/Kelurahan', 'url' => ['subkegiatan/index']];
$this->params['breadcrumbs'][] = ['label' => 'Berita Acara', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->no_ba;
?>
<div class="subkegiatan-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= "Kecamatan ".Yii::$app->user->identity->tperan->kecamatan->kecamatan." - Kelurahan/Desa ".Yii::$app->user->identity->tperan->kelurahan->desa ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <p class="text-danger">Berikut daftar kegiatan yang akan diproses. Silahkan klik tombol "Proses Data" Untuk memproses data. Data yang telah diproses tidak dapat dikembalikan lagi. 
                </p>
                <?php Pjax::begin(); ?>    
                <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'export' => false, 
                        'responsive'=>true,
                        'hover'=>true,
                        'panel'=>['type'=>'primary', 'heading'=>'Daftar Usulan Diterima pada BA ini.'.Html::a('<i class="fa fa-check"></i>Proses Data', ['proses', 'id' => $model->id], ['class' => 'btn btn-xs btn-danger pull-right','data' => ['confirm' => 'Proses Data?', 'method' => 'post']])
                        ],                        
                        'summary' => "<small><i class='fa fa-arrows-h'></i> Menampilkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> Usulan</small>",
                        'emptyText' => '<small><i>Tidak ada Usulan sampai saat ini.</i></small>',                        
                        'columns' => [
                            ['class' => 'kartik\grid\SerialColumn'],
                            [
                                'attribute'=>'kd_sub', 
                                'width'=>'310px',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return $model->renjaKegiatan->sub->Nm_Sub_Unit;
                                },
                                'group'=>true,  // enable grouping,
                                'groupedRow'=>true,                    // move grouped column to a single grouped row
                                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                                'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
                            ],                            
                            [
                                'attribute' => 'renja_kegiatan_id',
                                'label' => 'Kegiatan',
                                'contentOptions' => ['style' => ['max-width' => '280px;' /*,'class' => 'text-wrap',*/ ]],
                                'value'=> function($model){
                                    return Html::encode(strlen($model->renjaKegiatan->uraian) >= 40 ? substr($model->renjaKegiatan->uraian, 0,40).'....' : $model->renjaKegiatan->uraian);
                                }
                                
                            ],    
                            [
                                'attribute' => 'uraian',
                                'label' => 'Usulan',
                                'contentOptions' => ['style' => ['max-width' => '280px;' /*,'class' => 'text-wrap',*/ ]],
                                'value'=> function($model){
                                    return Html::encode(strlen($model->uraian) >= 40 ? substr($model->uraian, 0,40).'....' : $model->uraian);
                                }
                                
                            ],                                                     
                            //'kd_kecamatan',
                            //'kd_kelurahan',
                            [
                                'attribute' => 'rw',
                                'label' => 'RW',
                                'contentOptions' => ['style' => ['max-width' => '40px;' /*,'class' => 'text-wrap',*/ ]],
                                'value'=> function($model){
                                    return Html::encode($model->rw);
                                }
                                
                            ],
                            'biaya:currency',
                            [
                                'attribute' => 'biaya:currency',
                                'label' => 'Biaya',
                                'value'=> function($model){
                                    return "Rp ".number_format($model->biaya,0,",",".");
                                },
                                /*
                                'contentFormats' => [
                                    5 => ['format' => 'number', 'decimals'=>0, 'decPoint'=>',', 'thousandSep'=>'.'],
                                ],
                                */
                                'pageSummary' =>true,
                                'pageSummaryFunc' => GridView::F_SUM
                                
                            ],                            
                            // 'keterangan:ntext',
                            // 'kd_asb',
                            // 'input_phased',
                            // 'status_phased',
                            // 'created_at',
                            // 'updated_at',
                            // 'user_id',
                            //['class' => 'yii\grid\ActionColumn'],
                        ],                       
                        'showPageSummary' =>true,
                    ]); ?>
                <?php Pjax::end(); ?>
            </div> <!--box-body-->

        <p>
            <?php // Html::a('Tambah Usulan', ['create'], ['class' => 'btn btn-xs btn-success']) ?>
        </p>            
        </div><!--box-->
    </div><!--col12-->

</div><!--subkegiatan-->
</div><!--row-->
<?php 
$this->registerJs('
        function detail(obj,person_id){
            /*
                <table> 
                    <tr>
                        <td>
                            <a> */
            var a = obj; // get element anchor
            var td = $(a).parent(); // get parent dari element anchor = td
            var tr = $(td).parent(); // get element tr
            var tdCount = $(tr).children().length; // get jumlah kolom pada tr
            var table = $(tr).parent(); // get element table
            $(table).children(".trDetail").remove(); // initialise, drop all of child with class trDetail
             
            var trDetail = document.createElement("tr"); // create element tr for detail
            $(trDetail).attr("class","trDetail"); // add class trDetail for element tr 
            var tdDetail = document.createElement("td"); // create element td for detail tr
            $(tdDetail).attr("colspan",tdCount); // add element coolspan at td
            $(tdDetail).html("<span class=\'fa fa-spinner fa-spin\'></span>"); // loader kaka.. <img src="http://www.hafidmukhlasin.com/wp-includes/images/smilies/icon_smile.gif" alt=":)" class="wp-smiley"> 
             
            // get content via ajax
            $.get("'.\yii\helpers\Url::to(['subkegiatan/detail']).'&id="+person_id, function( data ) {
              $(tdDetail).html( data );
            }).fail(function() {
                alert( "Terjadi Kesalahan Coba refresh halaman ini." );
              });
            $(trDetail).append(tdDetail); // add td to tr
            $(tr).after(trDetail);  // add tr to table
        }
     
', \yii\web\View::POS_HEAD) ?>
<?php
Modal::begin([
    'id' => 'myModal',
    'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
]);
 
echo '...';
 
Modal::end();

Modal::begin([
    'id' => 'myModalkegiatan',
    'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
]);
 
echo '...';
 
Modal::end();

$this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
");
$this->registerJs("
    $('#myModalkegiatan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
       
");
?>

