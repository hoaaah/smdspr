<?php

namespace backend\modules\renstra\controllers;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use common\models\TaKegiatanSkpd;
use backend\modules\renstra\models\TaKegiatanSkpdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RenstrakegiatanController implements the CRUD actions for TaKegiatanSkpd model.
 */
class RenstrakegiatanController extends Controller
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
     * Lists all TaKegiatanSkpd models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaKegiatanSkpdSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('No_Misi NOT IN (98,99)');        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaKegiatanSkpd model.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionView($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg),
        ]);
    }

    /**
     * Creates a new TaKegiatanSkpd model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaKegiatanSkpd();
        $pagu = new \common\models\TaPaguKegiatanSkpd();
        $capaian = [new \common\models\TaIndikatorKegiatanSkpd()];              

        if ($model->load(Yii::$app->request->post()) && $pagu->load(Yii::$app->request->post()) ) {

            //preinsert ----@hoaaah
            $model->ID_Tahun = $pagu->ID_Tahun = $this->IDTahun()->ID_Tahun;
            $model->Kd_Prov = $pagu->Kd_Prov = $this->IDTahun()->Kd_Prov;
            $model->Kd_Kab_Kota = $pagu->Kd_Kab_Kota = $this->IDTahun()->Kd_Kab_Kota;
            IF(!$model->Kd_Urusan){
                $model->Kd_Urusan = $pagu->Kd_Urusan = Yii::$app->user->identity->tperan->kd_urusan;
                $model->Kd_Bidang = $pagu->Kd_Bidang = Yii::$app->user->identity->tperan->kd_bidang;
                $model->Kd_Unit = $pagu->Kd_Unit = Yii::$app->user->identity->tperan->kd_unit;
            }
            $pagu->No_Misi = $model->No_Misi;
            $pagu->No_Tujuan = $model->No_Tujuan;
            $pagu->No_Sasaran = $model->No_Sasaran;
            $pagu->Kd_Prog = $model->Kd_Prog;    
            $model->ID_Prog = $pagu->ID_Prog = \common\models\Renstra::find()->where([
                            'ID_Tahun' => $model->ID_Tahun,
                            'Kd_Prov' => $model->Kd_Prov,
                            'Kd_Kab_Kota' => $model->Kd_Kab_Kota,
                            'Kd_Urusan' => $model->Kd_Urusan,
                            'Kd_Bidang' => $model->Kd_Bidang,
                            'Kd_Unit' => $model->Kd_Unit,
                            'No_Misi' => $model->No_Misi,
                            'No_Tujuan' => $model->No_Tujuan,
                            'No_Sasaran' => $model->No_Sasaran,
                            'Kd_Prog' => $model->Kd_Prog
                        ])->select('ID_Prog')->one()->ID_Prog;
            $model->Kd_Keg = (TaKegiatanSkpd::find()->where([
                            'ID_Tahun' => $model->ID_Tahun,
                            'Kd_Prov' => $model->Kd_Prov,
                            'Kd_Kab_Kota' => $model->Kd_Kab_Kota,
                            'Kd_Urusan' => $model->Kd_Urusan,
                            'Kd_Bidang' => $model->Kd_Bidang,
                            'Kd_Unit' => $model->Kd_Unit,
                            'No_Misi' => $model->No_Misi,
                            'No_Tujuan' => $model->No_Tujuan,
                            'No_Sasaran' => $model->No_Sasaran,
                            'Kd_Prog' => $model->Kd_Prog
                        ])->select('MAX(Kd_Keg) AS Kd_Keg')->one()['Kd_Keg']) + 1;
            $pagu->Kd_Keg = $model->Kd_Keg;
            //var_dump($pagu);

            //for multiple capaian
            $capaian = Model::createMultiple(\common\models\TaIndikatorKegiatanSkpd::classname());
            Model::loadMultiple($capaian, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($capaian) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $model->save(false)) {
                        foreach ($capaian as $capaian) {
                            //$capaian->rkpd_program_id = $model->id;
                            $capaian->ID_Tahun = $model->ID_Tahun;
                            $capaian->Kd_Prov = $model->Kd_Prov;
                            $capaian->Kd_Kab_Kota = $model->Kd_Kab_Kota;
                            $capaian->Kd_Urusan = $model->Kd_Urusan;
                            $capaian->Kd_Bidang = $model->Kd_Bidang;
                            $capaian->Kd_Unit = $model->Kd_Unit;
                            $capaian->No_Misi = $model->No_Misi;
                            $capaian->No_Tujuan = $model->No_Tujuan;
                            $capaian->No_Sasaran = $model->No_Sasaran;
                            $capaian->Kd_Prog = $model->Kd_Prog;
                            $capaian->Id_Prog = $model->Id_Prog;
                            $capaian->Kd_Keg = $model->Kd_Keg;
                            if (! ($flag = $capaian->save(false))) {
                                $transaction->rollBack();
                                //var_dump($capaian);
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        $pagu->save();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    //var_dump($capaian);
                }
            }

        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'pagu' => $pagu,
                'capaian' => (empty($capaian)) ? [new \common\models\TaIndikatorKegiatanSkpd()] : $capaian
            ]);
        }
    }

    public function actionIndikator($id)
    {
        $model = new \common\models\TaIndikatorKegiatanSkpd();
        list($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg) = explode('.', $id);

        if ($model->load(Yii::$app->request->post())) {

            //preinsert ----@hoaaah
            $model->ID_Tahun = $ID_Tahun;
            $model->Kd_Prov = $Kd_Prov;
            $model->Kd_Kab_Kota = $Kd_Kab_Kota;
            $model->Kd_Urusan = $Kd_Urusan;
            $model->Kd_Bidang = $Kd_Bidang;
            $model->Kd_Unit = $Kd_Unit;
            $model->No_Misi = $No_Misi;
            $model->No_Tujuan = $No_Tujuan;
            $model->No_Sasaran = $No_Sasaran;
            $model->Kd_Prog = $Kd_Prog;
            $model->ID_Prog = $ID_Prog;
            $model->Kd_Keg = $Kd_Keg;
            IF($model->save()){
                echo 1;
            }ELSE{
                echo 0;
            }

        } else {
            return $this->renderAjax('_formindikator', [
                'model' => $model,
            ]);
        }
    }

    public function actionPelaksana($id)
    {
        $model = new \common\models\TaPelaksanaKegSkpd();
        list($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg) = explode('.', $id);
        $program = $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg);
        if ($model->load(Yii::$app->request->post())) {

            //preinsert ----@hoaaah
            $model->ID_Tahun = $ID_Tahun;
            $model->Kd_Prov = $Kd_Prov;
            $model->Kd_Kab_Kota = $Kd_Kab_Kota;
            // $model->Kd_Urusan = $Kd_Urusan;
            // $model->Kd_Bidang = $Kd_Bidang;
            // $model->Kd_Unit = $Kd_Unit;
            $model->No_Misi = $No_Misi;
            $model->No_Tujuan = $No_Tujuan;
            $model->No_Sasaran = $No_Sasaran;
            $model->Kd_Prog = $Kd_Prog;
            $model->ID_Prog = $ID_Prog;
            $model->Kd_Keg = $Kd_Keg;
            $model->Nm_Sub = \common\models\Sub::find()->where([
                    'Kd_Urusan' => $model->Kd_Urusan,
                    'Kd_Bidang' => $model->Kd_Bidang,
                    'Kd_Unit' => $model->Kd_Unit,
                    'Kd_Sub' => $model->Kd_Sub,
                ])->select('Nm_Sub_Unit')->one()->Nm_Sub_Unit;
            IF($model->save()){
                echo 1;
            }ELSE{
                var_dump($model);
                echo 0;
            }

        } else {
            return $this->renderAjax('_formpelaksana', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaKegiatanSkpd model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionUpdate($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg)
    {
        $model = $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg);
        $pagu = \common\models\TaPaguKegiatanSkpd::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran, 'Kd_Prog' => $Kd_Prog, 'ID_Prog' => $ID_Prog, 'Kd_Keg' => $Kd_Keg]);

        if ($model->load(Yii::$app->request->post())) {
            IF($model->save()){
                echo 1;
            }ELSE{
                echo 0;
            }
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
                'pagu' => $pagu,
            ]);
        }
    }

    /**
     * Deletes an existing TaKegiatanSkpd model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionDelete($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg)
    {
        $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaKegiatanSkpd model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param integer $Kd_Keg
     * @return TaKegiatanSkpd the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $ID_Prog, $Kd_Keg)
    {
        if (($model = TaKegiatanSkpd::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran, 'Kd_Prog' => $Kd_Prog, 'ID_Prog' => $ID_Prog, 'Kd_Keg' => $Kd_Keg])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //for depdrop action ----@hoaaah
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
            $ID_Tahun = \common\models\TaMisiSKPD::find()->select(['MAX(ID_Tahun) ID_Tahun'])->one();
            if ($no_misi != null) {
               //$data = self::getProdList($cat_id, $subcat_id);
               $data = \common\models\TaSasaranSKPD::find()
                           ->where([
                            'ID_Tahun' => $ID_Tahun->ID_Tahun,
                            'Kd_Urusan' => Yii::$app->user->identity->tperan->kd_urusan,
                            'Kd_Bidang' => Yii::$app->user->identity->tperan->kd_bidang,
                            'Kd_Unit' => Yii::$app->user->identity->tperan->kd_unit,
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

    public function actionProgram() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $no_misi = empty($ids[0]) ? null : $ids[0];
            $no_tujuan = empty($ids[1]) ? null : $ids[1];
            $no_sasaran = empty($ids[2]) ? null : $ids[2];
            $ID_Tahun = \common\models\TaMisiSKPD::find()->select(['MAX(ID_Tahun) ID_Tahun'])->one();
            if ($no_misi != null) {
               //$data = self::getProdList($cat_id, $subcat_id);
               $data = \common\models\TaRenstra::find()
                           ->where([
                            'ID_Tahun' => $ID_Tahun->ID_Tahun,
                            'Kd_Urusan' => Yii::$app->user->identity->tperan->kd_urusan,
                            'Kd_Bidang' => Yii::$app->user->identity->tperan->kd_bidang,
                            'Kd_Unit' => Yii::$app->user->identity->tperan->kd_unit,
                            'No_Misi'=> $no_misi,
                            'No_Tujuan' => $no_tujuan,
                            'No_Sasaran' => $no_sasaran
                            ])
                           ->select(['Kd_Prog AS id','Ket_Program AS name'])->asArray()->all();
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

    public function actionUnit() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $urusan_id = empty($ids[0]) ? null : $ids[0];
            $bidang_id = empty($ids[1]) ? null : $ids[1];
            if ($urusan_id != null) {
               //$data = self::getProdList($cat_id, $subcat_id);
               $data = \common\models\Unit::find()
                           ->where([
                            'Kd_Urusan'=>$urusan_id,
                            'Kd_Bidang' => $bidang_id,
                            ])
                           ->select(['Kd_Unit AS id','Nm_Unit AS name'])->asArray()->all();
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

    public function actionSub() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $urusan_id = empty($ids[0]) ? null : $ids[0];
            $bidang_id = empty($ids[1]) ? null : $ids[1];
            $unit_id = empty($ids[2]) ? null : $ids[2];
            if ($urusan_id != null) {
               //$data = self::getProdList($cat_id, $subcat_id);
               $data = \common\models\Sub::find()
                           ->where([
                            'Kd_Urusan'=>$urusan_id,
                            'Kd_Bidang' => $bidang_id,
                            'Kd_Unit' => $unit_id
                            ])
                           ->select(['Kd_Sub AS id','Nm_Sub_Unit AS name'])->asArray()->all();
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
        $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 1])->one();
        IF( DATE('Y-m-d') >= $jadwal['tgl_mulai'] && DATE('Y-m-d') <= $jadwal['tgl_selesai'] ){
            return true;
        }else{
            return false;
        }
    }

    protected function IDTahun(){
        IF(Yii::$app->session->get('tahun') && $tahun = Yii::$app->session->get('tahun')){
            $ID_Tahun = \common\models\TaPeriode::find()->where([
                    'or',
                    ['Tahun1' => $tahun],
                    ['Tahun2' => $tahun],
                    ['Tahun3' => $tahun],
                    ['Tahun4' => $tahun],
                    ['Tahun5' => $tahun],
                ])->one();
        }ELSE{
            $tahun = (DATE('Y')+1);
            $ID_Tahun = \common\models\TaPeriode::find()->where([
                    'or',
                    ['Tahun1' => $tahun],
                    ['Tahun2' => $tahun],
                    ['Tahun3' => $tahun],
                    ['Tahun4' => $tahun],
                    ['Tahun5' => $tahun],
                ])->one();
        } 

        return $ID_Tahun;
    }      
}
