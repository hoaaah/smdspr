<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rpjmd\models\TaMisiRPJMDSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Misi-Tujuan-Sasaran';
$this->params['breadcrumbs'][] = 'RPJMD';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-misi-rpjmd-index">
    <p>
        <?= Html::a('Tambah Misi', ['create'], [
                                                    'class' => 'btn btn-xs btn-success',
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModal",
                                                    'data-title'=>"Tambah Misi",
                                                    ]) ?>
    </p>  
    <?= GridView::widget([
        'id' => 'Misi-Grid',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,     
        'panel'=>['type'=>'primary', 'heading'=>$this->title],
        'toolbar' => [
            [
                //'content' => $this->render('_search', ['model' => $searchModel]),
            ],
        ],
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],         
        'pjax'=>true,
        'pjaxSettings'=>[
            'options' => ['id' => 'misi-pjax', 'timeout' => 5000],
        ],          
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {

                    return GridView::ROW_COLLAPSED;
                },
                'width' => '30px',
                'expandOneOnly' => true,
                //'allowBatchToggle'=>true,
                'detail'=>function ($model, $key, $index, $column) {
                    $searchModel = new \backend\modules\rpjmd\models\TaTujuanRPJMDSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->where([
                            'ID_Tahun' => $model->ID_Tahun,
                            'No_Misi' => $model->No_Misi,
                        ]);
                    $dataProvider->pagination->pageParam = 'tujuan-page';
                    $dataProvider->sort->sortParam = 'tujuan-sort';                     
                    
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
            //['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'No_Misi',
                'width' => '30px'
            ],
            [
                'attribute' => 'Ur_Misi',
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
                                 'data-title'=> "Ubah Misi",                                 
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
$this->registerJs(<<<JS
    $("a[id^='detail-']").on("click", function(event){
        event.preventDefault();
        var objectButton = $(this);
        var href = $(this).attr("href")
        var td = objectButton.parent();
        var tr = td.parent();
        var tdCount = tr.children().length;
        var table = tr.parent();
        table.children(".trDetail").remove(); // drop all child of trdetail
        var trDetail = document.createElement("tr");
        $(trDetail).attr("class", "trDetail");
        var tdDetail = document.createElement("td");
        $(tdDetail).attr("colspan", tdCount);
        $(tdDetail).html("<span class='fa fa-spinner fa-spin'></span>")
        
        // get content
        $.get(href, function(data){
            $(tdDetail).html(data);
        }).fail(function(){
            alert("Something was wrong.")
        });
        $(trDetail).append(tdDetail);
        $(tr).after(trDetail);
    })
JS
);
?>