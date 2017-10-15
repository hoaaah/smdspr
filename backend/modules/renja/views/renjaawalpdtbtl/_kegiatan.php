<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
?>
<?php Pjax::begin(['id' => 'rkpd_kegiatan']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,     
        //'panel'=>['type'=>'primary', 'heading'=>'Daftar Kegiatan pada: '.$model->uraian],   
        //'floatHeader'=>true,
        //'floatHeaderOptions'=>['scrollingTop'=>'50'],        
        'columns' => [
            [
                'label' => 'Kode Kegiatan',
                'value' => function ($model){
                    return $model->no_skpdMisi.'.'.$model->no_skpdTujuan.'.'.$model->no_skpdSasaran.'.'.$model->no_renjaProg.'.'.$model->id_renkeg;
                }
            ],
            'uraian',
            'pagu_kegiatan:decimal',
        ],
    ]); ?>
<?php Pjax::end(); ?>