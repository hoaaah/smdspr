<?php

namespace backend\modules\musrenbangkecamatan;
use Yii;
use yii\web\Controller;
/**
 * musrenbangkecamatan module definition class
 */
class musrenbangkecamatan extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\musrenbangkecamatan\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        IF(!Yii::$app->user->isGuest){
            IF(Yii::$app->user->identity->kd_peran <> 4){
                Yii::$app->getSession()->setFlash('danger','Anda tidak memiliki hak akses');
                return Controller::redirect(['/site']);                
            }

        }ELSE{
            return Controller::redirect(['/site/login']);
        }
    }
}
