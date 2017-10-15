<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaIndikatorKegiatanSkpd */

$this->title = Yii::t('app', 'Create Ta Indikator Kegiatan Skpd');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ta Indikator Kegiatan Skpds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-indikator-kegiatan-skpd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
