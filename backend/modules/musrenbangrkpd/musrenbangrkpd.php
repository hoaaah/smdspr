<?php

namespace backend\modules\musrenbangrkpd;

use Yii;
use yii\web\Controller;

/**
 * musrenbangrkpd module definition class
 */
class musrenbangrkpd extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\musrenbangrkpd\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        IF(!Yii::$app->user->isGuest){
            IF(!(in_array(Yii::$app->user->identity->kd_peran, [1,2,3 /* 8 */]))){
                Yii::$app->getSession()->setFlash('danger','Anda tidak memiliki hak akses');
                return Controller::redirect(['/site']);                
            }

        }ELSE{
            return Controller::redirect(['/site/login']);
        }
    }
}
