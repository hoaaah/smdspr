<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TRpjmdPrioritas */

$this->title = 'Tambah Prioritas';
$this->params['breadcrumbs'][] = 'RPJMD';
$this->params['breadcrumbs'][] = ['label' => 'Prioritas Daerah', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trpjmd-prioritas-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
