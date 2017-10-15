<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaTujuanRPJMD */

$this->title = 'Create Ta Tujuan Rpjmd';
$this->params['breadcrumbs'][] = ['label' => 'Ta Tujuan Rpjmds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-tujuan-rpjmd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
