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
        'hover'=>true,   
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,        
        //'panel'=>['type'=>'primary', 'heading'=>'Daftar Deposito'],           
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            //'tahun',
            //'urusan_id',
            //'bidang_id',
            //'no_misi',
            // 'no_tujuan',
            // 'no_sasaran',
            // 'id_sasrkpd',
            //'id_progrkpd',
            /*
            [
                'attribute' => 'id_progrkpd',
                'filter' => false,
                'width' => '30px',
            ],
            */            
            'uraian',
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

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>

<?= Html::a('Tambah Program RKPD', ['create'], ['class' => 'btn btn-xs btn-primary pull-right']) ?>
<?php echo Html::a('Tambah Program', ['tambah', 'id'=>$model->ID_Tahun.'.'.$model->No_Misi.'.'.$model->No_Tujuan.'.'.$model->No_Sasaran],[
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModal",
                                                    'data-title'=>"Detail Program RKPD ",
                                                    ]) ?>
