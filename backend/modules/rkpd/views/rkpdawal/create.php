<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RkpdProgram */

$this->title = 'Create Rkpd Program';
$this->params['breadcrumbs'][] = ['label' => 'Rkpd Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rkpd-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
