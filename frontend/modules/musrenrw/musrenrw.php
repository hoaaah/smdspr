<?php

namespace frontend\modules\musrenrw;
use Yii;
use common\models\Jadwal;
/**
 * musrenrw module definition class
 */
class musrenrw extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\musrenrw\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $jadwal = Jadwal::find()->where('tahun =:tahun', [':tahun' => DATE('Y')+1])->andWhere('input_phased=:input', [':input' => 2])->one();   
             
        parent::init();
        IF(!Yii::$app->user->isGuest){
            IF(Yii::$app->user->identity->kd_peran == 1) {
                $rw = 1;
            }ELSE{
                $rw = 0;
            }
        }ELSE{
            $rw = 0;
        }         
        //IF(Yii::$app->user->identity->kd_peran <> 5) {
          //  Yii::$app->user->logout();
            //return $this->redirect(['/site/login']);
        //}
        // custom initialization code goes here
    }
}
