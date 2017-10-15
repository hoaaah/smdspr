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
$this->title = 'Renja Awal - Program';
$this->params['breadcrumbs'][] = 'Renja';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="renja-program-index">

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
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {

                    return GridView::ROW_COLLAPSED;
                },
                'width' => '30px',
                'expandOneOnly' => true,
                'expandIcon' => '<span class="glyphicon glyphicon-menu-right"></span>',
                'expandTitle' => 'Kegiatan',
                'collapseIcon' => '<span class="glyphicon glyphicon-menu-down"></span>',
                'collapseTitle' => 'Tutup',
                'detail'=>function ($model, $key, $index, $column) {
                    $searchModel = new \backend\modules\renja\models\RenjaKegiatanSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->where([
                            'tahun' => $model->tahun,
                            'kd_urusan' => $model->kd_urusan,
                            'kd_bidang' => $model->kd_bidang,
                            'kd_unit' => $model->kd_unit,
                            'kd_sub' => $model->kd_sub,
                            'no_skpdMisi' => $model->no_skpdMisi,
                            'no_skpdTujuan' => $model->no_skpdTujuan,
                            'no_skpdSasaran' => $model->no_skpdSasaran,
                            'no_renjaSas' => $model->no_renjaSas,
                            'no_renjaProg' => $model->no_renjaProg,
                            'id_renprog' => $model->id_renprog,
                        ]);
                    
                    return Yii::$app->controller->renderPartial('_kegiatan', [
                        'model'=>$model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        ]);
                },
                'detailOptions'=>[
                    'class'=> 'kv-state-enable',
                ],

            ],
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
                    $searchModel = new \backend\modules\renja\models\RenjaProgramCapaianSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->where([
                            'tahun' => $model->tahun,
                            'kd_urusan' => $model->kd_urusan,
                            'kd_bidang' => $model->kd_bidang,
                            'kd_unit' => $model->kd_unit,
                            'kd_sub' => $model->kd_sub,
                            'no_skpdMisi' => $model->no_skpdMisi,
                            'no_skpdTujuan' => $model->no_skpdTujuan,
                            'no_skpdSasaran' => $model->no_skpdSasaran,
                            'no_renjaSas' => $model->no_renjaSas,
                            'no_renjaProg' => $model->no_renjaProg,
                            'id_renprog' => $model->id_renprog,
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
                    return $model->no_skpdMisi.'.'.$model->no_skpdTujuan.'.'.$model->no_skpdSasaran.'.'.$model->no_renjaProg;
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
        'id' => 'myModalkegiatanubah',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalkegiatanubah').on('show.bs.modal', function (event) {
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
        'id' => 'myModalCapaianubah',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalCapaianubah').on('show.bs.modal', function (event) {
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