<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RenjaProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rencana Kerja';
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'Rencana Kerja '.$tahun.'<small>Program</small>'
?>
<div class="row">
<div class="renja-program-index">
    <div class="body-content">
        <div id="page-wrapper"> 
<!--COBA COBA TAB BAGUS G -->

        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Tampilan Kartu</a></li>
                    <!--<li><a href="#tab_2" data-toggle="tab">Tampilan Tabel</a></li>-->
                    <li><?php echo Html::a('Tampilan Tabel', ['table']) ?></li>
                </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $this->render('_search', ['model' => $searchModel, 'query' => $query]); ?>
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php  Pjax::begin();?>    
                            <?= ListView::widget([
                                'dataProvider' => $dataProvider,
                                'itemOptions' => ['class' => 'item'],
                                'pager' => [
                                    'firstPageLabel' => 'First',
                                    'lastPageLabel'  => 'Last'
                                ],
                                'summary' => "<div class=\"col-md-12\">Menampilkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> program </div>",                        
                                'itemView' => function ($model, $key, $index, $widget) {
                                    $itemContent = $this->render('_list',['model' => $model]);
                                    return $itemContent;
                                },
                            ]); ?>
                            <?php  Pjax::end(); ?>
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    asdads
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->




<!--COBA COBA TAB BAGUS G -->        
        </div>
    </div>
</div>
</div>
<?php
Modal::begin([
    'id' => 'myModal',
    'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
]);
 
echo '...';
 
Modal::end();

Modal::begin([
    'id' => 'myModalkegiatan',
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
$this->registerJs("
    $('#myModalkegiatan').on('show.bs.modal', function (event) {
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