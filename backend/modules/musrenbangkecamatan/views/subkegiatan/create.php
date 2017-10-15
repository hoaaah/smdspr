<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Subkegiatan */

$this->title = 'Create Subkegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Subkegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subkegiatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
