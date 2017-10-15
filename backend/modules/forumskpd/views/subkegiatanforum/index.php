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

$this->title = 'Verifikasi Data Usulan '.(DATE('Y')+1);
$this->params['breadcrumbs'][] = ['label' => 'Forum SKPD', 'url' => ['subkegiatan/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subkegiatan-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= Yii::$app->user->identity->tperan->sub->Nm_Sub_Unit ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">    
                <?php Pjax::begin(); ?>    
                <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'export' => false, 
                        'responsive'=>true,
                        'hover'=>true,
                        //'panel'=>['type'=>'primary', 'heading'=>'Daftar Kegiatan Rencana Kerja 2017'],                        
                        'summary' => "<small>Menampilkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> Usulan</small>",
                        'emptyText' => '<small><i>Tidak ada Usulan sampai saat ini.</i></small>',                        
                        'columns' => [
                            ['class' => 'kartik\grid\SerialColumn'],
                            [
                                'attribute'=>'program', 
                                'width'=>'310px',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return $model->renjaKegiatan->program->uraian;
                                },
                                'group'=>true,  // enable grouping,
                                'groupedRow'=>true,                    // move grouped column to a single grouped row
                                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                                'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
                            ],                            
                            [
                                'attribute' => 'renja_kegiatan_id',
                                'label' => 'Kegiatan',
                                //'noWrap' => false,
                                //'contentOptions' => ['style' => ['max-width' => '280px' /*,'class' => 'text-wrap',*/ ]],
                                'contentOptions' => ['style'=>'max-width: 280px; overflow: hidden; word-wrap: break-word;'],
                                'value'=> function($model){
                                    //return Html::encode(strlen($model->renjaKegiatan->uraian) >= 40 ? substr($model->renjaKegiatan->uraian, 0,40).'....' : $model->renjaKegiatan->uraian);
                                    return Html::encode($model->renjaKegiatan->uraian);
                                }
                                
                            ],    
                            [
                                'attribute' => 'uraian',
                                'label' => 'Usulan',
                                //'contentOptions' => ['style' => ['max-width' => '280px' /*,'class' => 'text-wrap',*/ ]],
                                'contentOptions' => ['style'=>'max-width: 280px; overflow: hidden; word-wrap: break-word;'],
                                'value'=> function($model){
                                    return Html::encode($model->uraian);
                                }
                                
                            ],                                                     
                            //'kd_kecamatan',
                            //'kd_kelurahan',
                            [
                                'attribute' => 'skpd',
                                'label' => 'SKPD',
                                'contentOptions' => ['style' => ['max-width' => '40px;' /*,'class' => 'text-wrap',*/ ]],
                                'value'=> function($model){
                                    return Html::encode($model->skpd);
                                }
                                
                            ],
                            // 'rt',
                            // 'lokasi',
                            // 'volume',
                            // 'satuan',
                            // 'harga_satuan',
                            [
                                'attribute' => 'input_status',
                                'label' => 'Status',
                                'value' => 'inputStatus.keterangan',
                            ],
                            // 'biaya',
                            [
                                'attribute' => 'biaya',
                                'value'=> function($model){
                                    return "Rp ".number_format($model->biaya,0,",",".");
                                }
                                
                            ],                            
                            // 'keterangan:ntext',
                            // 'kd_asb',
                            // 'input_phased',
                            // 'status_phased',
                            // 'created_at',
                            // 'updated_at',
                            // 'user_id',
                            [
                                'label' => 'Aksi',
                                'format'=>'raw',
                                'value' => function ($model, $image) use ($jadwal, $proses){
                                    //return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model->id.');return false;']);
                                    IF(isset($jadwal) && DATE('Y-m-d') >= $jadwal['tgl_mulai'] && DATE('Y-m-d') <= $jadwal['tgl_selesai'] && ($proses == NULL || $proses->status ==1)){
                                        if($model->input_status == 1){
                                            return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model->id.');return false;']).' '.
                                                Html::a('Terima', ['terima', 'id' => $model->id], ['class' => 'btn btn-xs btn-success','data' => ['confirm' => 'Yakin menerima usulan ini?','method' => 'post',],]).' '.
                                                Html::a('Tolak', ['infotolak', 'id' => $model->id], ['class' => 'btn btn-xs btn-danger',/*'data' => ['confirm' => 'Yakin menolak usulan ini?','method' => 'post',],*/'data-toggle'=>"modal",
                                                        'data-target'=>"#myModal",
                                                        'data-title'=>"Tolak Usulan ".$model->uraian,]).' '.
                                                Html::a('Tangguhkan', ['tangguh', 'id' => $model->id], ['class' => 'btn btn-xs btn-warning','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]);
                                        }ELSEIF($model->input_status == 4){
                                            return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model->id.');return false;']).' '.
                                                Html::a('Terima', ['terima', 'id' => $model->id], ['class' => 'btn btn-xs btn-success','data' => ['confirm' => 'Yakin menerima usulan ini?','method' => 'post',],]).' '.
                                                Html::a('Tolak', ['infotolak', 'id' => $model->id], ['class' => 'btn btn-xs btn-danger',/*'data' => ['confirm' => 'Yakin menolak usulan ini?','method' => 'post',],*/'data-toggle'=>"modal",
                                                        'data-target'=>"#myModal",
                                                        'data-title'=>"Tolak Usulan ".$model->uraian,]);
                                        }ELSE{
                                            return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model->id.');return false;']).' '.
                                            Html::a('Draftkan', ['draft', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary','data' => ['confirm' => 'Yakin kembalikan ke draft?','method' => 'post',],]);
                                        }
                                    }ELSE{
                                        return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model->id.');return false;']);
                                    }
                                }               
                            ],
                            //['class' => 'yii\grid\ActionColumn'],
                        ],
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

