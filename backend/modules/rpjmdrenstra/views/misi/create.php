<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaMisiSKPD */

$this->title = 'Create Ta Misi Skpd';
$this->params['breadcrumbs'][] = ['label' => 'Ta Misi Skpds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-misi-skpd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
