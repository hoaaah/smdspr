<?php
use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'Dashboard';
?>
<div class="site-index">
    <div class="body-content">
        <div id="page-wrapper">   
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-4">
                        This is for Logo asdasdasdadasdadadas
                    </div>
                    <div class="col-lg-8">
                        <H1> Perwakilan BPKP Provinsi Sumatera Selatan</H1>
                        <H2> Badan Pengawasan Keuangan dan Pembangunan</H2>
                        <small>Jl. Pramuka no 33 - 091231233123 </small>
                    </div>
                </div>
            </div>
            <!-- /.row -->                      
            <div class="row">
                <?= GridView::widget([
                        'dataProvider' => $dataProvider,                 
                        'summary' => "<small>Menampilkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> Usulan</small>",
                        'emptyText' => '<small><i>Tidak ada Usulan sampai saat ini.</i></small>',                        
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'Nm_Sub_Unit',
                            //['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>            
            </div>
            <!-- /.row -->


    </div>
</div>
