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
        <?= Html::a('Tambah Sub Unit', ['pelaksana', 'id' => $model->ID_Tahun.'.'.$model->Kd_Prov.'.'.$model->Kd_Kab_Kota.'.'.$model->Kd_Perubahan.'.'.$model->Kd_Dokumen.'.'.$model->Kd_Usulan.'.'.$model->Kd_Urusan.'.'.$model->Kd_Bidang.'.'.$model->Kd_Unit.'.'.$model->No_Misi.'.'.$model->No_Tujuan.'.'.$model->No_Sasaran.'.'.$model->Kd_Prog.'.'.$model->ID_Prog], [
                                                    'class' => 'btn btn-xs btn-success',
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModalPelaksana",
                                                    'data-title'=>"Tambah Pelaksana",
                                                    ]) ?>
    </p>
<?php Pjax::begin(['id' => 'pelaksana-pjax', 'timeout' => 5000]); ?>    
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
        		'value' => function($model) {
        			return $model->Kd_Urusan.'.'.$model->Kd_Bidang.'.'.$model->Kd_Unit.'.'.$model->Kd_Sub;
        		}
        	],
        	'sub.Nm_Sub_Unit',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{delete}',//{update}{delete}
                'controller' => 'pelaksanaprogram',
                'buttons' =>[
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