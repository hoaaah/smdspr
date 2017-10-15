<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rpjmdrenstra\models\MisiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Misi Skpds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-misi-skpd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Misi Skpd', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_Tahun',
            'Kd_Prov',
            'Kd_Kab_Kota',
            'Kd_Urusan',
            'Kd_Bidang',
            // 'Kd_Unit',
            // 'No_Misi',
            // 'Ur_Misi',
            // 'No_Misi1',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
