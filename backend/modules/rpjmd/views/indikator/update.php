<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaIndikatorRPJMD */

$this->title = 'Indikator: ' . $model->Tolak_Ukur;
$this->params['breadcrumbs'][] = ['label' => 'RPJMD', 'url' => ['/rpjmd/rpjmdprogram']];
$this->params['breadcrumbs'][] = 'Ubah '.$this->title;
?>
<div class="ta-indikator-rpjmd-update">
<div class="row">
	<div class="well col-md-6">
	<?= \yii\widgets\DetailView::widget([
	        'model' => $model,
	        'attributes' => [
	        	[
	        		'label' => 'Kode Indikator',
	        		'value' => $model->No_Misi.'.'.$model->No_Tujuan.'.'.$model->No_Sasaran.'.'.$model->Kd_Prog.'.'.$model->Id_Prog.'.'.$model->No_ind_Prog,
	        	],
	            'Jn_Indikator',
	            'Jn_Indikator2',
	            'Tolak_Ukur',
	            'Target_Uraian',
	            'Kondisi_Kinerja_Awal',
	            'NilaiTahun1',
	            'NilaiTahun2',
	            'NilaiTahun3',
	            'NilaiTahun4',
	            'NilaiTahun5',
	            'Kondisi_Kinerja_akhir',
	            'Satuan',
	        ],
	    ]) ?>
	</div>
	<div class="well col-md-6">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
</div>
