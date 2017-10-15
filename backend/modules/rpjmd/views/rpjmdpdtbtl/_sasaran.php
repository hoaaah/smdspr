<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
?>
<?php // Pjax::begin(['id' => 'sasaran-pjax']); ?>    
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

            //['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
<?php // Pjax::end(); ?>