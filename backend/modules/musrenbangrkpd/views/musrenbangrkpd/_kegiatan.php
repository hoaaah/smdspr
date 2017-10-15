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
            //['class' => 'kartik\grid\SerialColumn'],
            [
                'label' => '+++',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'subkegiatan(this,"'.$model['id_renja_kegiatan'].'");return false;']);
                }
            ],
            [
                'label' => 'Kegiatan Renja',
                'format' => 'raw',
                'attribute' => 'kegiatan_renja',
                'value' => function($model){
                    return Html::a($model['kegiatan_renja'], ['renjakegiatanview', 'id' => $model['id_renja_kegiatan']],['data-pjax'=>"0"]/*, ['target'=>'_blank', 'data-pjax'=>"0"]*/);
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
                'label' => 'Kegiatan Renja',
                'format' => 'raw',
                'value'=> function($model){
                    return number_format($model['pagu_kegiatan_awal'], 0, ',' ,'.').'<br /><hr />'.number_format($model['pagu_kegiatan'], 0, ',' ,'.');
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