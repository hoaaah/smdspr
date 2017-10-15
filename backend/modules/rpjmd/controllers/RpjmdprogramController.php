<?php

namespace backend\modules\rpjmd\controllers;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use common\models\RpjmdProgram;
use backend\modules\rpjmd\models\RpjmdProgramSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RpjmdprogramController implements the CRUD actions for RpjmdProgram model.
 */
class RpjmdprogramController extends Controller
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
     * Lists all RpjmdProgram models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RpjmdProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('No_Misi NOT IN (98,99)');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RpjmdProgram model.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $Id_Prog
     * @return mixed
     */
    public function actionView($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog),
        ]);
    }

    /**
     * Creates a new RpjmdProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RpjmdProgram();
        $pagu = new \common\models\TaPaguProgramRPJMD();
        $urbid = new \common\models\TaProgramUrbidRPJMD();
        $capaian = [new \common\models\TaIndikatorRPJMD()];              

        if ($model->load(Yii::$app->request->post()) && $pagu->load(Yii::$app->request->post()) ) {

            //preinsert ----@hoaaah
            $model->ID_Tahun = $pagu->ID_Tahun = $urbid->ID_Tahun = $this->IDTahun()->ID_Tahun;
            $model->Kd_Prov = $pagu->Kd_Prov = $urbid->Kd_Prov = $this->IDTahun()->Kd_Prov;
            $model->Kd_Kab_Kota = $pagu->Kd_Kab_Kota = $urbid->Kd_Kab_Kota = $this->IDTahun()->Kd_Kab_Kota;
            $model->Kd_Perubahan = $pagu->Kd_Perubahan = $urbid->Kd_Perubahan = 1;
            $model->Kd_Dokumen = $pagu->Kd_Dokumen = $urbid->Kd_Dokumen = 1;
            $model->Kd_Usulan = $pagu->Kd_Usulan = $urbid->Kd_Usulan = 1;
            $model->Kd_Prog = (RpjmdProgram::find()->where([
                            'ID_Tahun' => $model->ID_Tahun,
                            'Kd_Prov' => $model->Kd_Prov,
                            'Kd_Kab_Kota' => $model->Kd_Kab_Kota,
                            'Kd_Perubahan' => $model->Kd_Perubahan,
                            'Kd_Dokumen' => $model->Kd_Dokumen,
                            'Kd_Usulan' => $model->Kd_Usulan,
                            'No_Misi' => $model->No_Misi,
                            'No_Tujuan' => $model->No_Tujuan,
                            'No_Sasaran' => $model->No_Sasaran,
                        ])->select('MAX(Kd_Prog) AS Kd_Prog')->one()['Kd_Prog']) + 1;
            $pagu->No_Misi = $urbid->No_Misi = $model->No_Misi;
            $pagu->No_Tujuan = $urbid->No_Tujuan = $model->No_Tujuan;
            $pagu->No_Sasaran = $urbid->No_Sasaran = $model->No_Sasaran;
            $pagu->Kd_Prog_rpjmd = $urbid->Kd_Prog = $model->Kd_Prog;
            $urbid->Kd_Urusan1 = $model->Kd_Urusan1;
            $urbid->Kd_Bidang1 = $model->Kd_Bidang1;
            $model->Id_Prog = $pagu->Id_Prog_rpjmd =  $urbid->Id_Prog = $model->Kd_Urusan1.substr(((0).$model->Kd_Bidang1), -2);
            //var_dump($pagu);

            //for multiple capaian
            $capaian = Model::createMultiple(\common\models\TaIndikatorRPJMD::classname());
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
                            $capaian->Kd_Perubahan = $model->Kd_Perubahan;
                            $capaian->Kd_Dokumen = $model->Kd_Dokumen;
                            $capaian->Kd_Usulan = $model->Kd_Usulan;
                            $capaian->No_Misi = $model->No_Misi;
                            $capaian->No_Tujuan = $model->No_Tujuan;
                            $capaian->No_Sasaran = $model->No_Sasaran;
                            $capaian->Kd_Prog = $model->Kd_Prog;
                            $capaian->Id_Prog = $model->Id_Prog;
                            var_dump($capaian);
                            if (! ($flag = $capaian->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        $pagu->save();
                        $urbid->save();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'pagu' => $pagu,
                'capaian' => (empty($capaian)) ? [new \common\models\TaIndikatorRPJMD()] : $capaian
            ]);
        }
    }

    public function actionIndikator($id)
    {
        $model = new \common\models\TaIndikatorRPJMD();
        list($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog) = explode('.', $id);

        if ($model->load(Yii::$app->request->post())) {

            //preinsert ----@hoaaah
            $model->ID_Tahun = $ID_Tahun;
            $model->Kd_Prov = $Kd_Prov;
            $model->Kd_Kab_Kota = $Kd_Kab_Kota;
            $model->Kd_Perubahan = $Kd_Perubahan;
            $model->Kd_Dokumen = $Kd_Dokumen;
            $model->Kd_Usulan = $Kd_Usulan;
            $model->No_Misi = $No_Misi;
            $model->No_Tujuan = $No_Tujuan;
            $model->No_Sasaran = $No_Sasaran;
            $model->Kd_Prog = $Kd_Prog;
            $model->Id_Prog = $Id_Prog;
            IF($model->save()){
                echo 1;
            }ELSE{
                var_dump($model);
                echo 0;
            }

        } else {
            return $this->renderAjax('_formindikator', [
                'model' => $model,
                'id' => $id
            ]);
        }
    }

    public function actionPelaksana($id)
    {
        $model = new \common\models\TaPelaksanaProgRPJMD();
        list($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog) = explode('.', $id);
        $program = $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog);
        if ($model->load(Yii::$app->request->post())) {

            //preinsert ----@hoaaah
            $model->ID_Tahun = $ID_Tahun;
            $model->Kd_Prov = $Kd_Prov;
            $model->Kd_Kab_Kota = $Kd_Kab_Kota;
            $model->Kd_Perubahan = $Kd_Perubahan;
            $model->Kd_Dokumen = $Kd_Dokumen;
            $model->Kd_Usulan = $Kd_Usulan;
            $model->No_Misi = $No_Misi;
            $model->No_Tujuan = $No_Tujuan;
            $model->No_Sasaran = $No_Sasaran;
            $model->Kd_Prog = $Kd_Prog;
            $model->Id_Prog = $Id_Prog;
            $model->Kd_Urusan1 = $program->Kd_Urusan1;
            $model->Kd_Bidang1 = $program->Kd_Bidang1;
            IF($model->save()){
                echo 1;
            }ELSE{
                var_dump($model);
                echo 0;
            }

        } else {
            return $this->renderAjax('_formpelaksana', [
                'model' => $model,
                'id' => $id
            ]);
        }
    }

    /**
     * Updates an existing RpjmdProgram model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $Id_Prog
     * @return mixed
     */
    public function actionUpdate($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog)
    {
        $model = $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog);
        $pagu = \common\models\TaPaguProgramRPJMD::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Perubahan' => $Kd_Perubahan, 'Kd_Dokumen' => $Kd_Dokumen, 'Kd_Usulan' => $Kd_Usulan, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran, 'Kd_Prog_rpjmd' => $Kd_Prog, 'Id_Prog_rpjmd' => $Id_Prog]);
        $urbid = \common\models\TaProgramUrbidRPJMD::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Perubahan' => $Kd_Perubahan, 'Kd_Dokumen' => $Kd_Dokumen, 'Kd_Usulan' => $Kd_Usulan, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran, 'Kd_Prog' => $Kd_Prog, 'Id_Prog' => $Id_Prog]);

        if ($model->load(Yii::$app->request->post()) && $pagu->load(Yii::$app->request->post()) ) {
            IF($model->save() && $pagu->save() && $urbid->save()){
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
     * Deletes an existing RpjmdProgram model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $Id_Prog
     * @return mixed
     */
    public function actionDelete($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog)
    {
        $this->findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the RpjmdProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab_Kota
     * @param integer $Kd_Perubahan
     * @param integer $Kd_Dokumen
     * @param integer $Kd_Usulan
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @param integer $Kd_Prog
     * @param integer $Id_Prog
     * @return RpjmdProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_Tahun, $Kd_Prov, $Kd_Kab_Kota, $Kd_Perubahan, $Kd_Dokumen, $Kd_Usulan, $No_Misi, $No_Tujuan, $No_Sasaran, $Kd_Prog, $Id_Prog)
    {
        if (($model = RpjmdProgram::findOne(['ID_Tahun' => $ID_Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab_Kota' => $Kd_Kab_Kota, 'Kd_Perubahan' => $Kd_Perubahan, 'Kd_Dokumen' => $Kd_Dokumen, 'Kd_Usulan' => $Kd_Usulan, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran, 'Kd_Prog' => $Kd_Prog, 'Id_Prog' => $Id_Prog])) !== null) {
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
                $ID_Tahun = \common\models\TaMisiRPJMD::find()->select(['MAX(ID_Tahun) ID_Tahun'])->one();
                $out = \common\models\TaTujuanRPJMD::find()
                           ->where([
                            'ID_Tahun' => $ID_Tahun->ID_Tahun,
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
