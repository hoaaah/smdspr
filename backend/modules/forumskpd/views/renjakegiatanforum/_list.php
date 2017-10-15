<?php
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use common\models\RenjaKegiatan;
use common\models\Subkegiatan;
use common\models\Jadwal;
use common\models\Proses;
use yii\widgets\Pjax;
?>

<div class="col-md-12">
  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= Html::a(Html::encode('Kegiatan '.$model['uraian']), ['view', 'id'=>$model->id]) ?></br>
	  <small><?= Html::encode($model->program['uraian']); ?></small></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php /*   
		<div class="col-sm-4">
			<strong>Status: </strong>

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

	    </div>			   
        */          ?>
        <?php 
                    $connection = \Yii::$app->db;
                    $sql = "SELECT SUM(biaya) AS biaya FROM t_subkegiatan WHERE skpd = 0 AND status_phased >= 5 AND input_status IN (1,2) AND renja_kegiatan_id =  ".$model->id;
                    $query = $connection->createCommand($sql);
                    $t_usulan_musrenbang = $query->queryOne();
                    $sql = "SELECT SUM(biaya) AS biaya FROM t_subkegiatan WHERE skpd = 1 AND status_phased >= 5 AND input_status IN (1,2) AND renja_kegiatan_id = ".$model->id;
                    $query = $connection->createCommand($sql);
                    $t_usulan_skpd = $query->queryOne();
                    IF($t_usulan_skpd['biaya'] > ($model->pagu_kegiatan-$model->pagu_musrenbang)){
                        $class_skpd = 'label-danger';
                    }ELSE{
                        $class_skpd = 'label-primary';
                    }

                    IF($t_usulan_musrenbang['biaya'] > $model->pagu_musrenbang){
                        $class_musren = 'label-danger';
                    }ELSE{
                        $class_musren = 'label-primary';
                    }
        ?>		
	    <div class="col-sm-12">
			<span class="label label-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Pagu Kegiatan <?= Html::encode('Rp'.number_format($model['pagu_kegiatan'],0,",",".")) ?></span>
			<span class="label label-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Usulan SKPD <?= Html::encode('Rp'.number_format($t_usulan_skpd['biaya'],0,",",".")) ?></span>
            <span class="label label-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Pagu Musren <?= Html::encode('Rp'.number_format($model['pagu_musrenbang'],0,",",".")) ?></span>
            <span class="label <?= $class_musren ?>"><i class="glyphicon glyphicon-signal bg-white"></i> Usulan Musren <?= Html::encode('Rp'.number_format($t_usulan_musrenbang['biaya'],0,",",".")) ?></span>
	    </div>    
                    <div class="col-sm-12">
                    	<small> Berikut daftar usulan anda untuk Kegiatan <?= Html::encode($model->uraian) ?> </small>
                        <?php 
                            $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 5])->one();
                            $proses = Proses::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 5])->andWhere('kd_urusan=:kd_urusan AND kd_bidang=:kd_bidang AND kd_unit=:kd_unit AND kd_sub=:kd_sub', [':kd_urusan' => Yii::$app->user->identity->tperan->kd_urusan, ':kd_bidang' => Yii::$app->user->identity->tperan->kd_bidang, ':kd_unit' => Yii::$app->user->identity->tperan->kd_unit, ':kd_sub' => Yii::$app->user->identity->tperan->kd_sub])->one();                            
                            $data = new ActiveDataProvider([
                                        'query' => SubKegiatan::find()
                                            ->where([
                                                     'renja_kegiatan_id'=> $model['id'],
                                                     //'status_phased' => 5,
                                                     ])
                                            ->andWhere(['>=', 'status_phased', 5])
                                            ->orderBy('skpd ASC'),
                                        'pagination' =>['pageSize' => 5,]
                                        ]);
                            $data->pagination->pageParam = 'data-page';
                            $data->sort->sortParam = 'data-sort';
                        ?>
                        <?php //Pjax::begin(); ?>               
                        <?= GridView::widget([
                            'dataProvider' => $data,
                            //'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
                            //'summary' => $count < 2 ? "" : "Showing {begin} - {end} of {totalCount} items",
                            //'tableOptions' => ['class' => 'table table-bordered table-hover'],
                            'summary' => "<small>Menampilkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> usulan</small>",
                            'emptyText' => '<small><i>Anda belum memberikan usulan pada kegiatan ini, silahkan tambahkan usulan.</i></small>',
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'uraian',
                                [
                                    'attribute' => 'volume',
                                    'value'=> function($model){
                                        return $model->volume.' '.$model->satuan;
                                    }
                                    
                                ],                                
                                [
                                    'attribute' => 'harga_satuan',
                                    'value'=> function($model){
                                        return "Rp ".number_format($model->harga_satuan,0,",",".");
                                    }
                                    
                                ],
                                [
                                    //'label' => 'PAGU',
                                    'attribute' => 'biaya',
                                    'value'=> function($model){
                                        return "Rp ".number_format($model->biaya,0,",",".");
                                    }
                                    
                                ],
                                [
                                    'attribute' => 'skpd',
                                    'label' => 'User',
                                    'value'=> function($model){
                                        IF($model->skpd == 1){
                                            return 'SKPD';
                                        }ELSE{
                                            return 'Musren';
                                        }
                                    }
                                    
                                ],
                                [
                                    'attribute' => 'input_status',
                                    'label' => 'Status',
                                    'format' => 'raw',
                                    'value'=> function($model){
                                        SWITCH($model['input_status']){
                                            CASE 1:
                                                $class = "btn btn-xs btn-default";
                                                $input_status = "Usulan";
                                                break;
                                            CASE 2:
                                                $class = "btn btn-xs btn-success";
                                                $input_status = "Diterima";
                                                break;
                                            CASE 3:
                                                $class = "btn btn-xs btn-danger";
                                                $input_status = "Ditolak";
                                                break;
                                            CASE 4:
                                                $class = "btn btn-xs btn-warning";
                                                $input_status = "Ditangguhkan";
                                                break;
                                            default:
                                                $class = "btn btn-xs btn-default";
                                        };                                        
                                        return '<button type="button" title="'.$input_status.'" class="'.$class.'">'.$model->inputStatus->keterangan.'</button>';
                                    }
                                    //'value' => 'inputStatus.keterangan',
                                ],                                
                                [
                                    'label' => 'Aksi',
                                    'format' => 'raw',
                                    'value'=> function($model) use ($jadwal, $proses) {
                                        IF(isset($jadwal) && DATE('Y-m-d') >= $jadwal['tgl_mulai'] && DATE('Y-m-d') <= $jadwal['tgl_selesai'] && ($proses == NULL || $proses->status ==1)){
                                            if($model->input_status == 1){
                                                return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model->id.');return false;']).' '.
                                                    Html::a('Terima', ['terima', 'id' => $model->id], ['class' => 'btn btn-xs btn-success','data' => ['confirm' => 'Yakin menerima usulan ini?','method' => 'post',],]).' '.
                                                    Html::a('Tolak', ['infotolak', 'id' => $model->id], ['class' => 'btn btn-xs btn-danger',/*'data' => ['confirm' => 'Yakin menolak usulan ini?','method' => 'post',],*/'data-toggle'=>"modal",
                                                            'data-target'=>"#myModal",
                                                            'data-title'=>"Tolak Usulan ".$model->uraian,]).' '.
                                                    Html::a('Tangguhkan', ['tangguh', 'id' => $model->id], ['class' => 'btn btn-xs btn-warning','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]);
                                            }ELSEIF($model->input_status == 4){
                                                return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model->id.');return false;']).' '.
                                                    Html::a('Terima', ['terima', 'id' => $model->id], ['class' => 'btn btn-xs btn-success','data' => ['confirm' => 'Yakin menerima usulan ini?','method' => 'post',],]).' '.
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
                                        /*                                    
                                        return $model->user_id == Yii::$app->user->identity->id && $jadwal->tgl_mulai <= DATE('Y-m-d') && $jadwal->tgl_selesai >= DATE('Y-m-d') ? Html::a('<button type="button" class="btn btn-xs btn-default">Lihat Rincian</button>', ['subkegiatan/view', 'id'=>$model->id]).Html::a('<button type="button" class="btn btn-xs btn-default">Ubah</button>', ['subkegiatan/update', 'id'=>$model->id]) : Html::a('<button type="button" class="btn btn-xs btn-default">Lihat Rincian</button>', ['subkegiatan/view', 'id'=>$model->id]) ;
                                        */
                                    }
                                    
                                ],                  
                                //['class' => 'yii\grid\ActionColumn'],
                            ],
                        ]); ?>
                        <small class="text-danger"> Untuk diperhatikan: 
                        <?php 
                            IF(strlen($model->info_asb) >= 50){
                                echo Html::encode(substr($model->info_asb,0,50)).html::a(' <button type="button" class="btn btn-xs btn-default">...Lihat lebih</button>', ['renjakegiatan/info', 'id'=>$model->id],[
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModal",
                                                    'data-title'=>"Perhatian untuk kegiatan".$model->uraian,
                                                    ]);   
                            }ELSE{
                                echo Html::encode($model->info_asb) ;
                            } ?> 
                        </small>
                        <?php 
                        IF($jadwal->tgl_mulai <= DATE('Y-m-d') && $jadwal->tgl_selesai >= DATE('Y-m-d') && !Yii::$app->user->isGuest) echo Html::a('Usulkan Lokasi Baru', ['subkegiatanforum/tambah', 'id' =>$model->id], ['class' => 'btn btn-sm btn-success pull-right']) ?>
                        <?php //Pjax::end(); ?>
                    </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!-- /.col -->