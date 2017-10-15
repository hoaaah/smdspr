<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\renja\models\RenjaKegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Renja Kegiatans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="renja-kegiatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Renja Kegiatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tahun',
            'kd_urusan',
            'kd_bidang',
            'kd_unit',
            // 'kd_sub',
            // 'no_skpdMisi',
            // 'no_skpdTujuan',
            // 'no_skpdSasaran',
            // 'no_renjaSas',
            // 'no_renjaProg',
            // 'id_renprog',
            // 'id_renkeg',
            // 'uraian',
            // 'lokasi',
            // 'lokasi_maps',
            // 'kelompok_sasaran',
            // 'status_kegiatan',
            // 'pagu_kegiatan',
            // 'pagu_musrenbang',
            // 'kd_asb',
            // 'info_asb',
            // 'kd_bahas',
            // 'created_at',
            // 'updated_at',
            // 'user_id',
            // 'input_phased',
            // 'status',
            // 'status_phased',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
