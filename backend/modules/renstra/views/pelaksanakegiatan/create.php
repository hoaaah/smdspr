<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaPelaksanaKegSkpd */

$this->title = Yii::t('app', 'Create Ta Pelaksana Keg Skpd');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ta Pelaksana Keg Skpds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-pelaksana-keg-skpd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
