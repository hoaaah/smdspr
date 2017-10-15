<?php

namespace backend\modules\renja\controllers;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use common\models\RenjaProgram;
use backend\modules\renja\models\RenjaProgramSearch;
use common\models\RenjaKegiatan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RenjaawalController implements the CRUD actions for RenjaProgram model.
 */
class RenjaawalpdtbtlController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all RenjaProgram models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RenjaProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('no_skpdMisi IN (98,99)');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RenjaProgram model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $jadwal = $this->cekjadwal();           
        return $this->render('view', [
            'model' => $this->findModel($id),
            'capaian' => $this->findModel($id)->capaian,
            'jadwal' => $jadwal,
        ]);
    }

    /**
     * Creates a new RenjaProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RenjaProgram();
        $capaian = [new \common\models\RenjaProgramCapaian()];

        if ($model->load(Yii::$app->request->post())) {
            $no_renjaProg = \common\models\RenjaProgram::find()->select('MAX(no_renjaProg) AS no_renjaProg')->where([
                'tahun' => $model->tahun,
                'no_skpdMisi' => $model->no_skpdMisi,
                'no_skpdTujuan' => $model->no_skpdTujuan,
                'no_skpdSasaran' => $model->no_skpdSasaran,
                ])->one();
            $model->tahun = $this->Tahun();
            $model->urusan_id = 0;
            $model->bidang_id = 0;
            $model->no_renjaSas = 1;
            $model->no_renjaProg = ($no_renjaProg->no_renjaProg)+1;
            $model->id_renprog = $model->urusan_id.substr(((0).$model->bidang_id), -2);
            $model->input_phased = 1;
            $model->status = 2;
            $model->status_phased = 1;
            $model->user_id = Yii::$app->user->identity->id;
            $model->user_id = Yii::$app->user->identity->id;
            $model->kd_urusan = Yii::$app->user->identity->tperan->kd_urusan;
            $model->kd_bidang = Yii::$app->user->identity->tperan->kd_bidang;
            $model->kd_unit = Yii::$app->user->identity->tperan->kd_unit;
            $model->kd_sub = Yii::$app->user->identity->tperan->kd_sub;
            $capaian = Model::createMultiple(\common\models\RenjaProgramCapaian::classname());
            Model::loadMultiple($capaian, Yii::$app->request->post());
            //var_dump($model);
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($capaian) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $model->save(false)) {
                        foreach ($capaian as $capaian) {
                            $capaian->tahun = $model->tahun;
                            $capaian->urusan_id = $model->urusan_id;
                            $capaian->bidang_id = $model->bidang_id;
                            $capaian->kd_urusan = $model->kd_urusan;
                            $capaian->kd_bidang = $model->kd_bidang;
                            $capaian->kd_unit = $model->kd_unit;
                            $capaian->kd_sub = $model->kd_sub;
                            $capaian->no_skpdMisi = $model->no_skpdMisi;
                            $capaian->no_skpdTujuan = $model->no_skpdTujuan;
                            $capaian->no_skpdSasaran = $model->no_skpdSasaran;
                            $capaian->no_renjaSas = $model->no_renjaSas;
                            $capaian->no_renjaProg = $model->no_renjaProg;
                            $capaian->id_renprog = $model->id_renprog;
                            $capaian->input_phased = $model->input_phased;
                            $capaian->status = $model->status;
                            $capaian->status_phased = $model->status_phased;
                            $capaian->user_id = $model->user_id;
                            if (! ($flag = $capaian->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->renderAjax('_form', [
            'model' => $model,
            'capaian' => (empty($capaian)) ? [new \common\models\RenjaProgramCapaian()] : $capaian
        ]);        
    }

    public function actionTambah($id)
    {
        list($tahun, $kd_urusan, $kd_bidang, $kd_unit, $kd_sub, $no_skpdMisi, $no_skpdTujuan, $no_skpdSasaran, $no_renjaSas, $no_renjaProg, $id_renprog) = explode('.', $id);
        $model = new RenjaKegiatan();
        $capaian = [new \common\models\RenjaKegiatanCapaian()];

        if ($model->load(Yii::$app->request->post())) {
            $id_renkeg = \common\models\RenjaKegiatan::find()->select('MAX(id_renkeg) AS id_renkeg')->where([
                'tahun' => $tahun,
                'kd_urusan' => $kd_urusan,
                'kd_bidang' => $kd_bidang,
                'kd_unit' => $kd_unit,
                'kd_sub' => $kd_sub,
                'no_skpdMisi' => $no_skpdMisi,
                'no_skpdTujuan' => $no_skpdTujuan,
                'no_skpdSasaran' => $no_skpdSasaran,
                'no_renjaSas' => $no_renjaSas,
                'no_renjaProg' => $no_renjaProg,
                'id_renprog' => $id_renprog,
                ])->one();
            $model->tahun = $tahun;
            $model->kd_urusan = $kd_urusan;
            $model->kd_bidang = $kd_bidang;
            $model->kd_unit = $kd_unit;
            $model->kd_sub = $kd_sub;
            $model->no_skpdMisi = $no_skpdMisi;
            $model->no_skpdTujuan = $no_skpdTujuan;
            $model->no_skpdSasaran = $no_skpdSasaran;
            $model->no_renjaSas = $no_renjaSas;
            $model->no_renjaProg = $no_renjaProg;
            $model->id_renprog = $id_renprog;
            $model->id_renkeg = ($id_renkeg->id_renkeg)+1;
            $model->input_phased = 1;
            $model->status = 2;
            $model->status_phased = 1;
            $model->user_id = Yii::$app->user->identity->id;
            $capaian = Model::createMultiple(\common\models\RenjaKegiatanCapaian::classname());
            Model::loadMultiple($capaian, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($capaian) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $model->save(false)) {
                        foreach ($capaian as $capaian) {
                            $capaian->tahun = $model->tahun;
                            $capaian->kd_urusan = $model->kd_urusan;
                            $capaian->kd_bidang = $model->kd_bidang;
                            $capaian->kd_unit = $model->kd_unit;
                            $capaian->kd_sub = $model->kd_sub;
                            $capaian->no_skpdMisi = $model->no_skpdMisi;
                            $capaian->no_skpdTujuan = $model->no_skpdTujuan;
                            $capaian->no_skpdSasaran = $model->no_skpdSasaran;
                            $capaian->no_renjaSas = $model->no_renjaSas;
                            $capaian->no_renjaProg = $model->no_renjaProg;
                            $capaian->id_renprog = $model->id_renprog;
                            $capaian->id_renkeg = $model->id_renkeg;                            
                            $capaian->input_phased = $model->input_phased;
                            $capaian->status = $model->status;
                            $capaian->status_phased = $model->status_phased;
                            $capaian->user_id = $model->user_id;
                            if (! ($flag = $capaian->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->renderAjax('_tambah', [
            'model' => $model,
            'capaian' => (empty($capaian)) ? [new \common\models\RenjaKegiatanCapaian()] : $capaian
        ]);        
    }

    /**
     * Updates an existing RenjaProgram model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $kegiatan = \common\models\RenjaKegiatan::findOne(['tahun' => $model->tahun, 'kd_urusan' => $model->kd_urusan, 'kd_bidang' => $model->kd_bidang, 'kd_unit' => $model->kd_unit, 'kd_sub' => $model->kd_sub, 'no_skpdMisi' => $model->no_skpdMisi, 'no_skpdTujuan' => $model->no_skpdTujuan, 'no_skpdSasaran' => $model->no_skpdSasaran, 'no_renjaSas' => $model->no_renjaSas, 'no_renjaProg' => $model->no_renjaProg, 'id_renkeg' => 1]);        

        if ($model->load(Yii::$app->request->post())) {
            $kegiatan->no_renjaProg = $model->no_renjaProg;
            $kegiatan->uraian = $model->uraian;
            $kegiatan->pagu_kegiatan = $model->pagu_program;
            IF($model->save() && $kegiatan->save()){
                echo 1;
            }ELSE{
                echo 0;
            }
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RenjaProgram model.
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
     * Finds the RenjaProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RenjaProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RenjaProgram::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionTujuan() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $no_misi = $parents[0];
                $ID_Tahun = \common\models\TaMisiSKPD::find()->select(['MAX(ID_Tahun) ID_Tahun'])->one();
                $out = \common\models\TaTujuanSKPD::find()
                           ->where([
                            'ID_Tahun' => $ID_Tahun->ID_Tahun,
                            'Kd_Urusan' => Yii::$app->user->identity->tperan->kd_urusan,
                            'Kd_Bidang' => Yii::$app->user->identity->tperan->kd_bidang,
                            'Kd_Unit' => Yii::$app->user->identity->tperan->kd_unit,
                            'No_Misi'=>$no_misi
                            ])
                           ->select(['No_Tujuan AS id','Ur_Tujuan AS name'])->asArray()->all();
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
     
    public function actionSasaran() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $no_misi = empty($ids[0]) ? null : $ids[0];
            $no_tujuan = empty($ids[1]) ? null : $ids[1];
            $ID_Tahun = \common\models\TaMisiRPJMD::find()->select(['MAX(ID_Tahun) ID_Tahun'])->one();
            if ($no_misi != null) {
               //$data = self::getProdList($cat_id, $subcat_id);
               $data = \common\models\TaSasaranRPJMD::find()
                           ->where([
                            'ID_Tahun' => $ID_Tahun->ID_Tahun,
                            'No_Misi'=> $no_misi,
                            'No_Tujuan' => $no_tujuan
                            ])
                           ->select(['No_Sasaran AS id','Ur_Sasaran AS name'])->asArray()->all();
                /**
                 * the getProdList function will query the database based on the
                 * cat_id and sub_cat_id and return an array like below:
                 *  [
                 *      'out'=>[
                 *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
                 *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
                 *       ],
                 *       'selected'=>'<prod-id-1>'
                 *  ]
                 */
               
               echo Json::encode(['output'=>$data, 'selected'=>'']);
               return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }   

    public function actionBidang() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $urusan_id = $parents[0];
                $out = \common\models\Bidang::find()
                           ->where([
                            'Kd_Urusan'=>$urusan_id
                            ])
                           ->select(['Kd_Bidang AS id','Nm_Bidang AS name'])->asArray()->all();
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

    public function actionRkpd() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $urusan_id = empty($ids[0]) ? null : $ids[0];
            $bidang_id = empty($ids[1]) ? null : $ids[1];
            $ID_Tahun = \common\models\RkpdProgram::find()->select(['MAX(tahun) tahun'])->one();
            if ($urusan_id != null) {
               //$data = self::getProdList($cat_id, $subcat_id);
               $data = \common\models\RkpdProgram::find()
                           ->where([
                            'tahun' => $ID_Tahun->tahun,
                            'urusan_id'=> $urusan_id,
                            'bidang_id' => $bidang_id
                            ])
                           ->select(['id','uraian AS name'])->asArray()->all();
                /**
                 * the getProdList function will query the database based on the
                 * cat_id and sub_cat_id and return an array like below:
                 *  [
                 *      'out'=>[
                 *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
                 *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
                 *       ],
                 *       'selected'=>'<prod-id-1>'
                 *  ]
                 */
               
               echo Json::encode(['output'=>$data, 'selected'=>'']);
               return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    protected function cekjadwal(){
        //control cek jadwal --@hoaaah
        $jadwal = \common\models\Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 1])->one();
        IF( DATE('Y-m-d') >= $jadwal['tgl_mulai'] && DATE('Y-m-d') <= $jadwal['tgl_selesai'] ){
            return true;
        }else{
            return false;
        }
    }  

    protected function Tahun(){
        IF(Yii::$app->session->get('tahun')){
            $tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $tahun = (DATE('Y')+1);
        } 

        return $tahun;
    }   
}
