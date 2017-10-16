<?php

namespace backend\modules\rpjmd\controllers;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use common\models\TRpjmdPrioritas;
use backend\modules\rpjmd\models\TRpjmdPrioritasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrioritasController implements the CRUD actions for TRpjmdPrioritas model.
 */
class PrioritasController extends Controller
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
     * Lists all TRpjmdPrioritas models.
     * @return mixed
     */
    public function actionIndex()
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $tahun = DATE('Y');
        }
        $searchModel = new TRpjmdPrioritasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $tahun = DATE('Y');
        }
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionTambahsasaran($id)
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $tahun = DATE('Y');
        }
        $sasaran = $this->findModel($id);
        $model = new \common\models\TaSasaranRPJMD();
        $ID_Tahun = $sasaran->ID_Tahun;

        if ($model->load(Yii::$app->request->post())) {
            $prioritas = \common\models\TaSasaranRPJMD::find()
                           ->where([
                            'ID_Tahun' => $sasaran->ID_Tahun,
                            'Kd_Prov' => $this->IDTahun()->Kd_Prov,
                            'Kd_Kab_Kota' => $this->IDTahun()->Kd_Kab_Kota,
                            'No_Misi' => $model->No_Misi,
                            'No_Tujuan' => $model->No_Tujuan,
                            'No_Sasaran' => $model->No_Sasaran
                            ])
                           //->select(['No_Sasaran AS id','Ur_Sasaran AS name'])
                           ->one();
            $prioritas->Kd_Prioritas = $id;
            IF($prioritas->save()){
                echo 1;
            }ELSE{
                echo 0;
            }
        } else {
            return $this->renderAjax('_tambahsasaran', [
                'model' => $model,
                'ID_Tahun' => $ID_Tahun,
                'id' => $id
            ]);
        }
    }

    public function actionCreate()
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $tahun = DATE('Y');
        }
        $model = new TRpjmdPrioritas();
        $model->ID_Tahun = $this->IDTahun()->ID_Tahun;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $tahun = DATE('Y');
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $tahun = DATE('Y');
        }
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
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
                            'No_Tujuan' => $no_tujuan,
                            'Kd_Prioritas' => NULL,
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

    /**
     * Finds the TRpjmdPrioritas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TRpjmdPrioritas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TRpjmdPrioritas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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

    protected function cekakses()
    {
        IF(Yii::$app->user->identity){
            $akses = \app\models\RefUserMenu::find()->where(['kd_user' => Yii::$app->user->identity->kd_user, 'menu' => 402])->one();
            IF($akses){
                return true;
            }else{
                return false;
            }
        }
        return false;
    }     
}
