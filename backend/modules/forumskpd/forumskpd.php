<?php

namespace backend\modules\forumskpd;

use Yii;
use yii\web\Controller;

/**
 * forumskpd module definition class
 */
class forumskpd extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\forumskpd\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        IF(!Yii::$app->user->isGuest){
            IF(Yii::$app->user->identity->kd_peran <> 2){
                Yii::$app->getSession()->setFlash('danger','Anda tidak memiliki hak akses');
                return Controller::redirect(['/site']);                
            }

        }ELSE{
            return Controller::redirect(['/site/login']);
        }
        
    }
}
