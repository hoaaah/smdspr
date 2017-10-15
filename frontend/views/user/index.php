<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\editable\Editable;

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

<?php IF(isset(Yii::$app->user->identity->tperan)): ?>    
    <h1><?= 'Data Lokasi '.Html::encode('User '.$model->username) ?></h1>

    <p>
        <?php // echo Html::a('Ubah Data Lokasi', ['tperan/update', 'id'=>$modelPeran->id], ['class' => 'btn btn-success']) ?>
    </p>    
    <?= DetailView::widget([
        'model' => $modelPeran,
        'attributes' => [
/*            'user_id',
            'kd_urusan',
            'kd_bidang',
            'kd_unit',
            'kd_sub',
 */ 
            [   'attribute'=>'Kecamatan',
                'value'=> $modelPeran->kecamatan->kecamatan,
            ],   
            [   'attribute'=>'Kelurahan/Desa',
                'value'=> isset($modelPeran->kelurahan->desa) ? $modelPeran->kelurahan->desa : '',
            ],                     
            'rw',
            'rt',     
        ],
    ]) ?>    

</div>
<?php endif;?>
