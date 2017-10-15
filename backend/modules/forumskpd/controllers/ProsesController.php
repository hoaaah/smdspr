<?php

namespace backend\modules\forumskpd\controllers;

use Yii;
use backend\modules\forumskpd\models\Proses;
use backend\modules\forumskpd\models\ProsesSearch;
use backend\modules\forumskpd\models\ProsesSearchForum;
use backend\modules\forumskpd\models\SubkegiatanSearch;
use backend\modules\forumskpd\models\SubkegiatanSearchproses;
use backend\modules\forumskpd\models\SubkegiatanSearchprosesforum;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProsesController implements the CRUD actions for Proses model.
 */
class ProsesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'proses' => ['POST']
                ],
            ],
        ];
    }

    /**
     * Lists all Proses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProsesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionForum()
    {
        $searchModel = new ProsesSearchForum();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexforum', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Proses model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Proses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Proses();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->kd_urusan = Yii::$app->user->identity->tperan->kd_urusan;
            $model->kd_bidang = Yii::$app->user->identity->tperan->kd_bidang;
            $model->kd_unit = Yii::$app->user->identity->tperan->kd_unit;
            $model->kd_sub = Yii::$app->user->identity->tperan->kd_sub;
            $model->input_phased = 2;
            $model->user_id = Yii::$app->user->identity->id;
            IF($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateforum()
    {
        $model = new Proses();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->kd_urusan = Yii::$app->user->identity->tperan->kd_urusan;
            $model->kd_bidang = Yii::$app->user->identity->tperan->kd_bidang;
            $model->kd_unit = Yii::$app->user->identity->tperan->kd_unit;
            $model->kd_sub = Yii::$app->user->identity->tperan->kd_sub;
            $model->input_phased = 5;
            $model->user_id = Yii::$app->user->identity->id;
            IF($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Proses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->kd_urusan <> Yii::$app->user->identity->tperan->kd_urusan && 
            $model->kd_bidang <> Yii::$app->user->identity->tperan->kd_bidang  &&
            $model->kd_unit <> Yii::$app->user->identity->tperan->kd_unit  && 
            $model->kd_sub <> Yii::$app->user->identity->tperan->kd_sub ){
            Yii::$app->getSession()->setFlash('danger','Anda tidak memiliki akses untuk mengubah data ini');
            return $this->redirect(['view','id'=>$model->id]);
        }        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionPraproses($id)
    {
        $model = $this->findModel($id);
        if($model->kd_urusan <> Yii::$app->user->identity->tperan->kd_urusan && 
            $model->kd_bidang <> Yii::$app->user->identity->tperan->kd_bidang  &&
            $model->kd_unit <> Yii::$app->user->identity->tperan->kd_unit  && 
            $model->kd_sub <> Yii::$app->user->identity->tperan->kd_sub ){
            Yii::$app->getSession()->setFlash('danger','Anda tidak memiliki akses untuk mengubah data ini');
            return $this->redirect(['view','id'=>$model->id]);
        }
        $searchModel = new SubkegiatanSearchproses();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);     


        return $this->render('praproses', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,                
        ]);
        
    }   

    public function actionPraprosesforum($id)
    {
        $model = $this->findModel($id);
        if($model->kd_urusan <> Yii::$app->user->identity->tperan->kd_urusan && 
            $model->kd_bidang <> Yii::$app->user->identity->tperan->kd_bidang  &&
            $model->kd_unit <> Yii::$app->user->identity->tperan->kd_unit  && 
            $model->kd_sub <> Yii::$app->user->identity->tperan->kd_sub ){
            Yii::$app->getSession()->setFlash('danger','Anda tidak memiliki akses untuk mengubah data ini');
            return $this->redirect(['view','id'=>$model->id]);
        }
        $searchModel = new SubkegiatanSearchprosesforum();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);     


        return $this->render('praprosesforum', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,                
        ]);
        
    }     

    public function actionProses($id)
    {
        $model = $this->findModel($id);
        if($model->kd_urusan <> Yii::$app->user->identity->tperan->kd_urusan && 
            $model->kd_bidang <> Yii::$app->user->identity->tperan->kd_bidang  &&
            $model->kd_unit <> Yii::$app->user->identity->tperan->kd_unit  && 
            $model->kd_sub <> Yii::$app->user->identity->tperan->kd_sub ){
            Yii::$app->getSession()->setFlash('danger','Anda tidak memiliki akses untuk mengubah data ini');
            return $this->redirect(['view','id'=>$model->id]);
        }        
        $connection = \Yii::$app->db;
        $ba = 'insert into t_ba_subkegiatan 
                SELECT '.$id.' as ba_id, a.id, a.tahun, a.renja_kegiatan_id, a.uraian,a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt,  a.lokasi, a.volume, a.satuan, a.harga_satuan, a.biaya, a.keterangan, a.kd_asb, a.input_phased, a.input_status, a.status_phased, UNIX_TIMESTAMP(NOW()) AS created_at, NULL AS updated_at, a.user_id, a.skpd
                FROM t_subkegiatan a INNER JOIN t_renja_kegiatan b ON a.renja_kegiatan_id = b.id WHERE a.input_phased = 2 AND a.status_phased = 2 AND a.input_status = 2 AND b.kd_urusan = '.Yii::$app->user->identity->tperan->kd_urusan.' AND b.kd_bidang = '.Yii::$app->user->identity->tperan->kd_bidang.' AND b.kd_unit= '.Yii::$app->user->identity->tperan->kd_unit.' AND b.kd_sub='.Yii::$app->user->identity->tperan->kd_sub;
        $connection ->createCommand($ba)->execute();
        /*
        $connection ->createCommand()
                    ->update('t_subkegiatan', ['input_status' => 1, 'status_phased' => 5], ['and', 
                        'kd_kecamatan='. Yii::$app->user->identity->tperan->kd_kecamatan, 
                        'input_phased <= 2', 
                        'input_status = 2', 'status_phased = 2'
                        ])
                    ->execute();  
        */
        $connection->createCommand('
                UPDATE t_subkegiatan a
                INNER JOIN t_renja_kegiatan b ON a.renja_kegiatan_id = b.id
                SET a.input_status  = 2,
                  a.status_phased = 5
                WHERE a.input_phased =2 AND a.input_status = 2 AND a.status_phased = 2 AND
                b.kd_urusan = '.Yii::$app->user->identity->tperan->kd_urusan.' AND
                b.kd_bidang = '.Yii::$app->user->identity->tperan->kd_bidang.' AND
                b.kd_unit = '.Yii::$app->user->identity->tperan->kd_unit.' AND
                b.kd_sub = '.Yii::$app->user->identity->tperan->kd_sub
            )->execute();         
        $connection ->createCommand()
                    ->update('t_ba', ['status' => 2], 'id='. $id)
                    ->execute();                   


        Yii::$app->getSession()->setFlash('danger','Berita acara ' .$model->no_ba . 'Telah diproses.');

        return $this->redirect(['index']);
    }     

    public function actionProsesforum($id)
    {
        $model = $this->findModel($id);
        if($model->kd_urusan <> Yii::$app->user->identity->tperan->kd_urusan && 
            $model->kd_bidang <> Yii::$app->user->identity->tperan->kd_bidang  &&
            $model->kd_unit <> Yii::$app->user->identity->tperan->kd_unit  && 
            $model->kd_sub <> Yii::$app->user->identity->tperan->kd_sub ){
            Yii::$app->getSession()->setFlash('danger','Anda tidak memiliki akses untuk mengubah data ini');
            return $this->redirect(['view','id'=>$model->id]);
        }        
        $connection = \Yii::$app->db;
        $ba = 'insert into t_ba_subkegiatan 
                SELECT '.$id.' as ba_id, a.id, a.tahun, a.renja_kegiatan_id, a.uraian,a.kd_kecamatan, a.kd_kelurahan, a.rw, a.rt,  a.lokasi, a.volume, a.satuan, a.harga_satuan, a.biaya, a.keterangan, a.kd_asb, a.input_phased, a.input_status, a.status_phased, UNIX_TIMESTAMP(NOW()) AS created_at, NULL AS updated_at, a.user_id, a.skpd
                FROM t_subkegiatan a INNER JOIN t_renja_kegiatan b ON a.renja_kegiatan_id = b.id WHERE  a.status_phased = 5 AND a.input_status = 2 AND b.kd_urusan = '.Yii::$app->user->identity->tperan->kd_urusan.' AND b.kd_bidang = '.Yii::$app->user->identity->tperan->kd_bidang.' AND b.kd_unit= '.Yii::$app->user->identity->tperan->kd_unit.' AND b.kd_sub='.Yii::$app->user->identity->tperan->kd_sub;
        $connection ->createCommand($ba)->execute();
        /*
        $connection ->createCommand()
                    ->update('t_subkegiatan', ['input_status' => 1, 'status_phased' => 5], ['and', 
                        'kd_kecamatan='. Yii::$app->user->identity->tperan->kd_kecamatan, 
                        'input_phased <= 2', 
                        'input_status = 2', 'status_phased = 2'
                        ])
                    ->execute();  
        */
        $connection->createCommand('
                UPDATE t_subkegiatan a
                INNER JOIN t_renja_kegiatan b ON a.renja_kegiatan_id = b.id
                SET a.input_status  = 1,
                  a.status_phased = 6
                WHERE a.input_status = 2 AND a.status_phased = 5 AND
                b.kd_urusan = '.Yii::$app->user->identity->tperan->kd_urusan.' AND
                b.kd_bidang = '.Yii::$app->user->identity->tperan->kd_bidang.' AND
                b.kd_unit = '.Yii::$app->user->identity->tperan->kd_unit.' AND
                b.kd_sub = '.Yii::$app->user->identity->tperan->kd_sub
            )->execute();         
        $connection ->createCommand()
                    ->update('t_ba', ['status' => 2], 'id='. $id)
                    ->execute();                   


        Yii::$app->getSession()->setFlash('danger','Berita acara ' .$model->no_ba . 'Telah diproses.');

        return $this->redirect(['index']);
    }     

    /**
     * Deletes an existing Proses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->kd_urusan <> Yii::$app->user->identity->tperan->kd_urusan && 
            $model->kd_bidang <> Yii::$app->user->identity->tperan->kd_bidang  &&
            $model->kd_unit <> Yii::$app->user->identity->tperan->kd_unit  && 
            $model->kd_sub <> Yii::$app->user->identity->tperan->kd_sub ){
            Yii::$app->getSession()->setFlash('danger','Anda tidak memiliki akses untuk mengubah data ini');
            return $this->redirect(['view','id'=>$model->id]);
        }      
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Proses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Proses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Proses::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
