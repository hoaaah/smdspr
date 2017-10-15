<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rpjmd\models\RpjmdProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="rpjmd-program-index">

    <p>
        <?= Html::a('Tambah Indikator', ['indikator', 'id' => $model->ID_Tahun.'.'.$model->Kd_Prov.'.'.$model->Kd_Kab_Kota.'.'.$model->Kd_Perubahan.'.'.$model->Kd_Dokumen.'.'.$model->Kd_Usulan.'.'.$model->No_Misi.'.'.$model->No_Tujuan.'.'.$model->No_Sasaran.'.'.$model->Kd_Prog.'.'.$model->Id_Prog], [
                                                    'class' => 'btn btn-xs btn-success',
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModalIndikator",
                                                    'data-title'=>"Tambah Indikator ".$model->Ket_Program,
                                                    ]) ?>
    </p>    
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
        'pjax'=>true,
        'pjaxSettings'=>[
            'options' => ['id' => 'indikator-pjax'.$model->ID_Tahun.$model->Kd_Prov.$model->Kd_Kab_Kota.$model->Kd_Perubahan.$model->Kd_Dokumen.$model->Kd_Usulan.$model->No_Misi.$model->No_Tujuan.$model->No_Sasaran.$model->Kd_Prog.$model->Id_Prog, 'timeout' => 5000],
        ],
        'columns' => [
        	[
        		'label' => 'Kd',
        		'attribute' => 'No_ind_Prog'
        	],
            'Tolak_Ukur',
            'Kondisi_Kinerja_Awal',
            [
                'label' => 'Jenis Indikator',
                'value' => function($model){
                    return $model->indikator1->jn_indikator.' '.$model->indikator2->jn_indikator;
                }
            ],
            'Satuan',
            'NilaiTahun1:decimal',
            'NilaiTahun2:decimal',
            'NilaiTahun3:decimal',
            'NilaiTahun4:decimal',
            'NilaiTahun5:decimal',
            'Kondisi_Kinerja_akhir',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete}',//{update}{delete}
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
</div>