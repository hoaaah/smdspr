<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rpjmd\models\TaSasaranRPJMDSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Sasaran Rpjmds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-sasaran-rpjmd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Sasaran Rpjmd', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_Tahun',
            'Kd_Prov',
            'Kd_Kab_Kota',
            'Kd_Perubahan',
            'Kd_Dokumen',
            // 'Kd_Usulan',
            // 'No_Misi',
            // 'No_Tujuan',
            // 'No_Sasaran',
            // 'Ur_Sasaran',
            // 'Kd_Prioritas',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
