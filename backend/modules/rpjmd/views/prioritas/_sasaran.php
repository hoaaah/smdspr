<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
?>
<?php Pjax::begin(['id' => 'sasaran-pjax'.$model->id, 'timeout' => 1000]); ?>    
    <?= GridView::widget([
        'id' => 'Sasaran-Grid',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,     
        //'panel'=>['type'=>'primary', 'heading'=>'Sasaran'],   
        //'floatHeader'=>true,
        //'floatHeaderOptions'=>['scrollingTop'=>'50'],           
        'columns' => [      
            //['class' => 'kartik\grid\SerialColumn'],
            'No_Misi',
            'No_Tujuan',
            'No_Sasaran',
            'Ur_Sasaran',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{delete}',//{update}{delete}
                'controller' => 'sasaran',
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
<?php Pjax::end(); ?>
<?= Html::a('Tambah Sasaran', ['tambahsasaran', 'id' => $model->id], [
                                                    'class' => 'btn btn-xs btn-success',
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModal",
                                                    'data-title'=>"Tambah Sasaran",
                                                    ]) ?>