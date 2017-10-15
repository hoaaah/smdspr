<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\TPeran;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\json;
//use yii\filters\VerbFilter;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new User; // your model can be loaded here
        $modelPeran = null;
        IF(Yii::$app->user->identity->tperan)
        $modelPeran = $this->findTPeran(Yii::$app->user->identity->Id);
        
        // Check if there is an Editable ajax request
        if (isset($_POST['hasEditable'])) {
            // use Yii's response format to encode output as JSON
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            // read your posted model attributes
            if ($model->load($_POST)) {
                $model1 = $this->findModel(Yii::$app->user->identity->Id);
                // read or convert your posted information
                IF(isset($model->nama)){
                    $value = $model->nama;
                    //$posted = current($_POST['User']);
                    $model1->nama = $value;
                    $model1->save(false);
                }
                IF(isset($model->alamat)){
                    $value = $model->alamat;
                    //$posted = current($_POST['User']);
                    $model1->alamat = $value;
                    $model1->save(false);
                }
                IF(isset($model->contact)){
                    $value = $model->contact;
                    //$posted = current($_POST['User']);
                    $model1->contact = $value;
                    $model1->save(false);
                }
                IF(isset($model->jabatan)){
                    $value = $model->jabatan;
                    //$posted = current($_POST['User']);
                    $model1->jabatan = $value;
                    $model1->save(false);
                }                

                // return JSON encoded output in the below format
                return ['output'=>$value, 'message'=>''];

                // alternatively you can return a validation error
                // return ['output'=>'', 'message'=>'Validation error'];
            }
            // else if nothing to do always return an empty JSON encoded output
            else {
                return ['output'=>'', 'message'=>'Gagal'];
            }
        }       

        return $this->render('index', [
            'model' => $this->findModel(Yii::$app->user->identity->Id),
            'modelPeran' => $modelPeran,
        ]);
    }

    public function actionUbahpwd()
    {
        $model = $this->findModel(Yii::$app->user->identity->id);
        $pwdlama = $model->password_hash;
        if ($model->load(Yii::$app->request->post())) {
            //IF(Yii::$app->security->generatePasswordHash($model->oldpassword) == $pwdlama){
                $model->password_hash = Yii::$app->security->generatePasswordHash($_POST['User']['password_hash']);
                $model->auth_key = Yii::$app->security->generateRandomString();
                $model->status = 10;
                $model->created_at = TIME();
                $model->updated_at = TIME();       
                if ($model->save()) {
                    return $this->redirect(['index']);
                }
            /*}ELSE{
                \Yii::$app->getSession()->setFlash('error', 'Password lama salah..');
                return $this->redirect(['index']);
            }*/
        }

        return $this->renderAjax('ubahpwd', [
                'model' => $model,
            ]);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findTperan($id)
    {
        if (($model = Tperan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }       
    
}
