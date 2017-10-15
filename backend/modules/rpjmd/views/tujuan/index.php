<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rpjmd\models\TaTujuanRPJMDSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Tujuan Rpjmds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-tujuan-rpjmd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Tujuan Rpjmd', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'Ur_Tujuan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
