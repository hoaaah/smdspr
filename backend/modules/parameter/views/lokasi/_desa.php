<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\renstra\models\TaKegiatanSkpdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="unit-index">
    <p>
        <?= Html::a('Tambah Desa', ['desa/create', 'id' => $model->id], [
                                                    'class' => 'btn btn-xs btn-success',
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModalDes",
                                                    'data-title'=>"Tambah Desa",
                                                    ]) ?>
    </p>
<?php Pjax::begin(['id' => 'desa-pjax'.$model->id, 'timeout' => 5000]); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ], 
        //'showPageSummary'=>true,
        'columns' => [
            [
                'label' => 'Kd',
                'width' => '30px;',                
                'value' => function ($model){
                    return $model->kecamatan->pemda_id.'.'.$model->kecamatan_id.'.'.$model->id;
                }
            ],        
            'desa',

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete}',//{view}{update}{delete}
                'controller' => 'desa',
                'buttons' =>[
                        'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'ubah'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModalDesubah",
                                 'data-title'=> "Ubah Desa",                                 
                                 // 'data-confirm' => "Yakin menghapus sasaran ini?",
                                 // 'data-method' => 'POST',
                                 // 'data-pjax' => 1
                              ]);
                        },            
                        'delete' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'hapus'),
                                 'data-confirm' => "Yakin menghapus Desa ini?",
                                 'data-method' => 'POST',
                                 'data-pjax' => 1
                              ]);
                        }                        
                ],                              
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>