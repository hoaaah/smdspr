<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaIndikatorRPJMD */

$this->title = 'Create Ta Indikator Rpjmd';
$this->params['breadcrumbs'][] = ['label' => 'Ta Indikator Rpjmds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-indikator-rpjmd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
