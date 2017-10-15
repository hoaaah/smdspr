<?php

namespace backend\modules\rpjmd\controllers;

use yii\web\Controller;

/**
 * Default controller for the `rpjmd` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
