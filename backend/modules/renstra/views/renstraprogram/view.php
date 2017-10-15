<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Renstra */

$this->title = $model->ID_Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Renstras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="renstra-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Perubahan' => $model->Kd_Perubahan, 'Kd_Dokumen' => $model->Kd_Dokumen, 'Kd_Usulan' => $model->Kd_Usulan, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran, 'Kd_Prog' => $model->Kd_Prog, 'ID_Prog' => $model->ID_Prog], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Perubahan' => $model->Kd_Perubahan, 'Kd_Dokumen' => $model->Kd_Dokumen, 'Kd_Usulan' => $model->Kd_Usulan, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran, 'Kd_Prog' => $model->Kd_Prog, 'ID_Prog' => $model->ID_Prog], [
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
            'ID_Tahun',
            'Kd_Prov',
            'Kd_Kab_Kota',
            'Kd_Perubahan',
            'Kd_Dokumen',
            'Kd_Usulan',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'No_Misi',
            'No_Tujuan',
            'No_Sasaran',
            'Kd_Prog',
            'ID_Prog',
            'Tgl_Perubahan',
            'Nm_Prov',
            'Nm_Kab',
            'Nm_Urusan',
            'Nm_Bidang',
            'Nm_Unit',
            'Ur_Misi',
            'Ur_Tujuan',
            'Ur_Sasaran',
            'Ket_Program',
            'Kd_Urusan1',
            'Kd_Bidang1',
            'No_Misi1',
            'No_Tujuan1',
            'No_Sasaran1',
            'Kd_Prog1',
            'ID_Prog1',
            'Ur_Misi1',
            'Ur_Tujuan1',
            'Ur_Sasaran1',
            'Ket_Program1',
        ],
    ]) ?>

</div>
