<div class="row">
<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RenjaKegiatanSearchf */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Kegiatan '.Yii::$app->user->identity->tperan->sub->Nm_Sub_Unit.' Tahun '.(Date('Y')+1);
$this->params['breadcrumbs'][] = 'Forum SKPD';
$this->params['breadcrumbs'][] = 'Kegiatan '.(Date('Y')+1);
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
            'itemView' => function ($model, $key, $index, $widget) {
                //return Html::a(Html::encode($model->id.$model->uraian), ['view', 'id' => $model->id]);
                $itemContent = $this->render('_list',['model' => $model]);
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

<?php 
$this->registerJs('
        function detail(obj,person_id){
            /*
                <table> 
                    <tr>
                        <td>
                            <a> */
            var a = obj; // get element anchor
            var td = $(a).parent(); // get parent dari element anchor = td
            var tr = $(td).parent(); // get element tr
            var tdCount = $(tr).children().length; // get jumlah kolom pada tr
            var table = $(tr).parent(); // get element table
            $(table).children(".trDetail").remove(); // initialise, drop all of child with class trDetail
             
            var trDetail = document.createElement("tr"); // create element tr for detail
            $(trDetail).attr("class","trDetail"); // add class trDetail for element tr 
            var tdDetail = document.createElement("td"); // create element td for detail tr
            $(tdDetail).attr("colspan",tdCount); // add element coolspan at td
            $(tdDetail).html("<span class=\'fa fa-spinner fa-spin\'></span>"); // loader kaka.. <img src="http://www.hafidmukhlasin.com/wp-includes/images/smilies/icon_smile.gif" alt=":)" class="wp-smiley"> 
             
            // get content via ajax
            $.get("'.\yii\helpers\Url::to(['renjakegiatanforum/detail']).'&id="+person_id, function( data ) {
              $(tdDetail).html( data );
            }).fail(function() {
                alert( "Terjadi Kesalahan Coba refresh halaman ini." );
              });
            $(trDetail).append(tdDetail); // add td to tr
            $(tr).after(trDetail);  // add tr to table
        }
     
', \yii\web\View::POS_HEAD) ?>
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