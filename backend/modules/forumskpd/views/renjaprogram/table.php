<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use kartik\grid\GridView;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RenjaProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rencana Kerja';
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'Rencana Kerja '.(DATE('Y')+1).'<small>Program</small>'
?>

<div class="renja-program-index">
    <div class="body-content">
        <div id="page-wrapper"> 
            <div class="row">
<!--COBA COBA TAB BAGUS G -->

                <div class="col-md-12">
                  <!-- Custom Tabs -->
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li ><?php echo Html::a('Tampilan Kartu', ['index']) ?></li>
                      <!--<li><a href="#tab_2" data-toggle="tab">Tampilan Tabel</a></li>-->
                      <li class="active"><a href="#tab_2" data-toggle="tab">Tampilan Tabel</a></li>
                      
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab_1">
                        <div class="table-responsive">
                            <?php  Pjax::begin();?>
                            <?= GridView::widget([
                                'dataProvider' => $dataKegiatan,
                                'filterModel' => $searchKegiatan,  
                                'export' => false, 
                                'responsive'=>true,
                                'hover'=>true,
                                //'panel'=>['type'=>'primary', 'heading'=>'Daftar Kegiatan Rencana Kerja 2017'],
                                /*
                                'pjax'=>true,
                                'pjaxSettings'=>[
                                    'neverTimeout'=>true,
                                    'beforeGrid'=>'My fancy content before.',
                                    'afterGrid'=>'My fancy content after.',
                                ],                                                                                  */
                                'summary' => "<small>Menampilkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> Kegiatan</small>",
                                'emptyText' => '<small><i>Tidak ada Kegiatan pada Program ini.</i></small>',                
                                'columns' => [
                                    ['class'=>'kartik\grid\SerialColumn'],
                                    [
                                        'attribute'=>'id_renprog', 
                                        'width'=>'310px',
                                        'value'=>function ($model, $key, $index, $widget) { 
                                            return $model->program->uraian;
                                        },
                                        /*
                                        'filterType'=>GridView::FILTER_SELECT2,
                                        'filter'=>ArrayHelper::map($query, 'kd_program', 'uraian'), 
                                        'filterWidgetOptions'=>[
                                            'pluginOptions'=>['allowClear'=>true],
                                        ],
                                        'filterInputOptions'=>['placeholder'=>'Program'],
                                        */
                                        'group'=>true,  // enable grouping,
                                        'groupedRow'=>true,                    // move grouped column to a single grouped row
                                        'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                                        'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
                                    ],                                   
                                    [
                                        'label' => 'Kegiatan',
                                        'attribute' => 'uraian',
                                        'format' => 'raw',
                                        'value'=> function($model){
                                            return Html::a(Html::encode(strlen($model->uraian) >= 65 ? substr($model->uraian, 0,65).'....' : $model->uraian), ['kegiatanrinci', 'id'=>$model->id],[
                                                                    'data-toggle'=>"modal",
                                                                    'data-target'=>"#myModalkegiatan",
                                                                    'data-title'=>"Detail Kegiatan ".$model->uraian,
                                                                    ]);
                                        }
                                        
                                    ],                  
                                    //'pagu_kegiatan:currency:Pagu Kegiatan',
                                    [
                                        //'label' => 'PAGU',
                                        'attribute' => 'pagu_kegiatan',
                                        'value'=> function($model){
                                            return "Rp ".number_format($model->pagu_kegiatan,0,",",".");
                                        }
                                        
                                    ],
                                    [
                                        //'label' => 'PAGU',
                                        'attribute' => 'pagu_musrenbang',
                                        'value'=> function($model){
                                            return "Rp ".number_format($model->pagu_musrenbang,0,",",".");
                                        }
                                        
                                    ],                                    
                                    [
                                        'label' => 'Aksi',
                                        'format' => 'raw',
                                        'value'=> function($model){
                                            return Html::a('<button type="button" class="btn btn-xs btn-default">Lihat Rincian</button>', ['kegiatanrinci', 'id'=>$model->id],[
                                                                    'data-toggle'=>"modal",
                                                                    'data-target'=>"#myModalkegiatan",
                                                                    'data-title'=>"Detail Kegiatan ".$model->uraian,
                                                                    ]);
                                        }
                                        
                                    ],                  
                                    //['class' => 'kartik\grid\ActionColumn'],
                                ],
                            ]); ?>
                            <?php  Pjax::end();?>
                        </div>
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_2">
                        asdasd
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div>
                  <!-- nav-tabs-custom -->
                </div>
                <!-- /.col -->




<!--COBA COBA TAB BAGUS G -->        
            </div><!-- row -->
        </div><!-- page-wrapper -->
    </div><!-- body-content -->
<div><!-- renja-program-index -->
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