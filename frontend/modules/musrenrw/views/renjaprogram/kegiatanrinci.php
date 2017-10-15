<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\RenjaKegiatan */

?>
<div class="renja-kegiatan-view">
<div class="body-content">
    <div id="page-wrapper">                 

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tahun',
            'sub.Nm_Sub_Unit',
            'program.uraian',
            'uraian',
            [
               'attribute' => 'pagu_kegiatan',
               'label' => 'Pagu Kegiatan',
               'value' => 'Rp '.number_format($model->pagu_kegiatan,0,",",".")
            ],            
            [
               'attribute' => 'pagu_musrenbang',
               'label' => 'Pagu Musrenbang',
               'value' => 'Rp '.number_format($model->pagu_musrenbang,0,",",".")
            ], 
            'info_asb:ntext',
        ],
    ]) ?>
        <div class="row">  
            <?php  Pjax::begin();?>    
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'uraian',
                    'desa.desa',
                    'rw',
                    //'pagu_kegiatan:currency:Pagu Kegiatan',
                    [
                        //'label' => 'PAGU',
                        'attribute' => 'biaya',
                        //'contentOptions' => ['style' => ['max-width' => '100px;', 'height' => '100px']], ['class' => 'text-wrap'] 
                        'value'=> function($model){
                            return "Rp ".number_format($model->biaya,0,",",".");
                        }
                        
                    ],                 
                    //['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>                
            <?php  Pjax::end(); ?>
        </div>    
    </div>
</div>
</div>
