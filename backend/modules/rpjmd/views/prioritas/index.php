<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rpjmd\models\TRpjmdPrioritasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prioritas Daerah';
$this->params['breadcrumbs'][] = 'RPJMD';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trpjmd-prioritas-index">

    <p>
        <?= Html::a('Tambah Prioritas', ['create'], [
            'class' => 'btn btn-xs btn-success',
            'data-toggle'=>"modal",
            'data-target'=>"#myModal",
            'data-title'=>"Tambah Prioritas Daerah",
        ]) ?>
    </p>
<?php Pjax::begin(['id' => 'prioritas-pjax', 'timeout' => 5000]); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,     
        'panel'=>['type'=>'info', 'heading'=>$this->title],
        'toolbar' => [
            [
                'content' => $this->render('_search', ['model' => $searchModel]),
            ],
        ],
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],         
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {

                    return GridView::ROW_COLLAPSED;
                },
                'width' => '30px',
                'expandOneOnly' => true,
                'expandIcon' => '<span class="glyphicon glyphicon-menu-right"></span>',
                'expandTitle' => 'Sub Unit',
                'collapseIcon' => '<span class="glyphicon glyphicon-menu-down"></span>',
                'collapseTitle' => 'Tutup',
                //'allowBatchToggle'=>true,
                'detail'=>function ($model, $key, $index, $column) {
                    $searchModel = new \backend\modules\rpjmd\models\TaSasaranRPJMDSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->where([
                            'Kd_Prioritas' => $model->id,
                        ]);
                    $dataProvider->pagination->pageParam = 'sas-page';
                    $dataProvider->sort->sortParam = 'sas-sort';                    
                    
                    return Yii::$app->controller->renderPartial('_sasaran', [
                        'model'=>$model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        ]);
                },
                'detailOptions'=>[
                    'class'=> 'kv-state-enable',
                ],

            ], 
            'Kd_Prioritas',
            'Uraian',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'noWrap' => true,
                'vAlign'=>'top',
                'buttons' => [
                        'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'hapus'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModal",
                                 'data-title'=> "Ubah Periode",                                 
                                 // 'data-confirm' => "Yakin menghapus sasaran ini?",
                                 // 'data-method' => 'POST',
                                 // 'data-pjax' => 1
                              ]);
                        },                
                        'view' => function($url, $model){
                            return  Html::a('<i class="fa fa-eye"></i>', $url,
                                [  
                                 'title' => Yii::t('yii', 'hapus'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModal",
                                 'data-title'=> "View ",                                 
                                 // 'data-confirm' => "Yakin menghapus sasaran ini?",
                                 // 'data-method' => 'POST',
                                 // 'data-pjax' => 1
                              ]);
                        }
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
<?php
Modal::begin([
    'id' => 'myModal',
    'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    'options' => [
        'tabindex' => false // important for Select2 to work properly
    ], 
    'size' => 'modal-lg',
]);
 
echo '...'; 
Modal::end();

$this->registerJs(<<<JS
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
JS
);
?>
<?php 
    Modal::begin([
        'id' => 'myModalUbah',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalUbah').on('show.bs.modal', function (event) {
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
        'id' => 'myModalDes',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalPrio').on('show.bs.modal', function (event) {
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
        'id' => 'myModalDesubah',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalPrioubah').on('show.bs.modal', function (event) {
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