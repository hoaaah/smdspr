<?php
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use common\models\RenjaKegiatan;
use common\models\Subkegiatan;
use common\models\Jadwal;
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
    <?php   /*
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

	    </div> */
            ?>        			   
        <?php 
                    $connection = \Yii::$app->db;
                    $sql = "SELECT SUM(biaya) AS biaya FROM t_subkegiatan WHERE skpd = 0 AND status_phased >= 2 AND input_status IN (1,2) AND renja_kegiatan_id = ".$model->id;
                    $query = $connection->createCommand($sql);
                    $t_usulan_musrenbang = $query->queryOne();
                    $sql = "SELECT SUM(biaya) AS biaya FROM t_subkegiatan WHERE skpd = 1 AND status_phased >= 2 AND input_status IN (1,2) AND renja_kegiatan_id = ".$model->id;
                    $query = $connection->createCommand($sql);
                    $t_usulan_skpd = $query->queryOne();
                    IF($t_usulan_skpd['biaya'] > ($model->pagu_kegiatan-$model->pagu_musrenbang)){
                        $class_skpd = 'btn-danger';
                    }ELSE{
                        $class_skpd = 'btn-primary';
                    }

                    IF($t_usulan_musrenbang['biaya'] > $model->pagu_musrenbang){
                        $class_musren = 'btn-danger';
                    }ELSE{
                        $class_musren = 'btn-primary';
                    }
        ?>		
	    <div class="col-md-12">
			<span class="label label-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Pagu Kegiatan <?= Html::encode('Rp'.number_format($model['pagu_kegiatan'],0,",",".")) ?></span>
            <?php 
                $pagu_skpd = $model['pagu_kegiatan'] - $model['pagu_musrenbang'];
                IF($model['kd_bahas'] == 1):
            ?>

            <span class="label label-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Pagu SKPD <?= Html::encode('Rp'.number_format($pagu_skpd,0,",",".")) ?></span>
            <?php endif; ?>
			<span class="label label-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Usulan SKPD <?= Html::encode('Rp'.number_format($t_usulan_skpd['biaya'],0,",",".")) ?></span>
            <!--
            <button type="button" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Pagu Musren <?= Html::encode('Rp'.number_format($model['pagu_musrenbang'],0,",",".")) ?></button>
            <button type="button" class="btn btn-xs <?= $class_musren ?>"><i class="glyphicon glyphicon-signal bg-white"></i> Usulan Musren <?= Html::encode('Rp'.number_format($t_usulan_musrenbang['biaya'],0,",",".")) ?></button>
            -->
	    </div>    
                    <div class="col-sm-12">
                    	<small> Berikut daftar usulan anda untuk Kegiatan <?= Html::encode($model->uraian) ?> </small>
                        <?php 
                            $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 2])->one();
                            $data = new ActiveDataProvider([
                                        'query' => SubKegiatan::find()
                                            ->where([
                                                     'renja_kegiatan_id'=> $model['id'],
                                                     'skpd' => 1,
                                                     ])
                                            ->orderBy('id DESC'),
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
                                'volume',
                                'satuan',
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
                                    'label' => 'Aksi',
                                    'format' => 'raw',
                                    'value'=> function($model) use ($jadwal) {
                                        return $model->user_id == Yii::$app->user->identity->id && $jadwal->tgl_mulai <= DATE('Y-m-d') && $jadwal->tgl_selesai >= DATE('Y-m-d') ? Html::a('<button type="button" class="btn btn-xs btn-default">Lihat Rincian</button>', ['subkegiatan/view', 'id'=>$model->id]).Html::a('<button type="button" class="btn btn-xs btn-default">Ubah</button>', ['subkegiatan/update', 'id'=>$model->id]) : Html::a('<button type="button" class="btn btn-xs btn-default">Lihat Rincian</button>', ['subkegiatan/view', 'id'=>$model->id]) ;
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
                        IF($jadwal->tgl_mulai <= DATE('Y-m-d') && $jadwal->tgl_selesai >= DATE('Y-m-d') && !Yii::$app->user->isGuest) echo Html::a('Usulkan Lokasi Baru', ['subkegiatan/tambah', 'id' =>$model->id], ['class' => 'btn btn-sm btn-success pull-right']) ?>
                        <?php //Pjax::end(); ?>
                    </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!-- /.col -->