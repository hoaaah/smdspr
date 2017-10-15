<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rkpdrenja\models\TaSasaranSKPDSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Sasaran Skpds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-sasaran-skpd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Sasaran Skpd', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'No_Tujuan',
            // 'No_Sasaran',
            // 'Ur_Sasaran',
            // 'No_Misi1',
            // 'No_Tujuan1',
            // 'No_Sasaran1',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
