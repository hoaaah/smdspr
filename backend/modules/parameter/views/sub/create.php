<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Sub */

$this->title = Yii::t('app', 'Create Sub');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
