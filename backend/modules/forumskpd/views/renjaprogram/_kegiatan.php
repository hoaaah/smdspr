<?php
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use common\models\Subkegiatan;
use common\models\Jadwal;
use yii\widgets\Pjax;
?>
<?php // $this->context->Hello() ?>
            <div class="col-md-12">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><?= Html::a(Html::encode('Kegiatan '.$model['uraian']), ['/musrenrw/renjakegiatan/view', 'id'=>$model->id]) ?></br>
                  <small><?= Html::encode($model->sub['Nm_Sub_Unit']); ?></small></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-sm-6">
                        <strong>Masukan:</strong> Rp 200.000.000<br>
                        <strong>Masukan:</strong> 35 Hari<br>
                        <strong>Keluaran:</strong> 1 gedung<br>
                        <strong>Hasil:</strong> 15 IPM<br>
                    </div>
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
                        </br>
                        </br>
                        <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Pagu Kegiatan <?=number_format($model->pagu_kegiatan,0,",",".")?></button>
                        <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Pagu Musrenbang <?=number_format($model->pagu_musrenbang,0,",",".")?></button>
                        <!--<button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Total Usulan Lokasi Rp180 M</button>-->
                    </div>                              
                    <div class="col-sm-12">
                        <?php 
                            $data = new ActiveDataProvider([
                                        'query' => SubKegiatan::find()
                                            ->where([
                                                     'renja_kegiatan_id'=> $model['id'],
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
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'uraian',
                                'volume',
                                [
                                    'attribute' => 'kd_kelurahan',
                                    'value'=> function($model){
                                        return Html::encode($model->desa->desa);
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
                                    'value'=> function($model){
                                        return Html::a('<button type="button" class="btn btn-xs btn-default">Lihat Rincian</button>', ['subkegiatan/view', 'id'=>$model->id]);
                                    }
                                    
                                ],                  
                                //['class' => 'yii\grid\ActionColumn'],
                            ],
                        ]); ?>
                        <?php 
                        $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 2])->one();
                        IF($jadwal->tgl_mulai <= DATE('Y-m-d') && $jadwal->tgl_selesai >= DATE('Y-m-d') && !Yii::$app->user->isGuest) echo Html::a('Usulkan Lokasi Baru', ['subkegiatan/tambah', 'id' =>$model->id], ['class' => 'btn btn-sm btn-success pull-right']) ?>
                        <?php //Pjax::end(); ?>
                    </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
