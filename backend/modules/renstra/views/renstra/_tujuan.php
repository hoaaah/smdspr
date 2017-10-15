<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
?>
<?= Html::a('Tambah Tujuan', ['tambah', 'id' => $model->ID_Tahun.'.'.$model->Kd_Urusan.'.'.$model->Kd_Bidang.'.'.$model->Kd_Unit.'.'.$model->No_Misi], [
                                                    'class' => 'btn btn-xs btn-success',
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModalTujuan",
                                                    'data-title'=>"Tambah Tujuan",
                                                    ]) ?>
<?php Pjax::begin(['id' => 'tujuan-pjax'.$model->ID_Tahun.$model->Kd_Urusan.$model->Kd_Bidang.$model->Kd_Unit.$model->No_Misi, 'timeout' => 5000]); ?>       
    <?= GridView::widget([
    	'id' => 'Tujuan-Grid',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,     
        //'panel'=>['type'=>'primary', 'heading'=>'Tujuan'],   
        //'floatHeader'=>true,
        //'floatHeaderOptions'=>['scrollingTop'=>'50'],           
        'columns' => [
            /*[
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {

                    return GridView::ROW_COLLAPSED;
                },
                'width' => '30px',
                //'allowBatchToggle'=>true,
                'detail'=>function ($model, $key, $index, $column) {
                    $searchModel = new \backend\modules\rpjmd\models\TaSasaranRPJMDSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->where([
                            'ID_Tahun' => $model->ID_Tahun,
                            'No_Misi' => $model->No_Misi,
                            'No_Tujuan' => $model->No_Tujuan,
                        ]);
                    
                    return Yii::$app->controller->renderPartial('_sasaran', [
                        'model'=>$model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        ]);
                },
                'detailOptions'=>[
                    'class'=> 'kv-state-enable',
                ],

            ],*/
            [
                'label' => '+++',
                'format' => 'raw',
                'width' => '30px',
                'value' => function($model){
                    return  Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,"'.$model->ID_Tahun.'.'.$model->Kd_Urusan.'.'.$model->Kd_Bidang.'.'.$model->Kd_Unit.'.'.$model->No_Misi.'.'.$model->No_Tujuan.'");return false;']);
                }
            ],    
            //['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'No_Misi',
                'width' => '30px'
            ],
            [
                'attribute' => 'No_Tujuan',
                'width' => '30px'
            ],
            [
                'attribute' => 'Ur_Tujuan',
                'class' => 'kartik\grid\DataColumn',
                'width' => '50px',
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete}',//{update}{delete}
                'controller' => 'tujuan',
                'buttons' =>[
                        'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'ubah'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModalTujuanubah",
                                 'data-title'=> "Ubah Tujuan",                                 
                                 // 'data-confirm' => "Yakin menghapus sasaran ini?",
                                 // 'data-method' => 'POST',
                                 // 'data-pjax' => 1
                              ]);
                        },                 
                        'delete' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'hapus'),
                                 'data-confirm' => "Yakin menghapus tujuan ini?",
                                 'data-method' => 'POST',
                                 'data-pjax' => 1
                              ]);
                        }                        
                ],                               
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>