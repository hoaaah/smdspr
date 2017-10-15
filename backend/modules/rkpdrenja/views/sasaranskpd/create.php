<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaSasaranSKPD */

$this->title = 'Create Ta Sasaran Skpd';
$this->params['breadcrumbs'][] = ['label' => 'Ta Sasaran Skpds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-sasaran-skpd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
