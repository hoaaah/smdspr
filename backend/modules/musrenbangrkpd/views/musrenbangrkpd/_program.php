<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\data\SqlDataProvider;
use yii\widgets\Pjax;
?>

<?php Pjax::begin(); ?>  
<div class = "col-md-12">
<?php echo  GridView::widget([
        'id' => 'kv-grid-program', 
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
            /*
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {

                    return GridView::ROW_COLLAPSED;
                },

                'allowBatchToggle'=>true,
                'detail'=>function ($model, $key, $index, $column) {
                    $totalCount = Yii::$app->db->createCommand('SELECT COUNT(id) FROM t_rkpd_program a WHERE tahun = :tahun')
                                ->bindValue(':tahun', (DATE('Y')+1))
                                ->queryScalar();

                    $dataProvider = new SqlDataProvider([
                        'sql' => 'SELECT * FROM user
                            
                                    ',
                        'params' => [
                                ':tahun' => $model['tahun'],
                        ],
                        'totalCount' => $totalCount,
                        'sort' =>false, // to remove the table header sorting
                        'pagination' => [
                            'pageSize' => 50,
                        ],
                    ]);

                    return Yii::$app->controller->renderPartial('_kegiatan', [
                        'model'=>$model,
                        'dataProvider' => $dataProvider,
                        ]);
                },
                'detailOptions'=>[
                    'class'=> 'kv-state-enable',
                ],

            ],*/
            [
                'label' => '+++',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'kegiatan(this,"'.$model['tahun'].'.'.$model['kd_urusan'].'.'.$model['kd_bidang'].'.'.$model['kd_unit'].'.'.$model['kd_sub'].'.'.$model['no_skpdMisi'].'.'.$model['no_skpdTujuan'].'.'.$model['no_skpdSasaran'].'.'.$model['no_renjaProg'].'.'.$model['id_renprog'].'");return false;']);
                }
            ],
            [
                'label' => 'Program Renja',
                'format' => 'raw',
                'attribute' => 'program',
                'value' => function($model){
                    return Html::a($model['program'], ['renjaprogramview', 'id' => $model['id']],['data-pjax'=>"0"]/*, ['target'=>'_blank', 'data-pjax'=>"0"]*/);
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
                'label' => 'Program Renja',
                'format' => 'raw',
                'value'=> function($model){
                    return number_format($model['pagu_program_renja_awal'], 0, ',' ,'.').'<br /><hr />'.number_format($model['pagu_program_renja'], 0, ',' ,'.');
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
        ],
    ]); ?>         
</div>       
<?php Pjax::end(); ?>