<?php

namespace backend\modules\musrenbangdesa;

use Yii;
use yii\web\Controller;

/**
 * musrenbangdesa module definition class
 */
class musrenbangdesa extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\musrenbangdesa\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        IF(!Yii::$app->user->isGuest){
            IF(Yii::$app->user->identity->kd_peran <> 5){
                Yii::$app->getSession()->setFlash('danger','Anda tidak memiliki hak akses');
                return Controller::redirect(['/site']);                
            }

        }ELSE{
            return Controller::redirect(['/site/login']);
        }
    }
}
