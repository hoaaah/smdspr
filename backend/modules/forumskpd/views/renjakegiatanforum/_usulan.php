<?php
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use common\models\Subkegiatan;
use common\models\Jadwal;
//use frontend\modules\musrenrw\controllers\RenjakegiatanController;
use yii\widgets\Pjax;
?>

            <div class="col-md-12">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><?= Html::a(Html::encode('Usulan '.$model['uraian']), ['/musrenrw/renjakegiatan/view', 'id'=>$model->id]) ?></br>
                  <small><?php // Html::encode($model->sub['Nm_Sub_Unit']); ?></small></h3>
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
                        SWITCH($model['status_phased']){
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
                                $title = 'noname';
                        };
                        echo '<button type="button" title="'.$title.'" class="'.$class.'">'.$model->statusPhased->keterangan.'</button>';
                        ?>
                        </br>
                        </br>
                        <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Pagu Kegiatan Rp200 M</button>
                        <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-signal bg-white"></i> Total Usulan Lokasi Rp180 M</button>
                    </div>                              
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
