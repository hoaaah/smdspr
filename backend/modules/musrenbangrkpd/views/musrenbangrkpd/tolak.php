<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
?>

        <div class="panel panel-danger">
            <div class="panel-heading">
                <strong><i class="fa fa-exclamation" ></i> Anda akan menolak usulan berikut. Status tidak dapat dikembalikan lagi setelah anda tolak.</strong> 
            </div>
            <div class="panel-body">

                <div class="table-responsive">
                <?= DetailView::widget([
                    'model' => $subkegiatan,
                    'attributes' => [
                        'renjaKegiatan.uraian',
                        'uraian',
                        'keterangan',
                        [
                            'attribute' => 'biaya',
                            'value' => "Rp ".number_format($subkegiatan->biaya,0,",",".")
                        ],

                    ],
                ]) ?>
                </div>
   <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alasan_tolak')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tolak Usulan' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-sm btn-danger' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>                
            </div>
         
        </div>
