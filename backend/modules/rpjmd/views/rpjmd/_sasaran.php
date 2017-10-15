<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
?>
<?php list($ID_Tahun, $No_Misi, $No_Tujuan) = explode('.', $id); ?>
<?= Html::a('Tambah Sasaran', ['tambahsasaran', 'id' => $ID_Tahun.'.'.$No_Misi.'.'.$No_Tujuan], [
                                                    'class' => 'btn btn-xs btn-success',
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModalSasaran",
                                                    'data-title'=>"Tambah Sasaran",
                                                    ]) ?>    
    <?= GridView::widget([
        'id' => 'Sasaran-Grid',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,     
        'pjax'=>true,
        'pjaxSettings'=>[
            'options' => ['id' => 'sasaran-pjax'.$ID_Tahun.$No_Misi.$No_Tujuan, 'timeout' => 5000],
        ],          
        'columns' => [      
            //['class' => 'kartik\grid\SerialColumn'],
            'No_Misi',
            'No_Tujuan',
            'No_Sasaran',
            'Ur_Sasaran',
            [
                'label' => 'Prioritas Pemda',
                'attribute' => 'Kd_Prioritas',
                'value' => function($model) {
                    return $model->Kd_Prioritas ? $model->prioritas->Uraian : $model['Kd_Prioritas'];
                }
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update}{delete}',//{update}{delete}
                'controller' => 'sasaran',
                'buttons' =>[
                        'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'hapus'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModalSasaranubah",
                                 'data-title'=> "Ubah Sasaran",                                 
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