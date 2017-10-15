<?php

use yii\helpers\Html;
use kartik\grid\GridView;
?>
<?= GridView::widget([
    'id' => 'trenja-program',    
    'dataProvider' => $dataProvider,
    'export' => false, 
    'responsive'=>true,
    'hover'=>true,     
    'resizableColumns'=>true,
    'panel'=>['type'=>'primary', 'heading'=>$model->uraian],
    'responsiveWrap' => false,        
    'toolbar' => [
        [
            // 'content' => $this->render('_search', ['model' => $searchModel, 'Tahun' => $Tahun]),
        ],
    ],       
    'pager' => [
        'firstPageLabel' => 'Awal',
        'lastPageLabel'  => 'Akhir'
    ],
    'pjax'=>true,
    'pjaxSettings'=>[
        'options' => ['id' => 'trenja-program-pjax', 'timeout' => 5000],
    ],        
    // 'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'label' => 'Kode',
            'hAlign' => 'left',
            'value' => function($model){
                return $model->kd_urusan.'.'.
                substr('0'.$model->kd_bidang, -2).'.'.
                substr('0'.$model->kd_unit, -2).'.'.
                substr('0'.$model->kd_sub, -2).'.'.
                $model->no_skpdMisi.'.'.
                $model->no_skpdTujuan.'.'.
                $model->no_skpdSasaran.'.'.
                substr('0'.$model->no_renjaProg, -2);
            }
        ],
        [
            'attribute' => 'uraian',
            'noWrap' => false,
        ],
        [
            'attribute' => 'pagu_program',
            'format' => 'decimal',
            'hAlign' => 'right',
        ],
        // 'created_at',
        // 'updated_at',
        // 'user_id',
        // 'input_phased',
        // 'status',
        // 'status_phased',
        // 'rkpd_program_id',
        // 'id_tahun',
        // 'Kd_Perubahan_Renstra',
        // 'Kd_Dokumen_Renstra',
        // 'Kd_Usulan_Renstra',
        // 'Kd_Urusan_Renstra',
        // 'Kd_Bidang_Renstra',
        // 'Kd_Unit_Renstra',
        // 'No_Misi_Renstra',
        // 'No_Tujuan_Renstra',
        // 'No_Sasaran_Renstra',
        // 'Kd_Prog_Renstra',
        // 'ID_Prog_Renstra',

        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{renjakegiatan} {viewrenjaprogram}',
            'noWrap' => true,
            'vAlign'=>'top',
            'buttons' => [
                    'renjakegiatan' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-forward"></span>', $url,
                            [
                                'id' => 'renja-kegiatan-button-'.$model->id,                                        
                                'title' => Yii::t('yii', 'Program Renja'),
                                //  'data-toggle'=>"modal",
                                //  'data-target'=>"#myModal",
                                //  'data-title'=> "Ubah",                                 
                                // 'data-confirm' => "Yakin menghapus sasaran ini?",
                                // 'data-method' => 'POST',
                                // 'data-pjax' => 1
                            ]);
                    },
                    'viewrenjaprogram' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url,
                            [  
                                'title' => Yii::t('yii', 'lihat'),
                                'data-toggle'=>"modal",
                                'data-target'=>"#myModal",
                                'data-title'=> "Lihat",
                            ]);
                    },                        
            ]
        ],
    ],
]); ?>

<?php
$this->registerJs(<<<JS
    $("a[id^='renja-kegiatan-button-']").on('click', function(event){
        event.preventDefault();
        var href = $(this).attr('href');
        console.log(href);

        var target = event.target;
        $('#tabRenjaProgram').removeClass('active');
        $('#tabRenjaProgram').html('<a href="#w1-tab1"  data-toggle="tab" role="tab" title="rkpdProgram">Program OPD</a>');
        $('#tabRenjaProgram').attr('class', 'active');

        $('#linkRenjaKegiatan').click();
        
        $('#w1-tab1').removeClass('active in');
        $('#w1-tab2').addClass('active in');
        $('#w1-tab2').html('<i class="fa fa-spinner fa-spin"></i>');
        $.get(href).done(function(data){
            $('#w1-tab2').html(data);
            console.log('voila renjaProgram');
        });
    })
JS
);
?>