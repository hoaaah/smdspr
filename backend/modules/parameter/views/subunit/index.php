<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\detail\DetailView;
use yii\bootstrap\Modal;

/* (C) Copyright 2017 Heru Arief Wijaya (http://belajararief.com/) untuk Indonesia.*/

$this->title = 'Data Umum OPD';
$this->params['breadcrumbs'][] = 'Parameter';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-sub-unit-index">
    <?php IF(isset($model)){
        echo DetailView::widget([
            'model' => $model,
            'condensed'=>true,
            'hover'=>true,
            'mode'=>DetailView::MODE_VIEW,
            'enableEditMode' => true,
            'hideIfEmpty' => false, //sembunyikan row ketika kosong
            'panel'=>[
                'heading'=>'<i class="fa fa-tag"></i> Data Umum OPD</h3>',
                'type'=>'danger',
                'headingOptions' => [
                    'tag' => 'h3', //tag untuk heading
                ],
            ],
            'buttons1' => '{update}', // tombol mode default, default '{update} {delete}'
            'buttons2' => '{save} {view}', // tombol mode kedua, default '{view} {reset} {save}'
            'viewOptions' => [
                'label' => '<span class="glyphicon glyphicon-remove-circle"></span>',
            ],        
            'attributes' => [
                [
                    'attribute' => 'Kd_Sub',
                    'value' => $model->subUnit->Nm_Sub_Unit,
                    'displayOnly' => true,
                ],
                'Alamat',
                'Nm_Pimpinan',
                'Nip_Pimpinan',
                'Jbt_Pimpinan',
                'Ur_Visi',               
            ],
        ]);
    }else{
        echo Html::a('Tambah Data Umum', ['create-data-umum'], [
            'class' => 'btn btn-xs btn-success',
            'data-confirm' => 'Menambahkan Data OPD?',
            'data-method' => 'POST',
        ]);
    }
    ?>
    <?php /* GridView::widget([
        'id' => 'ta-sub-unit',    
        'dataProvider' => $dataProvider,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,     
        'resizableColumns'=>true,
        'panel'=>['type'=>'primary', 'heading'=>$this->title],
        'responsiveWrap' => false,        
        'toolbar' => [
            [
                '{toggleData}',
                '{export}',
                // 'content' => $this->render('_search', ['model' => $searchModel, 'Tahun' => $Tahun]),
            ],
        ],       
        'pager' => [
            'firstPageLabel' => 'Awal',
            'lastPageLabel'  => 'Akhir'
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
            'options' => ['id' => 'ta-sub-unit-pjax', 'timeout' => 5000],
        ],        
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            // 'Nm_Pimpinan',
            // 'Nip_Pimpinan',
            // 'Jbt_Pimpinan',
            // 'Alamat',
            // 'Ur_Visi',

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'noWrap' => true,
                'vAlign'=>'top',
                'buttons' => [
                        'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'ubah'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModal",
                                 'data-title'=> "Ubah",
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
    ]); */ ?>
</div>
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
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
JS
);
?>