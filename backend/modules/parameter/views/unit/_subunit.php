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
        <?= Html::a('Tambah Sub', ['sub/create', 'id' => $model->Kd_Urusan.'.'.$model->Kd_Bidang.'.'.$model->Kd_Unit], [
                                                    'class' => 'btn btn-xs btn-success',
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModalSub",
                                                    'data-title'=>"Tambah Sub Unit",
                                                    ]) ?>
    </p>
<?php Pjax::begin(['id' => 'sub-pjax'.$model->Kd_Urusan.$model->Kd_Bidang.$model->Kd_Unit, 'timeout' => 5000]); ?>    <?= GridView::widget([
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
                'label' => 'Kode Sub',
                'value' => function ($model){
                    return $model->Kd_Urusan.'.'.$model->Kd_Bidang.'.'.$model->Kd_Unit.'.'.$model->Kd_Sub;
                }
            ],        
            'Nm_Sub_Unit',

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete}',//{view}{update}{delete}
                'controller' => 'sub',
                'buttons' =>[
                        'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'hapus'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModalSububah",
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