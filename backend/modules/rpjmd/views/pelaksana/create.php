<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaPelaksanaProgRPJMD */

$this->title = 'Create Ta Pelaksana Prog Rpjmd';
$this->params['breadcrumbs'][] = ['label' => 'Ta Pelaksana Prog Rpjmds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-pelaksana-prog-rpjmd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
