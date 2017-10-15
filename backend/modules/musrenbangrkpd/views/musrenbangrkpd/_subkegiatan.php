<?php
use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\grid\GridView;
use yii\widgets\Pjax;
?>

<?php Pjax::begin(); ?>  
<div class = "col-md-12">
<?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,
        //'panel'=>['type'=>'primary', 'heading'=>'Daftar Kegiatan Rencana Kerja 2017'],                        
        'summary' => "<small>Menampilkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> Usulan</small>",
        'emptyText' => '<small><i>Tidak ada Usulan sampai saat ini.</i></small>',                        
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'label' => 'Aktivitas Usulan',
                'attribute' => 'aktivitas_usulan',
            ],
            [
                'label' => 'Lokasi',
                'value'=> function($model){
                    return $model['kecamatan'].'-'.$model['desa'];
                }
            ],
            [
                'label' => '-',
                'format' => 'raw',
                'value'=> function($model){
                    return 'Awal/Forum SKPD<br /><hr />Current';
                }
                
            ],                           
            [
                'label' => 'Aktivitas Usulan',
                'format' => 'raw',
                'value'=> function($model){
                    return number_format($model['biaya_awal'], 0, ',' ,'.').'<br /><hr />'.number_format($model['biaya'], 0, ',' ,'.');
                }
                
            ],                            
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>         
</div>       
<?php Pjax::end(); ?>