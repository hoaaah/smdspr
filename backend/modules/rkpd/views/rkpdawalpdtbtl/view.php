<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RkpdProgram */

$this->title = 'Ubah: '.$model->uraian;
$this->params['breadcrumbs'][] = 'RKPD';
$this->params['breadcrumbs'][] = ['label' => 'RKPD Awal - Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rkpd-program-view">
    <?php
    echo DetailView::widget([
        'id' => 'program',
        'model'=>$model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'enableEditMode' => true,
        'hideIfEmpty' => false, //sembunyikan row ketika kosong
        'panel'=>[
            'heading'=>'<i class="fa fa-tag"></i> Rincian Program</h3>',
            'type'=>'success',
            'headingOptions' => [
                'tag' => 'h3', //tag untuk heading
            ],
        ],
        'buttons1' => $jadwal == true ? '{update}' : '', // tombol mode default, default '{update} {delete}'
        'buttons2' => '{save} {view}', // tombol mode kedua, default '{view} {reset} {save}'
        'viewOptions' => [
            'label' => '<span class="glyphicon glyphicon-remove-circle"></span>',
        ],
        'attributes'=>[
            [
                'label' =>'Urusan-Bidang',
                'attribute' => 'bidang_id',
                'value' => $model->urusan->Nm_Urusan.' - '.$model->bidang->Nm_Bidang,
            ],
            [                      
                'label' => 'Program',
                'format' => 'ntext',
                'attribute' => 'uraian',
                'value' => $model->no_misi.'.'.$model->no_tujuan.'.'.$model->no_sasaran.' '.$model->uraian,
            ],
            [                      
                'label' => 'Pagu Program RKPD',
                'format' => 'decimal',
                'attribute' => 'pagu_program',
                //'type'=>DetailView::INPUT_MONEY
            ],
        ]
    ]); 
    ?>

    <div class="box box-success color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i> Indikator/Capaian Program</h3>
        </div>
        <div class="box-body">
            <div class = "row">
            <?php $i=1; foreach($capaian as $capaian): ?>
                <div class = "col-sm-6">
                    <?php
                        echo DetailView::widget([
                            'id' => 'capaian'.$i,
                            'model'=>$capaian,
                            'condensed'=>true,
                            'hover'=>true,
                            'mode'=>DetailView::MODE_VIEW,
                            'enableEditMode' => true,
                            'hideIfEmpty' => true, //sembunyikan row ketika kosong
                            'panel'=>[
                                'heading'=>'<i class="fa fa-line-chart"></i> Indikator/Capaian '.$capaian->no_indikator.'</h3>',
                                'type'=>'default',
                                'headingOptions' => [
                                    'tag' => 'h3', //tag untuk heading
                                ],
                            ],
                            'buttons1' => $jadwal == true ? '{update}' : '', // tombol mode default, default '{update} {delete}'
                            'buttons2' => '{save} {view}', // tombol mode kedua, default '{view} {reset} {save}'
                            'viewOptions' => [
                                'label' => '<span class="glyphicon glyphicon-remove-circle"></span>',
                            ],
                            'attributes'=>[
                                [                      
                                    'label' => 'No Indikator',
                                    //'displayOnly' => true,
                                    'attribute' => 'no_indikator'
                                ],
                                [                      
                                    'label' => 'Capaian',
                                    'format' => 'ntext',
                                    'attribute' => 'uraian'
                                ],
                                [                      
                                    'label' => 'Target Angka',
                                    //'format' => 'decimal',
                                    'attribute' => 'target_angka',
                                    'value' => $capaian->target_angka.' '.$capaian->target_uraian,
                                    //'type'=>DetailView::INPUT_MONEY
                                ],
                                [                      
                                    'label' => 'Tolok Ukur - Indikator',
                                    'format' => 'ntext',
                                    'displayOnly' => true,
                                    //'attribute' => 'target_angka',
                                    //'type'=>DetailView::INPUT_MONEY
                                    'value' => $capaian->tolok_ukur.' - '.$capaian->kdIndikator2->jn_indikator.' '.$capaian->kdIndikator3->jn_indikator
                                ],
                            ]
                        ]);     
                    ?>
                </div> <!--col6-->
            <?php $i++; endforeach;?>
            </div><!--row-->                
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->    

</div>
