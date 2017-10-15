<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaPemdaUmum */

$this->title = 'Create Ta Pemda Umum';
$this->params['breadcrumbs'][] = ['label' => 'Ta Pemda Umums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-pemda-umum-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
