<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SubkegiatanPhoto */

$this->title = 'Create Subkegiatan Photo';
$this->params['breadcrumbs'][] = ['label' => 'Subkegiatan Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subkegiatan-photo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
