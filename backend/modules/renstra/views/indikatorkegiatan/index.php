<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\renstra\models\TaIndikatorKegiatanSkpdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ta Indikator Kegiatan Skpds');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-indikator-kegiatan-skpd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ta Indikator Kegiatan Skpd'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_Tahun',
            'Kd_Prov',
            'Kd_Kab_Kota',
            'Kd_Urusan',
            'Kd_Bidang',
            // 'Kd_Unit',
            // 'No_Misi',
            // 'No_Tujuan',
            // 'No_Sasaran',
            // 'Kd_Prog',
            // 'ID_Prog',
            // 'Kd_Keg',
            // 'No_ID',
            // 'Kd_Indikator_1',
            // 'Kd_Indikator_2',
            // 'Kd_Indikator_3',
            // 'Tolak_Ukur',
            // 'Target_Uraian',
            // 'Kondisi_Kinerja_Awal',
            // 'NilaiTahun1',
            // 'NilaiTahun2',
            // 'NilaiTahun3',
            // 'NilaiTahun4',
            // 'NilaiTahun5',
            // 'Satuan',
            // 'Keterangan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
