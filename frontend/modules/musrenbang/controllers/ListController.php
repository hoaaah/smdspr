<?php

namespace frontend\modules\musrenbang\controllers;

use Yii;
use common\models\TRkpdProgram;
use frontend\modules\musrenbang\models\TRkpdProgramSearch;
use common\models\TRenjaProgram;
use frontend\modules\musrenbang\models\TrenjaProgramSearch;
use common\models\TRenjaKegiatan;
use frontend\modules\musrenbang\models\TRenjaKegiatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/* (C) Copyright 2017 Heru Arief Wijaya (http://belajararief.com/) untuk Satgas SIMDA BPKP.*/
/* TODO:
* [ ] List all program and kegiatan
* [ ] Popup any usulan from other
* [ ] Show all program and kegiatan musrenbang or not
* [ ] There is no other operation (CUD) in this point 
*/
class ListController extends Controller
{
    
    public function actionIndex()
    {
        IF(Yii::$app->session->get('tahun'))
        {
            $tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $tahun = DATE('Y');
        }
        $searchModel = new TRkpdProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['tahun' => $tahun])->andWhere('no_misi NOT IN (98, 99)');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tahun' => $tahun,
        ]);
    }

    public function actionRenjaprogram($id)
    {
        $searchModel = new TrenjaProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['rkpd_program_id' => $id]);

        return $this->renderAjax('renjaprogram', [
            'model' => $this->findModel($id),
            '$id' => $id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRenjakegiatan($id)
    {
        $model = TRenjaProgram::findOne($id);

        $searchModel = new TrenjaKegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['renja_program_id' => $id]);

        return $this->renderAjax('renjakegiatan', [
            'model' => $model,
            '$id' => $id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionViewrenjaprogram($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = TRkpdProgram::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }    
}
