<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaIndikatorProgRenstra */

$this->title = 'Create Ta Indikator Prog Renstra';
$this->params['breadcrumbs'][] = ['label' => 'Ta Indikator Prog Renstras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-indikator-prog-renstra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
