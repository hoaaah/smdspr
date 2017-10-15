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

$this->title = 'Sinkronisasi RKPD-Renja '.(DATE('Y')+1);
$this->params['breadcrumbs'][] = ['label' => 'Musrenbang RKPD', 'url' => ['subkegiatan/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subkegiatan-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Musrenbang RKPD 2017</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">    
                <?php echo $this->render('_search', ['model' => $searchModel, 'query' => $query]); ?>               
                <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'export' => false, 
                        'responsive'=>true,
                        'hover'=>true,
                        //'panel'=>['type'=>'primary', 'heading'=>'Daftar Kegiatan Rencana Kerja 2017'],                        
                        'summary' => "<small>Menampilkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> Usulan</small>",
                        'emptyText' => '<small><i>Tidak ada Usulan sampai saat ini.</i></small>',
                        'pjax'=>true,
                        'pjaxSettings'=>[
                            'options' => ['id' => 'rkpd-pjax', 'timeout' => 5000],
                        ],                                           
                        'columns' => [
                            ['class' => 'kartik\grid\SerialColumn'],
                            'pagu_kegiatan:currency',
                            'biaya:currency',
                            'selisih:currency',
                            'program',
                            //'tahun',
                            [
                                'label' => 'Kegiatan',
                                'attribute' => 'uraian',
                            ],
                            [
                                'label' => 'Perbandingan',
                                'format' => 'raw',
                                'value'=> function($model){
                                    return Html::a('<button type="button" class="btn btn-xs btn-default">Ubah Capaian Program</button>', '#',['onclick'=>'detail(this,1);return false;']).Html::a('<button type="button" class="btn btn-xs btn-default">Kegiatan</button>', '#',['onclick'=>'detail(this,1);return false;']).Html::a('<button type="button" class="btn btn-xs btn-default">Ubah Capaian Kegiatan</button>', '#',['onclick'=>'detail(this,1);return false;']).Html::a('<button type="button" class="btn btn-xs btn-default">Verifikasi Usulan</button>', '#',['onclick'=>'detail(this,1);return false;']);
                                }
                                
                            ],                             
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
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

