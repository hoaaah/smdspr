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
	    <?php 
	    	if($model['status'] == 1){
	    		echo Html::a('Tolak Program Ini', ['renjaprogram/tolak', 'id'=> $model['id']], ['class' => 'btn btn-xs btn-danger pull-right']).' '.Html::a('Tangguhkan Program Ini', ['renjaprogram/tangguh', 'id'=> $model['id']], ['class' => 'btn btn-xs btn-warning pull-right']).' '.Html::a('Usulkan Kegiatan Baru', ['renjaprogram/view', 'id'=> $model['id']], ['class' => 'btn btn-xs btn-success pull-right']);
    		}ELSE{
    			echo Html::a('Draft Ulang Program Ini', ['renjaprogram/draft', 'id'=> $model['id']], ['class' => 'btn btn-xs btn-default pull-right']).' '.Html::a('Usulkan Kegiatan Baru', ['renjaprogram/view', 'id'=> $model['id']], ['class' => 'btn btn-xs btn-success pull-right']);
    		} 

	    ?>                                                    
	  <small><?= Html::encode($model->subunit['Nm_Sub_Unit']); ?></small>
    </div>
    <!-- /.box-header -->
    <div class="panel-body">
	    <div class="col-sm-6">
			<strong>Status: </strong>
			<?php 	
			SWITCH($model['status']){
				CASE 1:
					$class = "btn btn-xs btn-default";
					$title = "Usulan";
					break;
				CASE 2:
					$class = "btn btn-xs btn-success";
					$title = "Diterima";
					break;
				CASE 3:
					$class = "btn btn-xs btn-danger";
					$title = "Ditolak";
					break;
				CASE 4:
					$class = "btn btn-xs btn-warning";
					$title = "Ditangguhkan";
					break;
				default:
					$class = "btn btn-xs btn-default";
			};
			echo '<button type="button" title="'.$title.'" class="'.$class.'">'.$model->phased->keterangan.'</button>';
			?>			
	    </div>
		<div class="col-sm-6">
			<button type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Pagu Program <?= Html::encode('Rp'.number_format($model['pagu_program'],0,",",".")) ?></button>
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
			<button type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Total Kegiatan <?= Html::encode('Rp'.number_format($kegiatan,0,",",".")) ?></button>
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
		            //'pagu_kegiatan:currency:Pagu Kegiatan',
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
		            		return Html::a('<button type="button" class="btn btn-xs btn-default">Lihat Usulan</button>', ['kegiatanrinci', 'id'=>$model->id],[
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModalkegiatan",
                                                    'data-title'=>"Detail Kegiatan ".$model->uraian,
                                                    ]);
		            	}
		            	
		            ],
                            [
                                'label' => 'Aksi',
                                'format'=>'raw',
                                'value' => function ($model, $image) use ($jadwal, $proses){
                                    //return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model->id.');return false;']);
                                    IF(isset($jadwal) && DATE('Y-m-d') >= $jadwal['tgl_mulai'] && DATE('Y-m-d') <= $jadwal['tgl_selesai'] && ($proses == NULL || $proses->status ==1)){
                                        if($model->status == 1){
                                            return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model->id.');return false;']).' '.
                                                Html::a('Tolak', ['infotolak', 'id' => $model->id], ['class' => 'btn btn-xs btn-danger',/*'data' => ['confirm' => 'Yakin menolak usulan ini?','method' => 'post',],*/'data-toggle'=>"modal",
                                                        'data-target'=>"#myModal",
                                                        'data-title'=>"Tolak Usulan ".$model->uraian,]).' '.
                                                Html::a('Tangguhkan', ['tangguh', 'id' => $model->id], ['class' => 'btn btn-xs btn-warning','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]);
                                        }ELSEIF($model->status == 4){
                                            return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model->id.');return false;']).' '.
                                                Html::a('Tolak', ['infotolak', 'id' => $model->id], ['class' => 'btn btn-xs btn-danger',/*'data' => ['confirm' => 'Yakin menolak usulan ini?','method' => 'post',],*/'data-toggle'=>"modal",
                                                        'data-target'=>"#myModal",
                                                        'data-title'=>"Tolak Usulan ".$model->uraian,]);
                                        }ELSE{
                                            return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model->id.');return false;']).' '.
                                            Html::a('Draftkan', ['draft', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary','data' => ['confirm' => 'Yakin kembalikan ke draft?','method' => 'post',],]);
                                        }
                                    }ELSE{
                                        return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model->id.');return false;']);
                                    }
                                }               
                            ],		            		            
		            //['class' => 'yii\grid\ActionColumn'],
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