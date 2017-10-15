<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\editable\Editable;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode('User '.$model->username) ?></h1>

    <p>
        <?php IF(!Yii::$app->user->identity->tperan) echo Html::a('Tambah SKPD dan Lokasi', ['tperan/create'], ['class' => 'btn btn-success']); ?>
        <?= Html::a('Ubah Password', ['ubahpwd'], [
                                                    'class' => 'btn btn-xs btn-danger',
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#myModal",
                                                    'data-title'=>"Ubah Password",
                                                    ]) ?>        
    </p>
	<div class="col-lg-12">
		<?php if(Yii::$app->session->hasFlash('consol_v_error')): ?>
			<div class="alert alert-danger" role="alert">
				<?= Yii::$app->session->getFlash('consol_v_error') ?>
			</div>
		<?php endif; ?>
	</div>	
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            //'status',
            //'updated_at', 
            [   'attribute'=>'Jenis User',
                'value'=> $model->group->name,
            ],           
			[	'attribute'=>'Peran',
				'value'=> $model->peran->name,
			],
            //'kd_pemda',
            [   'attribute'=>'nama',
                            'format'=>'raw',
                            'value' => Editable::widget([
                                        'model' => $model, 
                                        'attribute' => 'nama',
                                        'asPopover' => TRUE,
                                        'type' => 'primary',
                                        'size'=> 'md',// lg large md medium sm small
                                        'inputType' => Editable::INPUT_TEXT,
                                        //'editableValueOptions' => ['class' => 'text-success h3']
                                    ])
            ], 
            [   'attribute'=>'alamat',
                            'format'=>'raw',
                            'value' => Editable::widget([
                                        'model' => $model, 
                                        'attribute' => 'alamat',
                                        'asPopover' => TRUE,
                                        'type' => 'primary',
                                        'size'=> 'md',// lg large md medium sm small
                                        'inputType' => Editable::INPUT_TEXTAREA,
                                        //'editableValueOptions' => ['class' => 'text-success h3']
                                    ])
            ],
            [   'attribute'=>'contact',
                            'format'=>'raw',
                            'value' => Editable::widget([
                                        'model' => $model, 
                                        'attribute' => 'contact',
                                        'asPopover' => TRUE,
                                        'type' => 'primary',
                                        'size'=> 'md',// lg large md medium sm small
                                        'inputType' => Editable::INPUT_TEXT,
                                        //'editableValueOptions' => ['class' => 'text-success h3']
                                    ])
            ], 
            [   'attribute'=>'jabatan',
                            'format'=>'raw',
                            'value' => Editable::widget([
                                        'model' => $model, 
                                        'attribute' => 'jabatan',
                                        'asPopover' => TRUE,
                                        'type' => 'primary',
                                        'size'=> 'md',// lg large md medium sm small
                                        'inputType' => Editable::INPUT_TEXT,
                                        //'editableValueOptions' => ['class' => 'text-success h3']
                                    ])
            ],	          	
        ],
    ]) ?>

<?php IF(Yii::$app->user->identity->tperan['kd_sub'] <> NULL || Yii::$app->user->identity->tperan['kd_kecamatan'] <> NULL): ?>    
    <h1><?= 'Data Peran '.Html::encode('User '.$model->username) ?></h1>

    <p>
        <?php // echo Html::a('Ubah Data Lokasi', ['tperan/update', 'id'=>$modelPeran->id], ['class' => 'btn btn-success']) ?>
    </p>    
    <?= DetailView::widget([
        'model' => $modelPeran,
        'attributes' => [
/*          'user_id',
            'kd_urusan',
            'kd_bidang',
            'kd_unit',
            'kd_sub',
 */ 
            [   'label'=>'Peran',
                'value'=> $modelPeran->kd_sub ? 'SKPD '.$modelPeran->sub->Nm_Sub_Unit : 'Kecamatan/Kelurahan '.$modelPeran->kecamatan->kecamatan,
            ],                          
        ],
    ]) ?>    

</div>
<?php endif;?>
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