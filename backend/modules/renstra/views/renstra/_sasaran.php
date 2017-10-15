<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
?>
<?php
list($ID_Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan) = explode('.', $id);
?>
<?= Html::a('Tambah Sasaran', ['tambahsasaran', 'id' => $ID_Tahun.'.'.$Kd_Urusan.'.'.$Kd_Bidang.'.'.$Kd_Unit.'.'.$No_Misi.'.'.$No_Tujuan], [
                                                    'class' => 'btn btn-xs btn-success',
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModalSasaran",
                                                    'data-title'=>"Tambah Sasaran",
                                                    ]) ?>
<?php Pjax::begin(['id' => 'sasaran-pjax'.$ID_Tahun.$Kd_Urusan.$Kd_Bidang.$Kd_Unit.$No_Misi.$No_Tujuan, 'timeout' => 5000]); ?>    
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
                'template' => '{update}  {delete}',//{update}{delete}
                'controller' => 'sasaran',
                'buttons' =>[
                        'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'ubah'),
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
<?php Pjax::end(); ?>