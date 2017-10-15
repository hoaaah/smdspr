<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RkpdProgram */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rkpd Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rkpd-program-view">

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
            'no_misi',
            'no_tujuan',
            'no_sasaran',
            'id_sasrkpd',
            'id_progrkpd',
            'uraian',
            'created_at',
            'updated_at',
            'user_id',
            'input_phased',
            'status',
            'status_phased',
            'id_tahun',
            'Kd_Perubahan_Rpjmd',
            'Kd_Dokumen_Rpjmd',
            'Kd_Usulan_Rpjmd',
            'No_Misi_Rpjmd',
            'No_Tujuan_Rpjmd',
            'No_Sasaran_Rpjmd',
            'Kd_Prog_Rpjmd',
            'ID_Prog_Rpjmd',
        ],
    ]) ?>

</div>
