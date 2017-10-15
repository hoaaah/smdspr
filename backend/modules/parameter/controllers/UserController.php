<?php

namespace backend\modules\parameter\controllers;

use Yii;
use common\models\User;
use common\models\TPeran;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\json;
use yii\filters\VerbFilter;
use frontend\models\SignupForm;

/* (C) Copyright 2017 Heru Arief Wijaya (http://belajararief.com/) untuk Indonesia.*/

class UserController extends \yii\web\Controller
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

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);       
    }

    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new \backend\models\User();
        $modelPeran = new TPeran();
        if ($model->load(Yii::$app->request->post()) && $modelPeran->load(Yii::$app->request->post())) {
            $model->password_hash = Yii::$app->security->generatePasswordHash($_POST['User']['password']);
            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->status = 10;
            $model->created_at = TIME();
            $model->updated_at = TIME();
            //$model->setPassword($_POST['User']['password']);
            //$model->generateAuthKey();
            $model->kd_pemda = 1;          
            if ($model->save()) {
                $modelPeran->user_id = $model->id; //assgin $model-> id ke Tperan ----@hoaaah
                IF($modelPeran->skpd)
                    list($modelPeran->kd_urusan, $modelPeran->kd_bidang, $modelPeran->kd_unit, $modelPeran->kd_sub) = explode('.', $modelPeran->skpd);
                IF($modelPeran->save()){
                    return $this->redirect(['index']);    
                }
            }
        }

        return $this->renderAjax('signup', [
            'model' => $model,
            'modelPeran' => $modelPeran,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);        
        //$model = new SignupForm();
        //$modelPeran = new Tperan();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    public function actionKelurahan() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $kd_kecamatan = $parents[0];
                $out = \common\models\Desa::find()
                           ->where([
                            'kecamatan_id' => $kd_kecamatan,
                            ])
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


    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }    
    
}
