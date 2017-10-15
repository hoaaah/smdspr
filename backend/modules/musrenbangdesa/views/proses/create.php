<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Proses */

$this->title = 'Tambah Berita Acara';
$this->params['breadcrumbs'][] = ['label' => 'Musrenbang Desa/Kelurahan', 'url' => ['subkegiatan/index']];
$this->params['breadcrumbs'][] = ['label' => 'Berita Acara', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proses-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
