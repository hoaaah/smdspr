<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaMisiRPJMD */

$this->title = 'Tambah Misi';
$this->params['breadcrumbs'][] = 'RPJMD';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-misi-rpjmd-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
