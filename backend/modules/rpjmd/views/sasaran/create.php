<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaSasaranRPJMD */

$this->title = 'Create Ta Sasaran Rpjmd';
$this->params['breadcrumbs'][] = ['label' => 'Ta Sasaran Rpjmds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-sasaran-rpjmd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
