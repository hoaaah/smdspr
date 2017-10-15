<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RenjaProgram */

$this->title = 'Create Renja Program';
$this->params['breadcrumbs'][] = ['label' => 'Renja Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="renja-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
