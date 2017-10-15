<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tperan */

$this->title = 'Create Tperan';
$this->params['breadcrumbs'][] = ['label' => 'Tperans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tperan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
