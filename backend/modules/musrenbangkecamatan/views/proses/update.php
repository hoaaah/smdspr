<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Proses */

$this->title = 'Ubah Berita Acara '.$model->no_ba;
$this->params['breadcrumbs'][] = ['label' => 'Musrenbang Desa/Kelurahan', 'url' => ['subkegiatan/index']];
$this->params['breadcrumbs'][] = ['label' => 'Berita Acara', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_ba, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="proses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
