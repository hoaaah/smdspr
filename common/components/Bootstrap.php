<?php    
    namespace common\components;
    use Yii;
    use yii\base\BootstrapInterface;


class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        // Here you can refer to Application object through $app variable
        $app->params['uploadPath'] = Yii::getAlias('@common') . '/web/unggah/usulan/';
        $app->params['uploadUrl'] = Yii::$app->assetManager->getPublishedUrl('@common/web/unggah/usulan');;
        // declare $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
        //panggil <?= $directoryAsset >/img/logo.png"
    }         
}