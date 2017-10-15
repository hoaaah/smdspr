<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TRenjaProgram */

$this->title = 'Create Trenja Program';
$this->params['breadcrumbs'][] = ['label' => 'Trenja Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trenja-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
