<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaPemdaUmum */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Ta Pemda Umums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-pemda-umum-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
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
            'ID',
            'Kd_Prov',
            'Kd_Kab_Kota',
            'Ur_Visi',
            'Nm_Provinsi',
            'Nm_Pemda',
            'Nm_PimpDaerah',
            'Jab_PimpDaerah',
            'Nm_Sekda',
            'Nip_Sekda',
            'Jbt_Sekda',
            'Ibukota',
            'Alamat',
            'created_at',
        ],
    ]) ?>

</div>
