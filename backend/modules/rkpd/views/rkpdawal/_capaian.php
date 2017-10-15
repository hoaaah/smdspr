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
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ], 
        'pjax'=>true,
        'pjaxSettings'=>[
            'options' => ['id' => 'capaian-pjax'.$model->id, 'timeout' => 5000],
        ],
        'columns' => [
            [
                'label' => 'No Indikator',
                'value' => function ($model){
                    return $model->no_misi.'.'.$model->no_tujuan.'.'.$model->no_sasaran.'.'.$model->kd_progrkpd.'.'.$model->no_indikator;
                }
            ],
            'tolok_ukur',
            [
            	'label' => 'Jenis Indikator',
            	'value' => function($model){
            		return $model->kdIndikator2->jn_indikator.' - '.$model->kdIndikator3->jn_indikator;
            	}
            ],
            'target_uraian',
            'target_angka:decimal',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete}',//{view}{update}{delete}
                'controller' => 'rkpdcapaian',
                'buttons' =>[
                        'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'ubah'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModalIndubah",
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
</div>