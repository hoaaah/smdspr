<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\renja\models\RenjaKegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aktivitas Musrenbang';
$this->params['breadcrumbs'][] = 'Renja';
$this->params['breadcrumbs'][] = 'Renja Awal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="renja-kegiatan-index">

<?php Pjax::begin(); ?>    <?= GridView::widget([
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
            'options' => ['id' => 'kegiatan-pjax', 'timeout' => 5000],
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
                    // $searchModel = new \backend\modules\parameter\models\DesaSearch();
                    // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    // $dataProvider->query->where([
                    //         'kecamatan_id' => $model->id,
                    //     ]);
                    // $dataProvider->pagination->pageParam = 'des-page';
                    // $dataProvider->sort->sortParam = 'des-sort';                
                    
                    return Yii::$app->controller->renderPartial('_aktivitas', [
                        'model'=>$model,
                        // 'searchModel' => $searchModel,
                        // 'dataProvider' => $dataProvider,
                        ]);
                },
                'detailRowCssClass' => GridView::TYPE_SUCCESS,
                'detailOptions'=>[
                    'id' => 'indikator-row',
                    'class'=> 'kv-state-enable',
                ],

            ],         
            [
                'label'=> 'SKPD',
                'attribute' => 'sub.Nm_Sub_Unit',
            ],
            [
                'label' => 'Kode Kegiatan',
                'value' => function ($model){
                    return $model->no_skpdMisi.'.'.$model->no_skpdTujuan.'.'.$model->no_skpdSasaran.'.'.$model->no_renjaProg.'.'.$model->id_renkeg;
                }
            ],            
            'uraian',
            'lokasi',
            'pagu_kegiatan:decimal',
            'pagu_musrenbang:decimal', 
            'info_asb',
            [
                'attribute' => 'kd_bahas',
                'format' => 'raw',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'value' => function($model){
                    IF($model->kd_bahas == 1){
                        return '<span class="glyphicon glyphicon-ok text-success"></span>';
                    }ELSE{
                        return '<span class="glyphicon glyphicon-remove text-danger"></span>';
                    }
                }
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update}',//{view}{update}{delete}
                //'controller' => 'renjakegiatan',
                'buttons' =>[
                        'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'hapus'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModalkegiatanubah",
                                 'data-title'=> "Aktivitas dan Musrenbang",                                 
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