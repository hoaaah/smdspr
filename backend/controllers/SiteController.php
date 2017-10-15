<?php
namespace backend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use yii\data\SqlDataProvider;
use kartik\mpdf\Pdf;
Use app\itbz\fpdf\src\fpdf\fpdf;

/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'tahun', 'index', 'mpdf', 'fpdf', 'musrenkeclamp2'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionMpdf() {
        $connection = \Yii::$app->db;
        $count      =   Yii::$app->db->createCommand('SELECT COUNT(id) FROM t_renja_kegiatan WHERE kd_bahas = 1')->queryScalar();
        $sql = "SELECT c.Nm_Sub_Unit, a.uraian AS kegiatan, a.pagu_kegiatan, a.pagu_musrenbang, b.biaya AS Usulan FROM t_renja_kegiatan a LEFT JOIN
            (SELECT renja_kegiatan_id, SUM(biaya) AS biaya FROM t_subkegiatan GROUP BY renja_kegiatan_id) b ON a.id = b.renja_kegiatan_id
            INNER JOIN r_sub_unit c ON a.kd_urusan = c.Kd_Urusan AND a.kd_bidang = c.Kd_Bidang AND a.kd_unit = c.Kd_Unit AND a.kd_sub = c.Kd_Sub
            WHERE a.kd_bahas = 1";
        $query = $connection->createCommand($sql);
        $data = $query->queryAll();         
        $dataProvider = new SqlDataProvider([
                'sql' => $sql,
                'totalCount' => $count,
            ]);

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('laporan', ['data' => $data, 'dataProvider' => $dataProvider]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'judulfile'],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Ine Header'], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }   

    public function actionFpdf()
    {
        $connection = \Yii::$app->db;
        $sql = "SELECT c.Nm_Sub_Unit, a.uraian AS kegiatan, a.pagu_kegiatan, a.pagu_musrenbang, b.biaya AS Usulan FROM t_renja_kegiatan a LEFT JOIN
            (SELECT renja_kegiatan_id, SUM(biaya) AS biaya FROM t_subkegiatan GROUP BY renja_kegiatan_id) b ON a.id = b.renja_kegiatan_id
            INNER JOIN r_sub_unit c ON a.kd_urusan = c.Kd_Urusan AND a.kd_bidang = c.Kd_Bidang AND a.kd_unit = c.Kd_Unit AND a.kd_sub = c.Kd_Sub
            WHERE a.kd_bahas = 1 LIMIT 0,10";
        $query = $connection->createCommand($sql);
        $data = $query->queryAll();           
        return $this->render('fpdf', ['data'=> $data,]);
    }      

    public function actionMusrenkeclamp2()
    {
        $id = 2;
        $ba_id = $id; //disiapkan untuk mengambil data berita acara. Data pertama u/ header laporan
        $connection = \Yii::$app->db;
        $sql = "CALL rpt_musrenKecLampII(4,1)";
        $query = $connection->createCommand($sql);
        $data = $query->queryAll();           
        return $this->render('rpt_musrenkeclamp2', ['data'=> $data,]);
    }         

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();
        $modelPeran = new Tperan();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

//Choose what year this application will use as default year --@hoaaah

    public function actionTahun($id)
    {
        $session = Yii::$app->session;
        IF($session['tahun']){
            $session->remove('tahun');
        }
        $session->set('tahun', $id);


        return $this->redirect(Yii::$app->request->referrer);
    }    
}
