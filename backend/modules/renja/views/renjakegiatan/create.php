<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RenjaKegiatan */

$this->title = 'Create Renja Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Renja Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="renja-kegiatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
