<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaSasaranRPJMD */

$this->title = $model->ID_Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Sasaran Rpjmds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-sasaran-rpjmd-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Perubahan' => $model->Kd_Perubahan, 'Kd_Dokumen' => $model->Kd_Dokumen, 'Kd_Usulan' => $model->Kd_Usulan, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ID_Tahun' => $model->ID_Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab_Kota' => $model->Kd_Kab_Kota, 'Kd_Perubahan' => $model->Kd_Perubahan, 'Kd_Dokumen' => $model->Kd_Dokumen, 'Kd_Usulan' => $model->Kd_Usulan, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran], [
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
            'No_Misi',
            'No_Tujuan',
            'No_Sasaran',
            'Ur_Sasaran',
            'Kd_Prioritas',
        ],
    ]) ?>

</div>
