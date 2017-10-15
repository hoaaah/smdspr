<?php

namespace backend\modules\forumskpd\controllers;

use Yii;
use yii\helpers\Json;
use yii\db\Query;
use yii\helpers\Html;
use common\models\Subkegiatan;
use backend\modules\forumskpd\models\SubkegiatanPhoto;
use common\models\UploadUsulan;
use common\models\RenjaProgram;
use common\models\RenjaKegiatan;
use common\models\TStatus;
use common\models\Historis;
use common\models\Jadwal;
use common\models\Proses;
use common\models\Desa;
use backend\modules\forumskpd\models\SubkegiatanSearch;
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
                        'actions' => ['update', 'index', 'view', 'tambah', 'create' ,'delete', 'detail', 'subkelurahan'],
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
        IF(Yii::$app->user->identity->kd_peran <> 2){
            Yii::$app->getSession()->setFlash('danger','Anda tidak memiliki hak akses');
            return Controller::redirect(['/site']);                
        }
                
        $searchModel = new SubkegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 5])->one();
        $proses = Proses::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 5])->andWhere('kd_kelurahan=:kd_kelurahan', [':kd_kelurahan' => Yii::$app->user->identity->tperan->kd_kelurahan])->one();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jadwal' => $jadwal,
            'proses' => $proses,
        ]);
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
            $model->tahun = DATE('Y')+1;
            $model->renja_kegiatan_id = $id;
            $model->input_phased = 2;
            $model->input_status = 2;            
            $model->status_phased = 2;
            $model->skpd = 1;
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
            return $this->redirect(['/forumskpd/renjakegiatan']);
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
        $photo = $this->findPhoto($id);        
        $model = $this->findModel($id);
        $kegiatan = $this->findKegiatan($model->renja_kegiatan_id);
        if($kegiatan->kd_urusan <> Yii::$app->user->identity->tperan->kd_urusan && 
            $kegiatan->kd_bidang <> Yii::$app->user->identity->tperan->kd_bidang  &&
            $kegiatan->kd_unit <> Yii::$app->user->identity->tperan->kd_unit  && 
            $kegiatan->kd_sub <> Yii::$app->user->identity->tperan->kd_sub ){
            Yii::$app->getSession()->setFlash('danger','Anda tidak memiliki akses untuk mengubah data ini');
            return $this->redirect(['view','id'=>$model->id]);
        }
        //persiapkan variabel untuk historis
        $model_s = $this->findModel($id);
        $historis = new Historis();
        if ($model->load(Yii::$app->request->post()) && $historis->load(Yii::$app->request->post())) {
            //ketika perubahan disimpan, copy semua data sebelum ke historis
            IF($model->save()){
                $historis->kd_historis = 11;
                $historis->id_ref = $id;
                //$historis->created_at = DATE('Y-m-d');
                $historis->tahun = $model_s->tahun;
                $historis->kd_urusan = $kegiatan->kd_urusan;
                $historis->kd_bidang = $kegiatan->kd_bidang;
                $historis->kd_unit = $kegiatan->kd_unit;
                $historis->kd_sub = $kegiatan->kd_sub;
                $historis->no_skpdMisi = $kegiatan->no_skpdMisi;
                $historis->no_skpdTujuan = $kegiatan->no_skpdTujuan;
                $historis->no_skpdSasaran = $kegiatan->no_skpdSasaran;
                $historis->no_renjaSas = $kegiatan->no_renjaSas;
                $historis->no_renjaProg = $kegiatan->no_renjaProg;
                $historis->id_renprog = $kegiatan->id_renprog;
                $historis->uraian = $model_s->uraian;
                $historis->kd_kecamatan = $model_s->kd_kecamatan;
                $historis->kd_kelurahan = $model_s->kd_kelurahan;
                $historis->rw = $model_s->rw;
                $historis->rt = $model_s->rt;
                $historis->lokasi = $model_s->lokasi;
                $historis->volume = $model_s->volume;
                $historis->satuan = $model_s->satuan;
                $historis->harga_satuan = $model_s->harga_satuan;
                $historis->biaya = $model_s->biaya;
                $historis->kd_asb = $model_s->kd_asb;
                $historis->input_phased = $model_s->input_phased;
                $historis->status = $model_s->input_status;
                $historis->status_phased = $model_s->status_phased;
                $historis->alasan_perubahan = $historis->alasan_perubahan;
                $historis->user_id = Yii::$app->user->identity->id;
                IF($historis->save()){
                    Yii::$app->getSession()->setFlash('success','Perubahan atas usulan'.Html::encode($model->uraian).'berhasil.');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            
        } else {
            return $this->render('update', [
                'model' => $model,
                'kegiatan' => $kegiatan,
                'photo'=> $photo,
                'historis' => $historis,        
            ]);
        }
    }

    public function actionDetail($id)
    {
        $model = $this->findModel($id);
        $status = NULL;
        IF($model->input_status == 3){
            $status = $this->findStatus($id);
        }
        $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 3])->one();  
        if($model!==null){
            $photo = $this->findPhoto($id);
            return $this->renderAjax('usulanrinci', [
                'model' => $model,
                'photo' => $photo,
                'status' => $status,
                'jadwal' => $jadwal,
            ]);           
        } else{
            return "Terjadi kesalahan dengan inputan ini, mungkin kegiatan sudah dihapus. Anda hanya dapat menolak usulan ini.";
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
        if (($model = Renjaprogram::find()
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

    public function actionSubkelurahan() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $kecamatan_id = $parents[0];
                //$out = \common\models\Desa::getSubCatList($kecamatan_id); 
                $out = \common\models\Desa::find()
                           ->where(['kecamatan_id'=>$kecamatan_id])
                           ->select(['id','desa AS name'])->asArray()->all();
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }         
}
