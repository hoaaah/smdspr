<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Jadwal */

$this->title = 'Buat Jadwal';
$this->params['breadcrumbs'][] = 'Parameter';
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Input', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwal-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
