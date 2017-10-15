<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RenjaProgram */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Renja Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="renja-program-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tahun',
            'urusan_id',
            'bidang_id',
            'kd_urusan',
            'kd_bidang',
            'kd_unit',
            'kd_sub',
            'no_skpdMisi',
            'no_skpdTujuan',
            'no_skpdSasaran',
            'no_renjaSas',
            'no_renjaProg',
            'id_renprog',
            'uraian',
            'pagu_program',
            'created_at',
            'updated_at',
            'user_id',
            'input_phased',
            'status',
            'status_phased',
            'rkpd_program_id',
            'id_tahun',
            'Kd_Perubahan_Renstra',
            'Kd_Dokumen_Renstra',
            'Kd_Usulan_Renstra',
            'Kd_Urusan_Renstra',
            'Kd_Bidang_Renstra',
            'Kd_Unit_Renstra',
            'No_Misi_Renstra',
            'No_Tujuan_Renstra',
            'No_Sasaran_Renstra',
            'Kd_Prog_Renstra',
            'ID_Prog_Renstra',
        ],
    ]) ?>

</div>
