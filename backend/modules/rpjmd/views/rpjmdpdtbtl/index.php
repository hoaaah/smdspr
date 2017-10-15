<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rpjmd\models\TaMisiRPJMDSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pendapatan dan BTL';
$this->params['breadcrumbs'][] = 'RPJMD';
$this->params['breadcrumbs'][] = $this->title;
$tahun = DATE('Y')+1;
IF(Yii::$app->session->get('tahun') && $tahun = Yii::$app->session->get('tahun'));
?>
<div class="ta-misi-rpjmd-index">
    <p>
        <?php 
        IF($jadwal){
            IF($dataProvider->totalCount == 0){
                echo Html::a('Tambah Pendapatan dan BTL TA '.$tahun, ['create'], [
                                                        'class' => 'btn btn-xs btn-success',
                                                        'data' => [
                                                            'confirm' => "Membuat data Pendapantan dan BTL?",
                                                            'method' => 'post',
                                                        ],
                                                        ]); 
            }ELSE{
                echo Html::a('Hapus Pendapatan dan BTL TA '.$tahun, ['delete'], [
                                                        'class' => 'btn btn-xs btn-danger',
                                                        'data' => [
                                                            'confirm' => "Menghapus data Pendapantan dan BTL?",
                                                            'method' => 'post',
                                                        ],
                                                        ]); 
            }
        }
        ?>
    </p>   
<?= GridView::widget([
        'id' => 'Misi-Grid',        
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,     
        'panel'=>['type'=>'primary', 'heading'=>$this->title],
        'toolbar' => [
            [
                //'content' => $this->render('_search', ['model' => $searchModel]),
            ],
        ],
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],         
        'pjax'=>true,
        'pjaxSettings'=>[
            'options' => ['id' => 'program-pjax', 'timeout' => 5000],
        ],
        'columns' => [
            //['class' => 'kartik\grid\SerialColumn'],
            //beri expand_row untuk pelaksana program rpjmd
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {

                    return GridView::ROW_COLLAPSED;
                },
                'width' => '30px',
                'expandOneOnly' => true,
                'expandIcon' => '<span class="glyphicon glyphicon-menu-right"></span>',
                'expandTitle' => 'Pelaksana Program',
                'collapseIcon' => '<span class="glyphicon glyphicon-menu-down"></span>',
                'collapseTitle' => 'Tutup',
                //'allowBatchToggle'=>true,
                'detail'=>function ($model, $key, $index, $column) {
                    $searchModel = new \backend\modules\rpjmd\models\TaPelaksanaProgRPJMDSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->where([
                            'ID_Tahun' => $model->ID_Tahun,
                            'Kd_Prov' => $model->Kd_Prov,
                            'Kd_Kab_Kota' => $model->Kd_Kab_Kota,
                            'Kd_Perubahan' => $model->Kd_Perubahan,
                            'Kd_Dokumen' => $model->Kd_Dokumen,
                            'Kd_Usulan' => $model->Kd_Usulan,
                            'No_Misi' => $model->No_Misi,
                            'No_Tujuan' => $model->No_Tujuan,
                            'No_Sasaran' => $model->No_Sasaran,
                            'Kd_Prog' => $model->Kd_Prog,
                            'Id_Prog' => $model->Id_Prog
                        ]);
                    $dataProvider->pagination->pageParam = 'pelaksana-page';
                    $dataProvider->sort->sortParam = 'pelaksana-sort';                    
                    
                    return Yii::$app->controller->renderPartial('_pelaksana', [
                        'model'=>$model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        ]);
                },
                'detailRowCssClass' => GridView::TYPE_INFO,
                'detailOptions'=>[
                    'id' => 'pelaksana-row',
                    'class'=> 'kv-state-enable',
                ],

            ],
            //beri expand_row untuk capaian program
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {

                    return GridView::ROW_COLLAPSED;
                },
                'width' => '30px',
                'expandOneOnly' => true,
                'expandIcon' => '<span class="glyphicon glyphicon-stats"></span>',
                'expandTitle' => 'Indikator',
                'collapseIcon' => '<span class="glyphicon glyphicon-equalizer"></span>',
                'collapseTitle' => 'Tutup',
                //'allowBatchToggle'=>true,
                'detail'=>function ($model, $key, $index, $column) {
                    $searchModel = new \backend\modules\rpjmd\models\TaIndikatorRPJMDSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->where([
                            'ID_Tahun' => $model->ID_Tahun,
                            'Kd_Prov' => $model->Kd_Prov,
                            'Kd_Kab_Kota' => $model->Kd_Kab_Kota,
                            'Kd_Perubahan' => $model->Kd_Perubahan,
                            'Kd_Dokumen' => $model->Kd_Dokumen,
                            'Kd_Usulan' => $model->Kd_Usulan,
                            'No_Misi' => $model->No_Misi,
                            'No_Tujuan' => $model->No_Tujuan,
                            'No_Sasaran' => $model->No_Sasaran,
                            'Kd_Prog' => $model->Kd_Prog,
                            'Id_Prog' => $model->Id_Prog
                        ]);
                    
                    return Yii::$app->controller->renderPartial('_indikator', [
                        'model'=>$model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        ]);
                },
                'detailRowCssClass' => GridView::TYPE_DANGER,
                'detailOptions'=>[
                    'id' => 'indikator-row',
                    'class'=> 'kv-state-enable',
                ],

            ],
            [
                'label' => 'Kode Program',
                'value' => function ($model){
                    return $model->No_Misi.'.'.$model->No_Tujuan.'.'.$model->No_Sasaran.'.'.$model->Kd_Prog;
                    //link untuk menguba dan mengisi capaian disini
                }
            ],
            'Ket_Program',
            'taPaguProgRPJMD.PaguTahun1:decimal',
            'taPaguProgRPJMD.PaguTahun2:decimal',
            'taPaguProgRPJMD.PaguTahun3:decimal',
            'taPaguProgRPJMD.PaguTahun4:decimal',
            'taPaguProgRPJMD.PaguTahun5:decimal',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update}',//{view}{update}{delete}
                //'controller' => 'indikator',
                'buttons' =>[
                        'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'ubah'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModalubah",
                                 'data-title'=> "Ubah Program",                                 
                                 // 'data-confirm' => "Yakin menghapus sasaran ini?",
                                 // 'data-method' => 'POST',
                                 // 'data-pjax' => 1
                              ]);
                        },                       
                ],                              
            ],
        ],
    ]); ?>
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
<?php 
    Modal::begin([
        'id' => 'myModalPelaksana',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalPelaksana').on('show.bs.modal', function (event) {
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
<?php 
    Modal::begin([
        'id' => 'myModalIndikator',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalIndikator').on('show.bs.modal', function (event) {
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
<?php 
    Modal::begin([
        'id' => 'myModalubah',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalubah').on('show.bs.modal', function (event) {
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
<?php 
    Modal::begin([
        'id' => 'myModalPelaksanaubah',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalPelaksanaubah').on('show.bs.modal', function (event) {
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
<?php 
    Modal::begin([
        'id' => 'myModalIndikatorubah',
        'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

$this->registerJs("
    $('#myModalIndikatorubah').on('show.bs.modal', function (event) {
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