<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
?>
<?php // Pjax::begin(['id' => 'tujuan-pjax']); ?>       
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
                'width' => '10px',
                'value' => function($model){
                    return  Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,"'.$model->ID_Tahun.'.'.$model->No_Misi.'.'.$model->No_Tujuan.'");return false;']);
                }
            ],    
            //['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'No_Misi',
                'width' => '10px'
            ],
            [
                'attribute' => 'No_Tujuan',
                'width' => '10px'
            ],
            [
                'attribute' => 'Ur_Tujuan',
                'class' => 'kartik\grid\DataColumn',
                'width' => '50px',
            ],

            //['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
<?php // Pjax::end(); ?>