<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rkpdrenja\models\RkpdProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Renja Awal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rkpd-program-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    
<?php echo GridView::widget([

        'id' => 'kv-grid-demo',
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true, // pjax is set to always true for this demo
        // set your toolbar
        'toolbar'=> [
            '{export}',
            '{toggleData}',
        ],
        // set export properties
        'export'=>[
            'fontAwesome'=>true
        ],
        // parameters from the demo form
        'bordered'=>true,
        //'striped'=>true,
        //'condensed'=>true,
        'responsive'=>true,
        'hover'=>true,
        'showPageSummary'=>true,
        'panel'=>[
            'type'=>GridView::TYPE_PRIMARY,
            'heading'=>'Daftar Misi-Tujuan-Sasaran dan RKPD Awal',
        ],
        'persistResize'=>true,   
        'columns' => [
            //['class' => 'kartik\grid\SerialColumn'],

            //'ID_Tahun',
            //'Kd_Prov',
            //'Kd_Kab_Kota',
            //'Kd_Perubahan',
            //'Kd_Dokumen',
            //'Kd_Usulan',
            //'misi.Ur_Misi',
            [
                'attribute'=>'misi.Ur_Misi', 
                'width'=>'10px',
                'value' => function ($model){
                    return wordwrap('Misi '.$model->No_Misi.' : '.$model->misi->Ur_Misi, 100, "<br />\n");
                },
                'group'=>true,  // enable grouping,
                'groupedRow'=>true,                    // move grouped column to a single grouped row
                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
            ],  
            [
                'attribute'=>'tujuan.Ur_Tujuan', 
                'width'=>'10px',
                'value' => function ($model){
                    return '<small>'.wordwrap('Tujuan : '.$model->tujuan->Ur_Tujuan, 100, "<br />\n").'</small>';
                },
                'format' => 'raw',
                'group'=>true,  // enable grouping,
                'groupedRow'=>true,                    // move grouped column to a single grouped row
                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
            ],                      
            [
                'attribute' => 'No_Sasaran',
                'filter' => false,
                'width' => '30px',
            ],
            'Ur_Sasaran',
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {

                    return GridView::ROW_COLLAPSED;
                },
                'width' => '30px',
                'allowBatchToggle'=>true,
                'detail'=>function ($model, $key, $index, $column) {
                $searchModel = new \backend\modules\rkpdrenja\models\RenjaProgramSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                //'ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Perubahan' => 'Kd_Perubahan', 'Kd_Dokumen' => 'Kd_Dokumen', 'Kd_Usulan' => 'Kd_Usulan', 'No_Misi' => 'No_Misi'
                $dataProvider->query->where('ID_Tahun = '.$model->ID_Tahun.' AND no_skpdMisi = '.$model->No_Misi.' AND no_skpdTujuan='.$model->No_Tujuan.' AND no_skpdSasaran='.$model->No_Sasaran);
                $dataProvider->pagination->pageParam = 'renja-page';
                $dataProvider->sort->sortParam = 'renja-sort';

                    return Yii::$app->controller->renderPartial('_renja', [
                        'model'=>$model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        ]);
                },
                'detailOptions'=>[
                    'class'=> 'kv-state-enable',
                ],

            ],      
            //['class' => 'kartik\grid\ActionColumn'],
        ],
    ]);  ?>
<?php Pjax::end(); ?></div>
<?php 
    Modal::begin([
        'id' => 'myModal',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
");    
?>