<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use ramzyvirani\lightbox\Lightbox;
use yii\helpers\Url;

?>
    <div class="col-xs-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                Info Kegiatan                    
            </div>
            <div class="panel-body">          
                <div class="table-responsive">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'Kegiatan',
                            'format' => 'raw',
                            'value' => wordwrap(Html::encode($model->renjaKegiatan->uraian), 45, "</br>"),
                        ],  
                        [
                            'attribute' => 'Info untuk Usulan',
                            'format' => 'raw',
                            'value' => wordwrap(Html::encode($model->renjaKegiatan->info_asb), 45, "</br>"),
                        ],                                               
                    ],
                ]) ?>
                </div>
            </div>
                <?php IF($model->input_status == 3) : ?>
                <div class="col-xs-12">
                    <div class="alert alert-danger alert-dismissible">
                        <h4>
                            <i class="icon fa fa-ban"></i>
                            Usulan ini sudah ditolak
                        </h4>
                    <?php echo wordwrap('<strong>'.Html::encode($status->alasan_tolak).'</strong>', 80, "</br>"); ?> 
                    </div>
                </div>      
                <?php endif; ?>                  
                 <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'uraian',
                        'rt',
                        'volume',
                        'satuan',
                        [
                            'attribute' => 'harga_satuan',
                            'value' => "Rp ".number_format($model->harga_satuan,0,",",".")
                        ],
                        [
                            'attribute' => 'biaya',
                            'value' => "Rp ".number_format($model->biaya,0,",",".")
                        ],
                        'keterangan:ntext',
                    ],
                ]) ?> 
        </div>
    </div>
    <div class="col-xs-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                Photo Usulan
            </div>
            <div class="panel-body">
                <?php 
                foreach($photo as $photo):?>
                    <div class="col-xs-6">
                        <?php // echo Html::img($image->baseUrl.'/'.$photo->file, ['class' => 'pull-left img-responsive']); ?>
                        <?php
                            
                            echo Lightbox::widget([
                                'files' => [
                                    [
                                        'thumb' => [
                                                'src' => Url::to(['/musrenrw/subkegiatan/image', 'filename' => $photo->file], true),
                                                // 'src' => $image->baseUrl.'/'.$photo->file,
                                                'htmlOptions' => ['class' => 'pull-left img-responsive']
                                        ],
                                        'original' => Url::to(['/musrenrw/subkegiatan/image', 'filename' => $photo->file], true),
                                        'title' => $photo->caption,
                                    ],
                                ]
                            ]);
 /*                           
echo Lightbox::widget([
    'files' => [
        [
            'thumb' => [
                'src'=>$image->baseUrl.'/'.$photo->file,
                'htmlOptions' => ['class'=>'col-md-6', 'alt'=>'Alternate Text'] // These options will be applied to Image tag.
            ],
            'original' => [
                'src' => $image->baseUrl.'/'.$photo->file,
            ],
            'title' => $photo->caption,
        ],
    ]
]);     */                      
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>         
        </div>
    </div>
    <?php IF($historis <> NULL) : ?>
    <div class="col-xs-6">
        <div class="alert alert-danger alert-dismissible">
            <h4>
                <i class="icon fa fa-ban"></i>
                Usulan ini sudah diubah
            </h4>
        <?php
        foreach($historis AS $historis){
          echo wordwrap('<strong>'.Html::encode($historis->alasan_perubahan).'</strong>', 80, "</br>");            
        }
        ?>

        </div>
    </div>      
    <?php endif; ?>      