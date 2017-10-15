<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\musrenbang\models\TRkpdProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rencana Kerja Pemerintah Daerah '.$tahun;
$this->params['breadcrumbs'][] = 'Rencana Kerja';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <?php $rkpdProgram =  GridView::widget([
            'id' => 'trkpd-program',    
            'dataProvider' => $dataProvider,
            'export' => false, 
            'responsive'=>true,
            'hover'=>true,     
            'resizableColumns'=>true,
            'panel'=>['type'=>'primary', 'heading'=>$this->title],
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
                'options' => ['id' => 'trkpd-program-pjax', 'timeout' => 5000],
            ],        
            // 'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'label' => 'Kode',
                    'hAlign' => 'left',
                    'value' => function($model){
                        return $model->urusan_id.'.'.
                        substr('0'.$model->bidang_id, -2).'.'.
                        $model->no_misi.'.'.
                        $model->no_tujuan.'.'.
                        $model->no_sasaran.'.'.
                        substr('0'.$model->kd_progrkpd, -2);
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
                // 'id_progrkpd',
                // 'created_at',
                // 'updated_at',
                // 'user_id',
                // 'input_phased',
                // 'status',
                // 'status_phased',
                // 'id_tahun',
                // 'Kd_Perubahan_Rpjmd',
                // 'Kd_Dokumen_Rpjmd',
                // 'Kd_Usulan_Rpjmd',
                // 'No_Misi_Rpjmd',
                // 'No_Tujuan_Rpjmd',
                // 'No_Sasaran_Rpjmd',
                // 'Kd_Prog_Rpjmd',
                // 'ID_Prog_Rpjmd',
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{renjaprogram} {view}',
                    'noWrap' => true,
                    'vAlign'=>'top',
                    'buttons' => [
                            'renjaprogram' => function ($url, $model) {
                              return Html::a('<span class="glyphicon glyphicon-forward"></span>', $url,
                                    [
                                        'id' => 'renja-program-button-'.$model->id,                                        
                                        'title' => Yii::t('yii', 'Program Renja'),
                                        //  'data-toggle'=>"modal",
                                        //  'data-target'=>"#myModal",
                                        //  'data-title'=> "Ubah",                                 
                                        // 'data-confirm' => "Yakin menghapus sasaran ini?",
                                        // 'data-method' => 'POST',
                                        // 'data-pjax' => 1
                                    ]);
                            },
                            'view' => function ($url, $model) {
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
            echo TabsX::widget([
                'items'=>[
                    [
                        'label'=>'Program Pemda',
                        'content'=> $rkpdProgram,
                        'active'=>true,
                        'linkOptions'=>['id'=>'linkRkpdProgram'],
                        'headerOptions' => ['id' => 'tabRkpdProgram'],
                        'containerOptions' => ['id' => 'rkpdProgram']
                    ],
                    [
                        'label'=>'Program OPD',
                        'content'=> '....',
                        'linkOptions'=>['id'=>'linkRenjaProgram'],
                        // 'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/tabs-data'])]
                        'headerOptions' => ['id' => 'tabRenjaProgram'],
                        'containerOptions' => ['id' => 'renjaProgram']
                    ], 
                    [
                        'label'=>'Kegiatan OPD',
                        'content'=> '....',
                        'linkOptions'=>['id'=>'linkRenjaKegiatan'],
                        // 'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/site/tabs-data'])]
                        'headerOptions' => ['id' => 'tabRenjaKegiatan'],
                        'containerOptions' => ['id' => 'renjaKegiatan']
                    ],                                
                ],
                'position'=>TabsX::POS_ABOVE,
                'bordered'=>true,
                'sideways'=>true,
                'encodeLabels'=>false
            ]);
        ?>
    </div>
</div><!--row-->

<?php Modal::begin([
    'id' => 'myModal',
    'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
        'options' => [
            'tabindex' => false // important for Select2 to work properly
        ], 
]);
 
echo '...';
 
Modal::end();

$this->registerJs(<<<JS
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class="fa fa-spinner fa-spin"></i>')
        $.post(href)
        .done(function( data ) {
            modal.find('.modal-body').html(data)
        });
    })

    // $('td').dblclick(function (e) {
    //     var id = $(this).closest('tr').data('id');
    //     if(e.target == this){
    //         var href = '" . \Yii\helpers\Url::to(['renjaProgram']) . "?Kd_rkpdProgram=' + id;
    //         $('#rkpdProgram').removeClass('active');
    //         $('#rkpdProgram').html('<a href="#w2-tab0"  data-toggle="tab" role="tab" title="rkpdProgram"><i class="glyphicon glyphicon-home"></i> rkpdProgram</a>');
    //         $('#renjaProgram').attr('class', 'active');

    //         $('#linkRkpdProgram').click();
            
    //         $('#w2-tab0').removeClass('active in');
    //         $('#w2-tab1').addClass('active in');
    //         $('#w2-tab1').html('<i class="fa fa-spinner fa-spin"></i>');
    //         $.get(href).done(function(data){
    //             $('#w2-tab1').html(data);
    //             console.log('voila renjaProgram');
    //         });
    //     }
    // });

    $("a[id^='renja-program-button-']").on('click', function(event){
        event.preventDefault();
        var href = $(this).attr('href');
        console.log(href);

        var target = event.target;
        $('#tabRkpdProgram').removeClass('active');
        $('#tabRkpdProgram').html('<a href="#w1-tab0"  data-toggle="tab" role="tab" title="rkpdProgram">Program Pemda</a>');
        $('#tabRenjaProgram').attr('class', 'active');

        $('#linkRenjaProgram').click();
        
        $('#w1-tab0').removeClass('active in');
        $('#w1-tab1').addClass('active in');
        $('#w1-tab1').html('<i class="fa fa-spinner fa-spin"></i>');
        $.get(href).done(function(data){
            $('#w1-tab1').html(data);
            console.log('voila renjaProgram');
        });
    })
JS
);
?>