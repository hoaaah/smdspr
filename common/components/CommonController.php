<?php    
    namespace common\components;
    use Yii;
    use yii\base\BootstrapInterface;

    class CommonController extends \yii\web\Controller
    {
        public function init(){
            parent::init();

        }
        public function Hello(){
            return "Hello Yii2";
        }
        // This function digunakan untuk meresume angka
        public function angkasingkat($value) 
        {

            $abbreviations = array(12 => 'T', 9 => 'M', 6 => 'Jt', 3 => 'K', 0 => '');

            foreach($abbreviations as $exponent => $abbreviation) 
            {

                if($value >= pow(10, $exponent)) 
                {

                    return round(floatval($value / pow(10, $exponent))).$abbreviation;

                }

            }

        }         
    }