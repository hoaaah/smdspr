<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use kartik\detail\DetailView;
use yii\data\SqlDataProvider;
use yii\widgets\Pjax;
use backend\assets\UsulanAsset;
use yii\bootstrap\Modal;
use kartik\widgets\SwitchInput;
$image = backend\assets\UsulanAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\musrenbangdesa\models\SubkegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Renja: '.$model->uraian;
$this->params['breadcrumbs'][] = ['label' => 'Musrenbang RKPD', 'url' => ['musrenbangrkpd/']];
$this->params['breadcrumbs'][] = 'RKPD Program';
//$this->params['breadcrumbs'][] = 'Nama_Program left 20 Link';
$this->params['breadcrumbs'][] = 'Renja Program';
$this->params['breadcrumbs'][] = ['label' => strlen($model->program->uraian) >= 21 ? substr($model->program->uraian, 0, 21).'...' : $model->program->uraian, 'url' => ['musrenbangrkpd/renjaprogramview', 'id' => $model->program->id]];
$this->params['breadcrumbs'][] = 'Renja Kegiatan';
$this->params['breadcrumbs'][] = $model->uraian;
?>

<!-- Detail Program -->
<?php
echo DetailView::widget([
	'id' => 'program',
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'enableEditMode' => true,
    'hideIfEmpty' => false, //sembunyikan row ketika kosong
    'panel'=>[
        'heading'=>'<i class="fa fa-tag"></i> Rincian Kegiatan</h3>',
        'type'=>'danger',
        'headingOptions' => [
        	'tag' => 'h3', //tag untuk heading
        ],
    ],
    'buttons1' => $jadwal == true ? '{update}' : '', // tombol mode default, default '{update} {delete}'
    'buttons2' => '{save} {view}', // tombol mode kedua, default '{view} {reset} {save}'
    'viewOptions' => [
    	'label' => '<span class="glyphicon glyphicon-remove-circle"></span>',
    ],
    'attributes'=>[
        [                      
            'label' => 'Kegiatan',
            'format' => 'ntext',
            'attribute' => 'uraian'
        ],
        [                      
            'label' => 'Pagu Kegiatan Renja',
            'format' => 'decimal',
            'attribute' => 'pagu_kegiatan',
            //'type'=>DetailView::INPUT_MONEY
        ],
        [                      
            'label' => 'SKPD Pelaksana',
            'format' => 'ntext',
            'value' => $model->subunit->Nm_Sub_Unit,
            //'type'=>DetailView::INPUT_MONEY
        ],
    ]
]);	
?>

<div class="box box-success color-palette-box">
	<div class="box-header with-border">
	  <h3 class="box-title"><i class="fa fa-tag"></i> Indikator/Capaian Kegiatan</h3>
	</div>
	<div class="box-body">
		<div class = "row">
		<?php $i=1; foreach($capaian as $capaian): ?>
			<div class = "col-sm-6">
				<?php
					echo DetailView::widget([
						'id' => 'capaian'.$i,
					    'model'=>$capaian,
					    'condensed'=>true,
					    'hover'=>true,
					    'mode'=>DetailView::MODE_VIEW,
					    'enableEditMode' => true,
					    'hideIfEmpty' => true, //sembunyikan row ketika kosong
					    'panel'=>[
					        'heading'=>'<i class="fa fa-line-chart"></i> Indikator/Capaian '.$capaian->no_indikator.'</h3>',
					        'type'=>'default',
					        'headingOptions' => [
					        	'tag' => 'h3', //tag untuk heading
					        ],
					    ],
					    'buttons1' => $jadwal == true ? '{update}' : '', // tombol mode default, default '{update} {delete}'
					    'buttons2' => '{save} {view}', // tombol mode kedua, default '{view} {reset} {save}'
					    'viewOptions' => [
					    	'label' => '<span class="glyphicon glyphicon-remove-circle"></span>',
					    ],
					    'attributes'=>[
					        [                      
					            'label' => 'No Indikator',
					            //'displayOnly' => true,
					            'attribute' => 'no_indikator'
					        ],
					        [                      
					            'label' => 'Capaian',
					            'format' => 'ntext',
					            'attribute' => 'uraian'
					        ],
					        [                      
					            'label' => 'Target Angka',
					            //'format' => 'decimal',
					            'attribute' => 'target_angka',
					            'value' => $capaian->target_angka.' '.$capaian->target_uraian,
					            //'type'=>DetailView::INPUT_MONEY
					        ],
					        [
					        	'label' => 'Jenis Indikator',
					        	'format' => 'ntext',
					        	'displayOnly' => true,
					        	'attribute' => 'kd_indikator_3',
					        	'value' => $capaian->kdIndikator1->jn_indikator,
					        ],
					        [                      
					            'label' => 'Tolok Ukur - Indikator',
					            'format' => 'ntext',
					            'displayOnly' => true,
					            //'attribute' => 'target_angka',
					            //'type'=>DetailView::INPUT_MONEY
					            'value' => $capaian->tolok_ukur.' - '.$capaian->kdIndikator2->jn_indikator.' '.$capaian->kdIndikator3->jn_indikator
					        ],
					    ]
					]);		
				?>
			</div> <!--col6-->
		<?php $i++; endforeach;?>
		</div><!--row-->				
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-tasks"></i> Daftar Aktivitas Usulan</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  
					<?php $form = ActiveForm::begin([
					    'action' => ['renjakegiatanview', 'id' => $model->id],
					    'method' => 'get',
					]); 
//<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
//<div class="input-group-btn">
//<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
//</div>
					?>
					<?php echo $form->field($filter, 'input_status')->dropDownList(
						['1'=>'Hanya Diterima', '2'=>'Tampil Semua'], 
						['prompt'=>'Tampil Usulan','onchange'=>'this.form.submit()', 'class' => 'form-control pull-right input-sm']
					)->label(false);?>		
					<?php ActiveForm::end(); ?>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
				<?php Pjax::begin(['id'=>'pjax-subkegiatan-gridview']); ?>  
				<div class = "col-md-12">
					<?php echo  GridView::widget([
					        'dataProvider' => $dataProvider,
					        //'filterModel' => $searchModel,
					        'export' => false, 
					        'responsive'=>true,
					        'hover'=>true,
					        //'panel'=>['type'=>'primary', 'heading'=>'Daftar Kegiatan Rencana Kerja 2017'],                        
					        'summary' => "<small>Menampilkan <b>{begin} - {end}</b> dari <b>{totalCount}</b> Usulan</small>",
					        'emptyText' => '<small><i>Tidak ada Usulan sampai saat ini.</i></small>',                        
					        'columns' => [
					            ['class' => 'kartik\grid\SerialColumn'],
					            [
					                'label' => 'Aktivitas Usulan',
					                'attribute' => 'aktivitas_usulan',
					            ],
					            [
					                'label' => 'Lokasi',
					                'value'=> function($model){
					                    return $model['kecamatan'].'-'.$model['desa'];
					                }
					            ],
					            [
					                'label' => '-',
					                'format' => 'raw',
					                'value'=> function($model){
					                    return 'Awal/Forum SKPD<br /><hr />Current';
					                }
					                
					            ],                           
					            [
					                'label' => 'Aktivitas Usulan',
					                'format' => 'raw',
					                'value'=> function($model){
					                    return number_format($model['biaya_awal'], 0, ',' ,'.').'<br /><hr />'.number_format($model['biaya'], 0, ',' ,'.');
					                }
					                
					            ],
					            [
					                'label' => 'Aksi',
					                'format' => 'raw',
					                'value'=> function($model, $jadwal){
					                    IF($jadwal){
						                    if($model['input_status'] == 1){
	                                            return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model->id.');return false;']).' '.
	                                                Html::a('Terima', ['terima', 'id' => $model->id], ['class' => 'btn btn-xs btn-success','data' => ['confirm' => 'Yakin menerima usulan ini?','method' => 'post',],]).' '.
	                                                Html::a('Tolak', ['infotolak', 'id' => $model->id], ['class' => 'btn btn-xs btn-danger',/*'data' => ['confirm' => 'Yakin menolak usulan ini?','method' => 'post',],*/'data-toggle'=>"modal",
	                                                        'data-target'=>"#myModal",
	                                                        'data-title'=>"Tolak Usulan ".$model->uraian,]).' '.
	                                                Html::a('Tangguhkan', ['tangguh', 'id' => $model->id], ['class' => 'btn btn-xs btn-warning','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]);
	                                        }ELSEIF($model['input_status'] == 4){
	                                            return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model->id.');return false;']).' '.
	                                                Html::a('Terima', ['terima', 'id' => $model->id], ['class' => 'btn btn-xs btn-success','data' => ['confirm' => 'Yakin menerima usulan ini?','method' => 'post',],]).' '.
	                                                Html::a('Tolak', ['infotolak', 'id' => $model->id], ['class' => 'btn btn-xs btn-danger',/*'data' => ['confirm' => 'Yakin menolak usulan ini?','method' => 'post',],*/'data-toggle'=>"modal",
	                                                        'data-target'=>"#myModal",
	                                                        'data-title'=>"Tolak Usulan ".$model->uraian,]);
	                                        }ELSE{
	                                            return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model['id'].');return false;']).' '.
	                                            Html::a('Draftkan', ['draft', 'id' => $model['id']], ['class' => 'btn btn-xs btn-primary','data' => ['confirm' => 'Yakin kembalikan ke draft?','method' => 'post',],]);
	                                        }
					                    }ELSE{
					                    	return Html::a('<button type="button" class="btn btn-xs btn-default">+++</button>', '#',['onclick'=>'detail(this,'.$model['id'].');return false;']);
					                    }
					                }
					                
					            ],                        
					            //['class' => 'yii\grid\ActionColumn'],
					        ],
					    ]); ?>         
				</div>       
				<?php Pjax::end(); ?>         
				<?php /*
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Reason</th>
                </tr>
                <tr>
                  <td>183</td>
                  <td>John Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-success">Approved</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
                <tr>
                  <td>219</td>
                  <td>Alexander Pierce</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-warning">Pending</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
                <tr>
                  <td>657</td>
                  <td>Bob Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-primary">Approved</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
                <tr>
                  <td>175</td>
                  <td>Mike Doe</td>
                  <td>11-7-2014</td>
                  <td><span class="label label-danger">Denied</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
              </table>
              */?>				   
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>


<?php 
$this->registerJs('
        function kegiatan(obj,person_id){
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
            $.get("'.\yii\helpers\Url::to(['musrenbangrkpd/kegiatan']).'&id="+person_id, function( data ) {
              $(tdDetail).html( data );
            }).fail(function() {
                alert( "Terjadi Kesalahan Coba refresh halaman ini." );
              });
            $(trDetail).append(tdDetail); // add td to tr
            $(tr).after(trDetail);  // add tr to table
        }
     
', \yii\web\View::POS_HEAD) ?>
<?php 
$this->registerJs('
        function subkegiatan(obj,person_id){
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
            $.get("'.\yii\helpers\Url::to(['musrenbangrkpd/subkegiatan']).'&id="+person_id, function( data ) {
              $(tdDetail).html( data );
            }).fail(function() {
                alert( "Terjadi Kesalahan Coba refresh halaman ini." );
              });
            $(trDetail).append(tdDetail); // add td to tr
            $(tr).after(trDetail);  // add tr to table
        }
     
', \yii\web\View::POS_HEAD) ?>
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
            $(tdDetail).html("<span class=\'fa fa-spinner fa-spin\'></span>"); // loader kaka..
             
            // get content via ajax
            $.get("'.\yii\helpers\Url::to(['detail']).'&id="+person_id, function( data ) {
              $(tdDetail).html( data );
            }).fail(function() {
                alert( "Terjadi Kesalahan Coba refresh halaman ini." );
              });
            $(trDetail).append(tdDetail); // add td to tr
            $(tr).after(trDetail);  // add tr to table
        }
     
', \yii\web\View::POS_HEAD) ?>