<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaKegiatanSkpd */

$this->title = 'Create Ta Kegiatan Skpd';
$this->params['breadcrumbs'][] = ['label' => 'Ta Kegiatan Skpds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-kegiatan-skpd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
