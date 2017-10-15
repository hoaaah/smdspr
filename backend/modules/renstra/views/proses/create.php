<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaPeriode */

$this->title = 'Create Ta Periode';
$this->params['breadcrumbs'][] = ['label' => 'Ta Periodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-periode-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
