<?php

namespace backend\modules\rkpd\controllers;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use common\models\RkpdProgram;
use backend\modules\rkpd\models\RkpdProgramSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;

/**
 * RkpdawalController implements the CRUD actions for RkpdProgram model.
 */
class RkpdawalpdtbtlController extends Controller
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
     * Lists all RkpdProgram models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RkpdProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('No_Misi IN (98,99)');
        $jadwal = $this->cekjadwal();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jadwal' => $jadwal,
        ]);
    }

    /**
     * Displays a single RkpdProgram model.
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
     * Creates a new RkpdProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RkpdProgram();
        $capaian = [new \common\models\RkpdProgramCapaian()];

        if ($model->load(Yii::$app->request->post())) {
            $id_progrkpd = \common\models\RkpdProgram::find()->select('MAX(kd_progrkpd) AS kd_progrkpd')->where([
                'Tahun' => $model->tahun,
                'no_misi' => $model->no_misi,
                'no_tujuan' => $model->no_tujuan,
                'no_sasaran' => $model->no_sasaran,
                ])->one();
            $model->kd_progrkpd = ($id_progrkpd->kd_progrkpd)+1;
            $model->bidang_id = $model->bidang_id;
            $model->id_progrkpd = $model->urusan_id.substr(((0).$model->bidang_id), -2);
            $model->input_phased = 1;
            $model->status = 2;
            $model->status_phased = 1;
            $model->user_id = Yii::$app->user->identity->id;
            $model->id_tahun = $this->IDTahun()->ID_Tahun;
            $capaian = Model::createMultiple(\common\models\RkpdProgramCapaian::classname());
            Model::loadMultiple($capaian, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($capaian) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $model->save(false)) {
                        foreach ($capaian as $capaian) {
                            $capaian->rkpd_program_id = $model->id;
                            $capaian->tahun = $model->tahun;
                            $capaian->urusan_id = $model->urusan_id;
                            $capaian->bidang_id = $model->bidang_id;
                            $capaian->no_misi = $model->no_misi;
                            $capaian->no_tujuan = $model->no_tujuan;
                            $capaian->no_sasaran = $model->no_sasaran;
                            $capaian->kd_progrkpd = $model->kd_progrkpd;
                            $capaian->id_progrkpd = $model->id_progrkpd;
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
            'capaian' => (empty($capaian)) ? [new \common\models\RkpdProgramCapaian()] : $capaian
        ]);        
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            IF($model->save()){
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

    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        // return $this->redirect(['index']);
        $model = $this->findModel($id);
        $model->pagu_program = 0;
        $model->save();
        return $this->redirect(Yii::$app->request->referrer);
    }

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

    /**
     * Finds the RkpdProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RkpdProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RkpdProgram::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
