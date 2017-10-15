<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rkpdrenja\models\RkpdProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'RKPD Awal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rkpd-program-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah RKPD Awal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,   
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,        
        'panel'=>['type'=>'primary', 'heading'=>'Daftar Deposito'],           
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'id',
            'tahun',
            'urusan_id',
            'bidang_id',
            'no_misi',
            // 'no_tujuan',
            // 'no_sasaran',
            // 'id_sasrkpd',
            // 'id_progrkpd',
            // 'uraian',
            // 'created_at',
            // 'updated_at',
            // 'user_id',
            // 'input_phased',
            // 'status',
            // 'status_phased',
            // 'id_tahun',
            // 'Kd_Perubahan_Rpjmd',
            // 'Kd_Dokumen_Rpjmd',
            // 'Kd_Usulan_Rpjmd',
            // 'No_Misi_Rpjmd',
            // 'No_Tujuan_Rpjmd',
            // 'No_Sasaran_Rpjmd',
            // 'Kd_Prog_Rpjmd',
            // 'ID_Prog_Rpjmd',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
