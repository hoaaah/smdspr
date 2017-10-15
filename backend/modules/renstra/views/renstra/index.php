<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\renstra\models\TaMisiSKPDSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Misi-Tujuan-Sasaran';
$this->params['breadcrumbs'][] = 'Renstra';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-misi-skpd-index">

    <p>
        <?= Html::a('Tambah Misi', ['create'], [
                                                    'class' => 'btn btn-xs btn-success',
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModal",
                                                    'data-title'=>"Tambah Misi",
                                                    ]) ?>
    </p>
<?php Pjax::begin(['id' => 'misi-pjax', 'timeout' => 5000]); ?>    <?= GridView::widget([
        'id' => 'Misi-Grid',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,
        'panel'=>['type'=>'primary', 'heading'=>$this->title],   
        'toolbar' => [
            [
                'content' => $this->render('_search', ['model' => $searchModel]),
            ],
        ],
        //'floatHeader'=>true,
        //'floatHeaderOptions'=>['scrollingTop'=>'50'], 
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {

                    return GridView::ROW_COLLAPSED;
                },
                'width' => '30px',
                'expandOneOnly' => true,
                'expandIcon' => '<span class="glyphicon glyphicon-menu-right"></span>',
                'expandTitle' => 'Tujuan',
                'collapseIcon' => '<span class="glyphicon glyphicon-menu-down"></span>',
                'collapseTitle' => 'Tutup',
                //'allowBatchToggle'=>true,
                'detail'=>function ($model, $key, $index, $column) {
                    $searchModel = new \backend\modules\renstra\models\TaTujuanSKPDSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->where([
                            'ID_Tahun' => $model->ID_Tahun,
                            'Kd_Urusan' => $model->Kd_Urusan,
                            'Kd_Bidang' => $model->Kd_Bidang,
                            'Kd_Unit' => $model->Kd_Unit,
                            'No_Misi' => $model->No_Misi,
                        ]);
                    $dataProvider->pagination->pageParam = 'tuj-page';
                    $dataProvider->sort->sortParam = 'tuj-sort';                      
                    
                    return Yii::$app->controller->renderPartial('_tujuan', [
                        'model'=>$model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        ]);
                },
                'detailOptions'=>[
                    'class'=> 'kv-state-enable',
                ],

            ],
            [
                'attribute' => 'No_Misi',
                'width' => '30px'
            ],
            [
                'attribute' => 'Ur_Misi',
            ],
            [
                'label' => 'Unit',
                'visible' => !Yii::$app->user->identity->tperan->kd_unit,
                'attribute' => 'unit.Nm_Unit'
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete}',//{view}{update}{delete}
                //'controller' => 'indikator',
                'buttons' =>[
                        'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'hapus'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModalubah",
                                 'data-title'=> "Ubah Unit",                                 
                                 // 'data-confirm' => "Yakin menghapus sasaran ini?",
                                 // 'data-method' => 'POST',
                                 // 'data-pjax' => 1
                              ]);
                        },            
                        'delete' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'hapus'),
                                 'data-confirm' => "Yakin menghapus sasaran ini?",
                                 'data-method' => 'POST',
                                 'data-pjax' => 1
                              ]);
                        }                        
                ],                              
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
<?php 
    Modal::begin([
        'id' => 'myModal',
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
?>
<?php 
    Modal::begin([
        'id' => 'myModalTujuan',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalTujuan').on('show.bs.modal', function (event) {
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
<?php 
    Modal::begin([
        'id' => 'myModalSasaran',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalSasaran').on('show.bs.modal', function (event) {
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
<?php 
    Modal::begin([
        'id' => 'myModalubah',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalubah').on('show.bs.modal', function (event) {
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
<?php 
    Modal::begin([
        'id' => 'myModalTujuanubah',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalTujuanubah').on('show.bs.modal', function (event) {
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
<?php 
    Modal::begin([
        'id' => 'myModalSasaranubah',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalSasaranubah').on('show.bs.modal', function (event) {
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
            $(tdDetail).html("<span class=\'fa fa-spinner fa-spin\'></span>"); // loader kaka..
             
            // get content via ajax
            $.get("'.\yii\helpers\Url::to(['sasaran']).'&id="+person_id, function( data ) {
              $(tdDetail).html( data );
            }).fail(function() {
                alert( "Terjadi Kesalahan Coba refresh halaman ini." );
              });
            $(trDetail).append(tdDetail); // add td to tr
            $(tr).after(trDetail);  // add tr to table
        }
     
', \yii\web\View::POS_HEAD) ?>

