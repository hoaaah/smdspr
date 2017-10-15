<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rkpdrenja\models\RenjaProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Renja Programs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="renja-program-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Renja Program', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tahun',
            'urusan_id',
            'bidang_id',
            'kd_urusan',
            // 'kd_bidang',
            // 'kd_unit',
            // 'kd_sub',
            // 'no_skpdMisi',
            // 'no_skpdTujuan',
            // 'no_skpdSasaran',
            // 'no_renjaSas',
            // 'no_renjaProg',
            // 'id_renprog',
            // 'uraian',
            // 'pagu_program',
            // 'created_at',
            // 'updated_at',
            // 'user_id',
            // 'input_phased',
            // 'status',
            // 'status_phased',
            // 'rkpd_program_id',
            // 'id_tahun',
            // 'Kd_Perubahan_Renstra',
            // 'Kd_Dokumen_Renstra',
            // 'Kd_Usulan_Renstra',
            // 'Kd_Urusan_Renstra',
            // 'Kd_Bidang_Renstra',
            // 'Kd_Unit_Renstra',
            // 'No_Misi_Renstra',
            // 'No_Tujuan_Renstra',
            // 'No_Sasaran_Renstra',
            // 'Kd_Prog_Renstra',
            // 'ID_Prog_Renstra',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
