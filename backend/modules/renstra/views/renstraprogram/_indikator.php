<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;

?>
<div class="rpjmd-program-index">

    <p>
        <?= Html::a('Tambah Indikator', ['indikator', 'id' => $model->ID_Tahun.'.'.$model->Kd_Prov.'.'.$model->Kd_Kab_Kota.'.'.$model->Kd_Perubahan.'.'.$model->Kd_Dokumen.'.'.$model->Kd_Usulan.'.'.$model->Kd_Urusan.'.'.$model->Kd_Bidang.'.'.$model->Kd_Unit.'.'.$model->No_Misi.'.'.$model->No_Tujuan.'.'.$model->No_Sasaran.'.'.$model->Kd_Prog.'.'.$model->ID_Prog], [
                                                    'class' => 'btn btn-xs btn-success',
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModalIndikator",
                                                    'data-title'=>"Tambah Indikator ".$model->Ket_Program,
                                                    ]) ?>
    </p>
<?php Pjax::begin(['id' => 'indikator-pjax']); ?>    
<?= GridView::widget([
        'id' => 'indikator-Grid',        
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,     
        //'panel'=>['type'=>'primary', 'heading'=>$this->title],
        'toolbar' => [
            [
                //'content' => $this->render('_search', ['model' => $searchModel]),
            ],
        ],
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],         
        //'floatHeader'=>true,
        //'floatHeaderOptions'=>['scrollingTop'=>'50'], 
        'columns' => [
        	[
        		'label' => 'Kd',
        		'attribute' => 'Kd_Prog'
        	],
            'Tolak_Ukur',
            'Satuan',
            'NilaiTahun1:decimal',
            'NilaiTahun2:decimal',
            'NilaiTahun3:decimal',
            'NilaiTahun4:decimal',
            'NilaiTahun5:decimal',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update}{delete}',//{update}{delete}
                'controller' => 'indikator',
                'buttons' =>[
                        'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'hapus'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModalIndikatorubah",
                                 'data-title'=> "Ubah Indikator",                                 
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