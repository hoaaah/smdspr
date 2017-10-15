<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
            'options' => ['id' => 'kegiatan-pjax'.$model->id, 'timeout' => 5000],
        ],         
        'columns' => [
            [
                'label' => 'Kode Kegiatan',
                'value' => function ($model){
                    return $model->no_skpdMisi.'.'.$model->no_skpdTujuan.'.'.$model->no_skpdSasaran.'.'.$model->no_renjaProg.'.'.$model->id_renkeg;
                }
            ],
            'uraian',
            'lokasi',
            'pagu_kegiatan:decimal',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete}',//{view}{update}{delete}
                'controller' => 'renjakegiatan',
                'buttons' =>[
                        'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'hapus'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModalkegiatanubah",
                                 'data-title'=> "Ubah Kegiatan",                                 
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
<!--     <?= Html::a('Tambah Kegiatan Renja', ['tambah', 'id' => $model->tahun.'.'.$model->kd_urusan.'.'.$model->kd_bidang.'.'.$model->kd_unit.'.'.$model->kd_sub.'.'.$model->no_skpdMisi.'.'.$model->no_skpdTujuan.'.'.$model->no_skpdSasaran.'.'.$model->no_renjaSas.'.'.$model->no_renjaProg.'.'.$model->id_renprog], [
                                                'class' => 'btn btn-xs btn-success pull-right',
                                                'data-toggle'=>"modal",
                                                'data-target'=>"#myModalkegiatan",
                                                'data-title'=>"Tambah Kegiatan Renja Pada ".$model->uraian,
                                                ]) ?> -->