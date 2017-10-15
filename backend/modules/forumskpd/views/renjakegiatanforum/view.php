<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\RenjaKegiatan */

$this->title = 'Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Rencana Kerja', 'url' => ['renjaprogram/index']];
$this->params['breadcrumbs'][] = 'Kegiatan '.substr($model->uraian,0,50);
$this->title = 'Rencana Kerja <small>Kegiatan '.substr($model->uraian,0,50).'</small>'
?>
<div class="renja-kegiatan-view">
<div class="body-content">
    <div id="page-wrapper">
        <div class="row">                 
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Info Kegiatan
                    </div>
                    <div class="panel-body">            
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'tahun',
                                'sub.Nm_Sub_Unit',
                                'program.uraian',
                                'uraian',
                                //'lokasi',
                                'kelompok_sasaran',
                                [
                                    'attribute' => 'pagu_kegiatan',
                                    'value' => "Rp ".number_format($model->pagu_kegiatan,0,",",".")
                                ],
                                [
                                    'attribute' => 'pagu_musrenbang',
                                    'value' => "Rp ".number_format($model->pagu_musrenbang,0,",",".")
                                ],
                                'info_asb:ntext'
                            ],
                        ]) ?>
                    </div>
                </div><!--panel -->
            </div><!-- col-12 -->
        </div><!--row-->
        <div class="row"> 
            <div class="col-lg-12">
                <?php  Pjax::begin();?>    
                <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['class' => 'item'],
                        'emptyText' => '<small><i>Anda belum memberikan usulan pada kegiatan ini, silahkan tambahkan usulan.</i></small>',
                        'itemView' => function ($model, $key, $index, $widget) {
                            //return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
                            $itemContent = $this->render('_usulan',['model' => $model]);
                            return $itemContent;
                        },
                        'layout' => '{items}{pager}',
                    ]); ?>
                <?php  Pjax::end(); ?>
            </div>
        </div>    
    </div>
</div>
</div>
