<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

?>

<?php Pjax::begin(); ?>    
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,   
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,          
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {

                    return GridView::ROW_COLLAPSED;
                },

                'allowBatchToggle'=>true,
               'detail'=>function ($model, $key, $index, $column) {
                $searchModel = new \backend\modules\rkpdrenja\models\TaTujuanRPJMDSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                //'ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Perubahan' => 'Kd_Perubahan', 'Kd_Dokumen' => 'Kd_Dokumen', 'Kd_Usulan' => 'Kd_Usulan', 'No_Misi' => 'No_Misi'
                //$dataProvider->query->where('ID_Tahun = '.$model->ID_Tahun.' AND Kd_Prov = '.$model->Kd_Prov.' AND Kd_Kab_Kota = '.$model->Kd_Kab_Kota.' AND Kd_Perubahan = '.$model->Kd_Perubahan.' AND Kd_Dokumen = '.$model->Kd_Dokumen.' AND Kd_Usulan = '.$model->Kd_Usulan.' AND No_Misi = '.$model->No_Misi);

                    return Yii::$app->controller->renderPartial('_sasaran', [
                        'model'=>$model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        ]);
                },
                'detailOptions'=>[
                    'class'=> 'kv-state-enable',
                ],

            ],
            //['class' => 'kartik\grid\SerialColumn'],

            //'No_Tujuan',
            //'Ur_Tujuan',

            //['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
