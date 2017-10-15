<?php
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use common\models\RenjaKegiatan;
use yii\widgets\Pjax;
?>
<div class="col-md-12">
  <div class="panel panel-<?php echo  $model->id % 2 == 0 ? "info" : "default" ; ?>">
    <div class="panel-heading">
      <?= Html::a(Html::encode('Program '.$model['uraian']), ['detail', 'id'=>$model->id],[
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModal",
                                                    'data-title'=>"Detail Program ".$model->uraian,
                                                    ]) ?></br>
	  <small><?= Html::encode($model->subunit['Nm_Sub_Unit']); ?></small>
    </div>
    <!-- /.box-header -->
    <div class="panel-body">
	    <div class="col-sm-6">
			<strong>Status: </strong>
			<?php 	
			SWITCH($model['status']){
				CASE 1:
					$class = "label label-default";
					$title = "Usulan";
					break;
				CASE 2:
					$class = "label label-success";
					$title = "Diterima";
					break;
				CASE 3:
					$class = "label label-danger";
					$title = "Ditolak";
					break;
				CASE 4:
					$class = "label label-warning";
					$title = "Ditangguhkan";
					break;
				default:
					$class = "label label-default";
			};
			echo '<span title="'.$title.'" class="'.$class.'">'.$model->phased->keterangan.'</span>';
			?>			
	    </div>
		<div class="col-sm-6">
			<h4><span class="label label-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Pagu Program <?= Html::encode('Rp'.number_format($model['pagu_program'],0,",",".")) ?></span>
			<?php
				//dapatkan nilai total dari seluruh pagu kegiatan
				$kegiatan = RenjaKegiatan::find()
				                    //->select('SUM(pagu_kegiatan) AS total_kegiatan')
				                    ->where('tahun=:tahun AND kd_urusan=:kd_urusan AND kd_bidang=:kd_bidang AND kd_unit=:kd_unit AND kd_sub=:kd_sub AND id_renprog=:id_renprog', [':tahun' => $model->tahun, ':kd_urusan' => $model->kd_urusan, ':kd_bidang' => $model->kd_bidang, ':kd_unit' => $model->kd_unit, 'kd_sub'=> $model->kd_sub, ':id_renprog' => $model->id_renprog])
				                    //->groupBy('tahun, kd_urusan, kd_bidang, kd_unit, kd_sub, id_renprog')
				                    //->all();
				                    ->sum('pagu_kegiatan');
				//$pagu_keg_total = $kegiatan->sum('pagu_kegiatan');
			?>
			<span class="label label-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Total Kegiatan <?= Html::encode('Rp'.number_format($kegiatan,0,",",".")) ?></span></h4>
	    </div>			    			    
    	<div class="col-sm-12">
			<?php 
				$data = new ActiveDataProvider([
							'query' => RenjaKegiatan::find()
								->where([
										 'tahun'	=> $model['tahun'],
										 'kd_urusan'=> $model['kd_urusan'],
										 'kd_bidang'=> $model['kd_bidang'],
										 'kd_unit'=> $model['kd_unit'],
										 'kd_sub'=> $model['kd_sub'],
										 'id_renprog'=>$model['id_renprog'],
										 //'kd_bahas' => 1
										 ])
								->orderBy('id DESC'),
							'pagination' =>['pageSize' => 5,]
							]);
				$data->pagination->pageParam = 'data-page';
				$data->sort->sortParam = 'data-sort';
			?>
			<?php Pjax::begin(); ?>
			<div class="table-responsive">            	
		    <?= GridView::widget([
				'dataProvider' => $data,
				'pager' => [
					'firstPageLabel' => 'First',
					'lastPageLabel'  => 'Last'
				],
                'summary' => "<small>Menampilkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> Kegiatan</small>",
                'emptyText' => '<small><i>Tidak ada Kegiatan pada Program ini.</i></small>',		        
		        'columns' => [
		            ['class' => 'yii\grid\SerialColumn'],

		            [
		            	'label' => 'Kegiatan',
		            	'format' => 'raw',
		            	'value'=> function($model){
		            		return Html::a(Html::encode(strlen($model->uraian) >= 65 ? substr($model->uraian, 0,65).'....' : $model->uraian), ['kegiatanrinci', 'id'=>$model->id],[
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModalkegiatan",
                                                    'data-title'=>"Detail Kegiatan ".$model->uraian,
                                                    ]);
		            	}
		            	
		            ],
		            [
		            	//'label' => 'PAGU',
		            	'attribute' => 'pagu_kegiatan',
		            	'value'=> function($model){
		            		return "Rp ".number_format($model->pagu_kegiatan,0,",",".");
		            	}
		            	
		            ],
		            [
		            	'label' => 'Aksi',
		            	'format' => 'raw',
		            	'value'=> function($model){
		            		return Html::a('<button type="button" class="btn btn-xs btn-default">Lihat Rincian</button>', ['kegiatanrinci', 'id'=>$model->id],[
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModalkegiatan",
                                                    'data-title'=>"Detail Kegiatan ".$model->uraian,
                                                    ]);
		            	}
		            	
		            ],
		        ],
		    ]); ?>
		    </div>
		    <?php Pjax::end(); ?>
    	</div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!-- /.col -->