<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use common\models\RenjaKegiatan;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\RenjaProgram */
?>

<div class="renja-program-view">
<div class="body-content">
    <div id="page-wrapper">                 

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'tahun',
                    [   'attribute'=>'Bidang Program',
                        'value'=> $model->bidang1->Nm_Bidang,
                    ],            
                    [   'attribute'=>'SKPD Pelaksana',
                        'value'=> $model->subunit->Nm_Sub_Unit,
                    ],            
                    //'no_skpdMisi',
                    //'no_skpdTujuan',
                    //'no_skpdSasaran',
                    //'no_renjaSas',
                    //'no_renjaProg',
                    //'id_renprog',
                    'uraian',          
                    [   'attribute'=>'Diinput Tahap',
                        'value'=> $model->phased->keterangan,
                    ],            
                    'status',
                    [   'attribute'=>'Capaian Tahap',
                        'value'=> $model->statusPhased->keterangan,
                    ],           
                    [   'attribute'=>'User',
                        'value'=> $model->user->nama,
                    ],    
                    'created_at:date',
                    'updated_at:date',                       
                ],
            ]) ?>
<?php /*
        <div class="row">  
            <?php  Pjax::begin();?>    
            <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemOptions' => ['class' => 'item'],
                    'itemView' => function ($model, $key, $index, $widget) {
                        //return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
                        $itemContent = $this->render('_kegiatan',['model' => $model]);
                        return $itemContent;
                    },
                    'layout' => '{items}{pager}',
                ]); ?>
            <?php  Pjax::end(); ?>
        </div>
*/ ?>
    </div>
</div>
</div>
