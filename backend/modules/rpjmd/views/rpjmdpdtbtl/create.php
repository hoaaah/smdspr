<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaMisiRPJMD */

$this->title = 'Create Ta Misi Rpjmd';
$this->params['breadcrumbs'][] = ['label' => 'Ta Misi Rpjmds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-misi-rpjmd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
