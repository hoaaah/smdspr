<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\detail\DetailView;
use yii\data\SqlDataProvider;
use yii\widgets\Pjax;
use backend\assets\UsulanAsset;
use yii\bootstrap\Modal;
$image = backend\assets\UsulanAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\musrenbangdesa\models\SubkegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'RKPD: '.$model->uraian;
$this->params['breadcrumbs'][] = ['label' => 'Musrenbang RKPD', 'url' => ['musrenbangrkpd/']];
$this->params['breadcrumbs'][] = 'RKPD Program';
$this->params['breadcrumbs'][] = $model->uraian;
?>

<!-- Detail Program -->
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
            'label' => 'Program',
            'format' => 'ntext',
            'attribute' => 'uraian'
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

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-tasks"></i> Daftar Program Renja</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
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
				        'emptyText' => '<small><i>Tidak ada Program Renja Pada Program RKPD ini.</i></small>',                        
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
				<?php /*
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Reason</th>
                </tr>
                <tr>
                  <td>183</td>
                  <td>John Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-success">Approved</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
                <tr>
                  <td>219</td>
                  <td>Alexander Pierce</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-warning">Pending</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
                <tr>
                  <td>657</td>
                  <td>Bob Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-primary">Approved</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
                <tr>
                  <td>175</td>
                  <td>Mike Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-danger">Denied</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
              </table>
              */?>				   
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>


<?php 
$this->registerJs('
        function kegiatan(obj,person_id){
            /*
                <table> 
                    <tr>
                        <td>
                            <a> */
            var a = obj; // get element anchor
            var td = $(a).parent(); // get parent dari element anchor = td
            var tr = $(td).parent(); // get element tr
            var tdCount = $(tr).children().length; // get jumlah kolom pada tr
            var table = $(tr).parent(); // get element table
            $(table).children(".trDetail").remove(); // initialise, drop all of child with class trDetail
             
            var trDetail = document.createElement("tr"); // create element tr for detail
            $(trDetail).attr("class","trDetail"); // add class trDetail for element tr 
            var tdDetail = document.createElement("td"); // create element td for detail tr
            $(tdDetail).attr("colspan",tdCount); // add element coolspan at td
            $(tdDetail).html("<span class=\'fa fa-spinner fa-spin\'></span>"); // loader kaka.. <img src="http://www.hafidmukhlasin.com/wp-includes/images/smilies/icon_smile.gif" alt=":)" class="wp-smiley"> 
             
            // get content via ajax
            $.get("'.\yii\helpers\Url::to(['musrenbangrkpd/kegiatan']).'&id="+person_id, function( data ) {
              $(tdDetail).html( data );
            }).fail(function() {
                alert( "Terjadi Kesalahan Coba refresh halaman ini." );
              });
            $(trDetail).append(tdDetail); // add td to tr
            $(tr).after(trDetail);  // add tr to table
        }
     
', \yii\web\View::POS_HEAD) ?>
<?php 
$this->registerJs('
        function subkegiatan(obj,person_id){
            /*
                <table> 
                    <tr>
                        <td>
                            <a> */
            var a = obj; // get element anchor
            var td = $(a).parent(); // get parent dari element anchor = td
            var tr = $(td).parent(); // get element tr
            var tdCount = $(tr).children().length; // get jumlah kolom pada tr
            var table = $(tr).parent(); // get element table
            $(table).children(".trDetail").remove(); // initialise, drop all of child with class trDetail
             
            var trDetail = document.createElement("tr"); // create element tr for detail
            $(trDetail).attr("class","trDetail"); // add class trDetail for element tr 
            var tdDetail = document.createElement("td"); // create element td for detail tr
            $(tdDetail).attr("colspan",tdCount); // add element coolspan at td
            $(tdDetail).html("<span class=\'fa fa-spinner fa-spin\'></span>"); // loader kaka.. <img src="http://www.hafidmukhlasin.com/wp-includes/images/smilies/icon_smile.gif" alt=":)" class="wp-smiley"> 
             
            // get content via ajax
            $.get("'.\yii\helpers\Url::to(['musrenbangrkpd/subkegiatan']).'&id="+person_id, function( data ) {
              $(tdDetail).html( data );
            }).fail(function() {
                alert( "Terjadi Kesalahan Coba refresh halaman ini." );
              });
            $(trDetail).append(tdDetail); // add td to tr
            $(tr).after(trDetail);  // add tr to table
        }
     
', \yii\web\View::POS_HEAD) ?>