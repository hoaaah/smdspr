<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rkpd\models\RkpdProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'RKPD Awal - Program';
$this->params['breadcrumbs'][] = 'RKPD';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rkpd-program-index">

    <?= GridView::widget([
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
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
            'options' => ['id' => 'program-pjax', 'timeout' => 5000],
        ],        
        'columns' => [
            //beri expand_row untuk capaian program
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {

                    return GridView::ROW_COLLAPSED;
                },
                'width' => '30px',
                'expandOneOnly' => true,
                'expandIcon' => '<span class="glyphicon glyphicon-menu-right"></span>',
                'expandTitle' => 'Indikator',
                'collapseIcon' => '<span class="glyphicon glyphicon-menu-down"></span>',
                'collapseTitle' => 'Tutup',
                //'allowBatchToggle'=>true,
                'detail'=>function ($model, $key, $index, $column) {
                    $searchModel = new \backend\modules\rkpd\models\RkpdProgramCapaianSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->where([
                            'tahun' => $model->tahun,
                            'urusan_id' => $model->urusan_id,
                            'bidang_id' => $model->bidang_id,
                            'no_misi' => $model->no_misi,
                            'no_tujuan' => $model->no_tujuan,
                            'no_sasaran' => $model->no_sasaran,
                            'kd_progrkpd' => $model->kd_progrkpd,
                            'id_progrkpd' => $model->id_progrkpd,
                        ]);
                    
                    return Yii::$app->controller->renderPartial('_capaian', [
                        'model'=>$model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        ]);
                },
                'detailRowCssClass' => GridView::TYPE_DANGER,
                'detailOptions'=>[
                    'id' => 'indikator-row',
                    'class'=> 'kv-state-enable',
                ],

            ],
            [
                'label' => 'Kode Program',
                'value' => function ($model){
                    return $model->no_misi.'.'.$model->no_tujuan.'.'.$model->no_sasaran.'.'.$model->kd_progrkpd;
                }
            ],
            'uraian',
            'pagu_program:decimal',
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
                                 'data-title'=> "Ubah Program",                                 
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
</div>
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
        'id' => 'myModalIndubah',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalIndubah').on('show.bs.modal', function (event) {
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