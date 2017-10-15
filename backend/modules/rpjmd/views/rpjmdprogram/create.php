<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RpjmdProgram */

$this->title = 'Create Rpjmd Program';
$this->params['breadcrumbs'][] = ['label' => 'Rpjmd Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rpjmd-program-create">

    <?= $this->render('_form', [
        'model' => $model,
        'pagu' => $pagu,
        'capaian' => $capaian,
    ]) ?>

</div>
