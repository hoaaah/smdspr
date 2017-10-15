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
$this->title = 'Rencana Kerja '.(DATE('Y')+1).'<small>Program</small>'
?>
<div class="row">
<div class="renja-program-index">
    <div class="body-content">
        <div id="page-wrapper"> 
<!--COBA COBA TAB BAGUS G -->

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Rencana Kerja SKPD
                    <div class="pull-right">
                        <button type="button" class="add_field_button btn btn-info btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                        <button type="button" class="remove-item btn btn-warning btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                    </div>                                
                </div>
                <div class="panel-body">        
                    <?php echo $this->render('_search', ['model' => $searchModel, 'query' => $query]); ?>
                    <div class="row">  
                        <?php  Pjax::begin();?>    
                        <?= ListView::widget([
                                'dataProvider' => $dataProvider,
                                'itemOptions' => ['class' => 'item'],
                                'summary' => "Menampilkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> program",                        
                                'itemView' => function ($model, $key, $index, $widget) use ($jadwal, $proses) {
                                    //return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
                                    $itemContent = $this->render('_list',['model' => $model, 'jadwal' => $jadwal, 'proses' => $proses]);
                                    return $itemContent;
                                },
                                //'layout' => '{items}{pager}',
                            ]); ?>
                        <?php  Pjax::end(); ?>
                    </div>
                </div>
            </div><!--panel-->
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