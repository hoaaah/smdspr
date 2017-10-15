<?php

namespace frontend\modules\musrenrw\controllers;

use Yii;
use yii\db\Query;
use common\models\Subkegiatan;
use common\models\SubkegiatanPhoto;
use common\models\RenjaKegiatan;
use common\models\TStatus;
use common\models\Historis;
use common\models\Jadwal;
use common\models\Proses;
use frontend\modules\musrenrw\models\SubkegiatanSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * SubkegiatanController implements the CRUD actions for Subkegiatan model.
 */
class SubkegiatanController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['update', 'index', 'view', 'tambah', 'create' ,'delete', 'detail', 'image'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],        
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Subkegiatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(isset(Yii::$app->session['tahun'])){
            $tahun = Yii::$app->session['tahun'];
        }else{
            $tahun = date('Y');
        }
        
        IF(Yii::$app->user->identity->kd_peran <> 6){
            Yii::$app->getSession()->setFlash('danger','Anda tidak memiliki hak akses');
            return Controller::redirect(['/site']);                
        }
                
        $searchModel = new SubkegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['a.tahun' => $tahun]);
        $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => $tahun])->andWhere('input_phased=:input', [':input' => 2])->one();
        $proses = Proses::find()->where('tahun =:tahun', [':tahun' => $tahun])->andWhere('input_phased=:input', [':input' => 2])->andWhere('kd_kelurahan=:kd_kelurahan', [':kd_kelurahan' => Yii::$app->user->identity->tperan->kd_kelurahan])->one();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jadwal' => $jadwal,
            'proses' => $proses,
            'tahun' => $tahun
        ]);
    }

    public function actionImage($filename){
        $storagePath = Yii::getAlias('@common/web/unggah/usulan');
        if (!is_file("$storagePath/$filename")) { // !preg_match('/^[a-z0-9]+\.[a-z0-9]+$/i', $filename) || 
            throw new \yii\web\NotFoundHttpException('The file does not exists.');
        }
        list($name, $extension) = explode('.', $filename);
        Yii::$app->response->sendFile("$storagePath/$filename", $filename, ['mimeType'=> $extension, 'inline'=>true]); 
        return Yii::$app->response->send();
    }
    public function actionDetail($id)
    {
        if(isset(Yii::$app->session['tahun'])){
            $tahun = Yii::$app->session['tahun'];
        }else{
            $tahun = date('Y');
        }
        
        $model = $this->findModel($id);
        $historis = $this->findHistoris($id);
        $status = NULL;
        IF($model->input_status == 3){
            $status = $this->findStatus($id);
        }
        $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => $tahun])->andWhere('input_phased=:input', [':input' => 3])->one();  
        if($model!==null){
            $photo = $this->findPhoto($id);
            return $this->renderAjax('usulanrinci', [
                'model' => $model,
                'photo' => $photo,
                'status' => $status,
                'jadwal' => $jadwal,
                'historis' => $historis,
            ]);           
        } else{
            return "Terjadi kesalahan dengan inputan ini, mungkin kegiatan sudah dihapus. Anda hanya dapat menolak usulan ini.";
        }
    }    

    /**
     * Displays a single Subkegiatan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $kegiatan = $this->findKegiatan($model->renja_kegiatan_id);
        $photo = $this->findUsulan($id);
        return $this->render('view', [
            'model' => $model,
            'kegiatan' => $kegiatan,
            'photo' => $photo,
        ]);
    }

    /**
     * Creates a new Subkegiatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTambah($id)
    {
        $kegiatan = $this->findKegiatan($id);
        $cond = $kegiatan->tahun.'.'.$kegiatan->kd_urusan.'.'.$kegiatan->kd_bidang.'.'.$kegiatan->kd_unit.'.'.$kegiatan->kd_sub.'.'.$kegiatan->id_renprog;
        $program = $this->findProgram($cond);
        $model = new Subkegiatan();
        $photo = new \common\models\SubkegiatanPhoto();
        $connection = \Yii::$app->db; 

        if ($model->load(Yii::$app->request->post())) {
            $model->tahun = $tahun;
            $model->renja_kegiatan_id = $id;
            $model->kd_kecamatan = Yii::$app->user->identity->tperan->kd_kecamatan;
            $model->kd_kelurahan = Yii::$app->user->identity->tperan->kd_kelurahan;
            $model->rw = Yii::$app->user->identity->tperan->rw;
            $model->input_phased = 2;
            $model->status_phased = 2;
            $model->input_status = 1;
            $model->user_id = Yii::$app->user->identity->id;
            $model->save();
            IF(!empty($photo->load(Yii::$app->request->post()))){
                //ambil id usulan untuk photo ----@hoaaah
                $photo->musrenbang_id = $model->id;
                $photo->user_id = Yii::$app->user->identity->id;
                $image1 = UploadedFile::getInstance($photo, 'image1');
                $image2 = UploadedFile::getInstance($photo, 'image2');
                $image3 = UploadedFile::getInstance($photo, 'image3');
                $image4 = UploadedFile::getInstance($photo, 'image4');

                IF($image1){
                    //store file name
                    $name = explode('.', $image1->name);
                    $ext = end($name); //dapatkan ekstensi file untuk persiapan membuat nama file unik
                    $photo->file = Yii::$app->security->generateRandomString().'.'.$ext;
                    $photo->caption = $photo->catatan;
                    $path = Yii::$app->params['uploadPath'].$photo->file;

                    $connection->createCommand()
                        ->insert('t_subkegiatan_photo', [
                                'musrenbang_id' => $photo->musrenbang_id,
                                'file' => $photo->file,
                                'caption' => $photo->caption,
                                'created_at' => time(),
                                'user_id' => $photo->user_id,])
                        ->execute();
                    $image1->saveAs($path);
                }

                IF($image2){
                    //store file name
                    $name = explode('.', $image2->name);
                    $ext = end($name); //dapatkan ekstensi file untuk persiapan membuat nama file unik
                    $photo->file = Yii::$app->security->generateRandomString().'.'.$ext;
                    $photo->caption = $photo->catatan;
                    $path = Yii::$app->params['uploadPath'].$photo->file;

                    $connection->createCommand()
                        ->insert('t_subkegiatan_photo', [
                                'musrenbang_id' => $photo->musrenbang_id,
                                'file' => $photo->file,
                                'caption' => $photo->caption,
                                'created_at' => time(),
                                'user_id' => $photo->user_id,])
                        ->execute();
                    $image2->saveAs($path);
                }                

                IF($image3){
                    //store file name
                    $name = explode('.', $image3->name);
                    $ext = end($name); //dapatkan ekstensi file untuk persiapan membuat nama file unik
                    $photo->file = Yii::$app->security->generateRandomString().'.'.$ext;
                    $photo->caption = $photo->catatan;
                    $path = Yii::$app->params['uploadPath'].$photo->file;

                    $connection->createCommand()
                        ->insert('t_subkegiatan_photo', [
                                'musrenbang_id' => $photo->musrenbang_id,
                                'file' => $photo->file,
                                'caption' => $photo->caption,
                                'created_at' => time(),
                                'user_id' => $photo->user_id,])
                        ->execute();
                    $image3->saveAs($path);
                }

                IF($image4){
                    //store file name
                    $name = explode('.', $image4->name);
                    $ext = end($name); //dapatkan ekstensi file untuk persiapan membuat nama file unik
                    $photo->file = Yii::$app->security->generateRandomString().'.'.$ext;
                    $photo->caption = $photo->catatan;
                    $path = Yii::$app->params['uploadPath'].$photo->file;

                    $connection->createCommand()
                        ->insert('t_subkegiatan_photo', [
                                'musrenbang_id' => $photo->musrenbang_id,
                                'file' => $photo->file,
                                'caption' => $photo->caption,
                                'created_at' => time(),
                                'user_id' => $photo->user_id,])
                        ->execute();
                    $image4->saveAs($path);
                }

                /*
                //store file name
                $name = explode('.', $image->name);
                $ext = end($name); //dapatkan ekstensi file untuk persiapan membuat nama file unik
                $photo->file = Yii::$app->security->generateRandomString().'.'.$ext;
                $path = Yii::$app->params['uploadPath'].$photo->file;

                IF($photo->save()){
                    $image->saveAs($path);
                }
                */           
            }
                      
            //return $this->redirect(['renjaprogram/view', 'id'=>$program->id]);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('tambah', [
                'model' => $model,
                'kegiatan' => $kegiatan,
                'photo' => $photo,
            ]);
        }
    }

    public function actionCreate()
    {
        $model = new Subkegiatan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Subkegiatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $kegiatan = $this->findKegiatan($id);
        $cond = $kegiatan->tahun.'.'.$kegiatan->kd_urusan.'.'.$kegiatan->kd_bidang.'.'.$kegiatan->kd_unit.'.'.$kegiatan->kd_sub.'.'.$kegiatan->id_renprog;
        $program = $this->findProgram($cond);
        $photo = $this->findUsulan($id);        
        $model = $this->findModel($id);
        if($model->user_id <> Yii::$app->user->identity->id){
            Yii::$app->getSession()->setFlash('success','Anda tidak memiliki akses untuk mengubah data ini');
            return $this->redirect(['view','id'=>$model->id]);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'kegiatan' => $kegiatan,
                'photo'=> $photo                
            ]);
        }
    }

    /**
     * Deletes an existing Subkegiatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Subkegiatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subkegiatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subkegiatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findPhoto($id)
    {
        if (($model = SubkegiatanPhoto::find()->where('musrenbang_id='.$id)->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }  

    protected function findKegiatan($id)
    {
        if (($model = RenjaKegiatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findStatus($id)
    {
        if (($model = TStatus::find()->where('id_ref='.$id)->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }  

    protected function findUsulan($id)
    {
        if (($model = SubkegiatanPhoto::find()->where("musrenbang_id=:id", [":id" => $id]  )->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }    

    protected function findProgram($id)
    {
        list($tahun, $kd_urusan, $kd_bidang, $kd_unit, $kd_sub, $id_renProg)=explode('.', $id);
        if (($model = \common\models\RenjaProgram::find()
                        ->where([
                                 'tahun'    => $tahun,
                                 'kd_urusan'=> $kd_urusan,
                                 'kd_bidang'=> $kd_bidang,
                                 'kd_unit'=> $kd_unit,
                                 'kd_sub'=> $kd_sub,
                                 'id_renprog'=>$id_renProg
                                 ])
                        ->one()
            ) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }    

    protected function findHistoris($id)
    {
        if (($model = \common\models\Historis::find()->where("id_ref=:id AND kd_historis = 11", [":id" => $id]  )->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }           
    }      
}
