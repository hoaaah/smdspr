<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model common\models\Tperan */

$this->title = 'Tambah Lokasi '.Yii::$app->user->identity->username;
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['/user']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tperan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
