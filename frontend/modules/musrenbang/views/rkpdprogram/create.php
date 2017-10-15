<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TRkpdProgram */

$this->title = 'Create Trkpd Program';
$this->params['breadcrumbs'][] = ['label' => 'Trkpd Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trkpd-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
