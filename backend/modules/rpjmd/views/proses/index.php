<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rpjmd\models\TaPeriodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
function rkpd($tahun){
    $rkpd = \common\models\RkpdProgram::find()->where(['tahun' => $tahun])->count();
    return $rkpd;
}

$this->title = 'Proses Data RPJMD ke RKPD';
$this->params['breadcrumbs'][] = 'RPJMD';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-periode-index">
<?php Pjax::begin(); ?>    <?= GridView::widget([
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
        'columns' => [
            [
                'label' => 'Periode',
                'width' => '10%',
                'value' => function($model){
                    return $model->Tahun1.' - '.$model->Tahun5;
                }
            ],
            [
                'label' => 'Data Tahun 1',
                'format' => 'raw',
                'width' => '15%',
                'value' => function($model){
                    IF(rkpd($model->Tahun1) == 0){
                        return Html::a('<span class="glyphicon glyphicon-ok"></span> Proses '.$model->Tahun1, ['proses', 'kd' => 1, 'periode' => $model->ID_Tahun, 'n' => 1],
                            [
                                'class' => 'btn-success btn-xs',
                                'title' => Yii::t('yii', 'Proses'),
                                 
                                'data-confirm' => "Yakin proses data RPJMD?",
                                'data-method' => 'POST',
                                'data-pjax' => 1
                            ]);                        
                    }ELSE{
                         return Html::a('<span class="glyphicon glyphicon-remove"></span> Hapus '.$model->Tahun1, ['proses', 'kd' => 0, 'periode' => $model->ID_Tahun, 'n' => 1],
                            [
                                'class' => 'btn-danger btn-xs',
                                'title' => Yii::t('yii', 'Proses'),
                                 
                                'data-confirm' => "Yakin proses ulang? Ini akan menghapus seluruh data dan perubahan yang telah dibuat di RKPD",
                                'data-method' => 'POST',
                                'data-pjax' => 1
                            ]).' '.rkpd($model->Tahun1).' Program';                        
                    }

                }
            ],
            [
                'label' => 'Data Tahun 2',
                'format' => 'raw',
                'width' => '15%',
                'value' => function($model){
                    IF(rkpd($model->Tahun2) == 0){
                        return Html::a('<span class="glyphicon glyphicon-ok"></span> Proses '.$model->Tahun2, ['proses', 'kd' => 1, 'periode' => $model->ID_Tahun, 'n' => 2],
                            [
                                'class' => 'btn-success btn-xs',
                                'title' => Yii::t('yii', 'Proses'),
                                 
                                'data-confirm' => "Yakin proses data RPJMD?",
                                'data-method' => 'POST',
                                'data-pjax' => 1
                            ]);                        
                    }ELSE{
                         return Html::a('<span class="glyphicon glyphicon-remove"></span> Hapus '.$model->Tahun2, ['proses', 'kd' => 0, 'periode' => $model->ID_Tahun, 'n' => 2],
                            [
                                'class' => 'btn-danger btn-xs',
                                'title' => Yii::t('yii', 'Proses'),
                                 
                                'data-confirm' => "Yakin proses ulang? Ini akan menghapus seluruh data dan perubahan yang telah dibuat di RKPD",
                                'data-method' => 'POST',
                                'data-pjax' => 1
                            ]).' '.rkpd($model->Tahun2).' Program';                        
                    }

                }
            ],
            [
                'label' => 'Data Tahun 3',
                'format' => 'raw',
                'width' => '15%',
                'value' => function($model){
                    IF(rkpd($model->Tahun3) == 0){
                        return Html::a('<span class="glyphicon glyphicon-ok"></span> Proses '.$model->Tahun3, ['proses', 'kd' => 1, 'periode' => $model->ID_Tahun, 'n' => 3],
                            [
                                'class' => 'btn-success btn-xs',
                                'title' => Yii::t('yii', 'Proses'),
                                 
                                'data-confirm' => "Yakin proses data RPJMD?",
                                'data-method' => 'POST',
                                'data-pjax' => 1
                            ]);                        
                    }ELSE{
                         return Html::a('<span class="glyphicon glyphicon-remove"></span> Hapus '.$model->Tahun3, ['proses', 'kd' => 0, 'periode' => $model->ID_Tahun, 'n' => 3],
                            [
                                'class' => 'btn-danger btn-xs',
                                'title' => Yii::t('yii', 'Proses'),
                                 
                                'data-confirm' => "Yakin proses ulang? Ini akan menghapus seluruh data dan perubahan yang telah dibuat di RKPD",
                                'data-method' => 'POST',
                                'data-pjax' => 1
                            ]).' '.rkpd($model->Tahun3).' Program';                        
                    }

                }
            ],
            [
                'label' => 'Data Tahun 4',
                'format' => 'raw',
                'width' => '15%',
                'value' => function($model){
                    IF(rkpd($model->Tahun4) == 0){
                        return Html::a('<span class="glyphicon glyphicon-ok"></span> Proses '.$model->Tahun4, ['proses', 'kd' => 1, 'periode' => $model->ID_Tahun, 'n' => 4],
                            [
                                'class' => 'btn-success btn-xs',
                                'title' => Yii::t('yii', 'Proses'),
                                 
                                'data-confirm' => "Yakin proses data RPJMD?",
                                'data-method' => 'POST',
                                'data-pjax' => 1
                            ]);                        
                    }ELSE{
                         return Html::a('<span class="glyphicon glyphicon-remove"></span> Hapus '.$model->Tahun4, ['proses', 'kd' => 0, 'periode' => $model->ID_Tahun, 'n' => 4],
                            [
                                'class' => 'btn-danger btn-xs',
                                'title' => Yii::t('yii', 'Proses'),
                                 
                                'data-confirm' => "Yakin proses ulang? Ini akan menghapus seluruh data dan perubahan yang telah dibuat di RKPD",
                                'data-method' => 'POST',
                                'data-pjax' => 1
                            ]).' '.rkpd($model->Tahun4).' Program';                        
                    }

                }
            ],
            [
                'label' => 'Data Tahun 5',
                'format' => 'raw',
                'width' => '15%',
                'value' => function($model){
                    IF(rkpd($model->Tahun5) == 0){
                        return Html::a('<span class="glyphicon glyphicon-ok"></span> Proses '.$model->Tahun5, ['proses', 'kd' => 1, 'periode' => $model->ID_Tahun, 'n' => 5],
                            [
                                'class' => 'btn-success btn-xs',
                                'title' => Yii::t('yii', 'Proses'),
                                 
                                'data-confirm' => "Yakin proses data RPJMD?",
                                'data-method' => 'POST',
                                'data-pjax' => 1
                            ]);                        
                    }ELSE{
                         return Html::a('<span class="glyphicon glyphicon-remove"></span> Hapus '.$model->Tahun5, ['proses', 'kd' => 0, 'periode' => $model->ID_Tahun, 'n' => 5],
                            [
                                'class' => 'btn-danger btn-xs',
                                'title' => Yii::t('yii', 'Proses'),
                                 
                                'data-confirm' => "Yakin proses ulang? Ini akan menghapus seluruh data dan perubahan yang telah dibuat di RKPD",
                                'data-method' => 'POST',
                                'data-pjax' => 1
                            ]).' '.rkpd($model->Tahun5).' Program';                        
                    }

                }
            ],                                                        
            // 'Aktive',
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
