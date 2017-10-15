<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaTujuanSKPD */

$this->title = 'Create Ta Tujuan Skpd';
$this->params['breadcrumbs'][] = ['label' => 'Ta Tujuan Skpds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-tujuan-skpd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
