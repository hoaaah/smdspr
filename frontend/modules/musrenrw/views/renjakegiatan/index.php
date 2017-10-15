<div class="row">
<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RenjaKegiatanSearchf */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Kegiatan Untuk Usulan Musrenbang '.$tahun;
$this->params['breadcrumbs'][] = 'Kegiatan Untuk Usulan Musrenbang '.$tahun;
//$this->title = 'Rencana Kerja <small>Kegiatan'</small>'
?>
<div class="renja-kegiatan-index">
    <div class="col-lg-12">
        <?php echo $this->render('_search', ['model' => $searchModel, 'query' => $query]); ?>
        <?php Pjax::begin(); ?>    
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'summary' => "Menampilkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> kegiatan",
            'itemView' => function ($model, $key, $index, $widget) use($tahun) {
                //return Html::a(Html::encode($model->id.$model->uraian), ['view', 'id' => $model->id]);
                $itemContent = $this->render('_list',['model' => $model, 'tahun' => $tahun]);
                return $itemContent;
            },
        ]) ?>
        <?php Pjax::end(); ?>
    </div>
</div>
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
</div><!--row-->