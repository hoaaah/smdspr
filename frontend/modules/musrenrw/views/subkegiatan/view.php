<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Jadwal;
use frontend\assets\AppAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Subkegiatan */
$this->title = 'Usulan '.$model->uraian;
$this->params['breadcrumbs'][] = ['label' => 'Rencana Kerja '.$kegiatan->tahun, 'url' => ['renjakegiatan/index']];
$this->params['breadcrumbs'][] = ['label'=> 'Kegiatan '.substr($kegiatan->uraian,0,20), 'url' => ['renjakegiatan/view', 'id'=> $kegiatan->id]];
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'Rencana Kerja <small>Kegiatan '.substr($model->uraian,0,20).'</small>';

?>
<div class="subkegiatan-view">
<div class="body-content">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Rincian Usulan</h3>
                    </div>
                    <div class="panel-body">            
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                //'id',
                                'uraian',
                                'renjaKegiatan.uraian',
                                'kecamatan.kecamatan',
                                'desa.desa',
                                'rw',
                                'rt',
                                //'lokasi',
                                'volume',
                                'satuan',
                                'harga_satuan:currency',
                                'biaya:currency',
                                'keterangan:ntext',
                                'kd_asb',
                                'inputPhased.keterangan',
                                'statusPhased.keterangan',
                                'inputStatus.keterangan',
                                'created_at:date',
                                'updated_at:date',
                                'user.nama',
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <?php
                //Tambahkan condition untuk memunculkan tombol
                $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => $model->tahun])->andWhere('input_phased=:input', [':input' => 2])->one();
                IF($model->user_id == Yii::$app->user->identity->id && $jadwal->tgl_mulai <= DATE('Y-m-d') && $jadwal->tgl_selesai >= DATE('Y-m-d')):
                ?>             
                <p>
                    <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
                    <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-sm btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?= Html::a('Tambah Gambar', ['subkegiatanphoto/tambah', 'id' => $model->id], ['class' => 'btn btn-sm btn-default']) ?>
                </p>
                <?php ENDIF; ?>   
                <?php foreach($photo as $photo) :?>            
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= Html::encode($photo->caption) ?></h3>
                    </div>
                    <div class="panel-body">
                        <?php echo Html::img(Url::to(['/musrenrw/subkegiatan/image', 'filename' => $photo->file], true), ['class' => 'pull-left img-responsive']); ?>
                    </div>
                </div>
                <?php endforeach;?>                             
            </div>
        </div>
    </div>
</div>
</div>
