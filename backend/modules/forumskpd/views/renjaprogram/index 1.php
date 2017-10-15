<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RenjaProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rencana Kerja';
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'Rencana Kerja '.(DATE('Y')+1).'<small>Program</small>'
?>
<div class="renja-program-index">
    <div class="body-content">
        <div id="page-wrapper"> 
<!--COBA COBA TAB BAGUS G -->






<!--COBA COBA TAB BAGUS G -->        
            <?php echo $this->render('_search', ['model' => $searchModel, 'query' => $query]); ?>
            <div class="row">  
                <?php  Pjax::begin();?>    
                <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['class' => 'item'],
                        'summary' => "Menampilkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> program",                        
                        'itemView' => function ($model, $key, $index, $widget) {
                            //return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
                            $itemContent = $this->render('_list',['model' => $model]);
                            return $itemContent;
                        },
                        //'layout' => '{items}{pager}',
                    ]); ?>
                <?php  Pjax::end(); ?>
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