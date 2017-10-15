<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\musrenbangdesa\models\ProsesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Berita Acara';
$this->params['breadcrumbs'][] = ['label' => 'Usulan SKPD', 'url' => ['subkegiatan/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proses-index">
    <div class = "row">
        <div class= "col-lg-12">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Berita Acara', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,
        'panel'=>['type'=>'primary', 'heading'=>'Daftar Berita Acara'],                        
        'summary' => "<small>Menampilkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> Berita Acara</small>",
        'emptyText' => '<small><i>Tidak ada Berita Acara sampai saat ini.</i></small>',        
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            'tahun',
            //'kd_urusan',
            //'kd_bidang',
            //'kd_unit',
            // 'kd_sub',
            // 'kd_kecamatan',
            // 'kd_kelurahan',
            'no_ba',
            'tanggal_ba:date',
            // 'input_phased',
            'penandatangan',
            // 'nip_penandatangan',
            // 'jabatan_penandatangan',
            [
                'attribute' => 'status',
                'label' => 'Status Berita Acara',
                'format' => 'raw',
                'contentOptions' => ['style' => ['max-width' => '280px;' /*,'class' => 'text-wrap',*/ ]],
                'value'=> function($model){
                    if($model->status == 1){
                        return Html::a('Belum Diproses', ['praproses', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary','data' => ['confirm' => 'Yakin akan memproses data?'],]);
                    }ELSE{
                        return Html::a('Telah Diproses', '#', ['class' => 'btn btn-xs btn-danger']);
                    }
                }
                
            ],            
            // 'created_at',
            // 'updated_at',
            // 'user_id',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
        </div><!--col-->
    </div><!--row-->
</div>
