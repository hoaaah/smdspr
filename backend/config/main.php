<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'name' => 'Dashboard',    
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log', 'common\components\Bootstrap',],
    'modules' => [
        'gii' => [
            'class'      => 'yii\gii\Module',
            'generators' => [
                'crud'   => [
                    'class'     => 'yii\gii\generators\crud\Generator',
                    'templates' => ['modalcrud' => '@common/templates/modalcrud']
                ]
            ]
        ],        
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
        'management' => [
            'class' => 'backend\modules\management\management',
        ],   
        'parameter' => [
            'class' => 'backend\modules\parameter\paremeter',
        ],
        'datamanagement' => [
            'class' => 'backend\modules\datamanagement\datamanagement',
        ],        
        'musrenbangdesa' => [
            'class' => 'backend\modules\musrenbangdesa\musrenbangdesa',
        ],
        'musrenbangkecamatan' => [
            'class' => 'backend\modules\musrenbangkecamatan\musrenbangkecamatan',
        ],
        'forumskpd' => [
            'class' => 'backend\modules\forumskpd\forumskpd',
        ],
        'musrenbangrkpd' => [
            'class' => 'backend\modules\musrenbangrkpd\musrenbangrkpd',
        ],   
        'rkpdrenja' => [
            'class' => 'backend\modules\rkpdrenja\rkpdrenja',
        ],
        'rpjmdrenstra' => [
            'class' => 'backend\modules\rpjmdrenstra\rpjmdrenstra',
        ],
        'rpjmd' => [
            'class' => 'backend\modules\rpjmd\rpjmd',
        ],
        'renstra' => [
            'class' => 'backend\modules\renstra\renstra',
        ],
        'rkpd' => [
            'class' => 'backend\modules\rkpd\rkpd',
        ],
        'renja' => [
            'class' => 'backend\modules\renja\renja',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_backendUser', // unique for backend
                'path'=>'/backend/web'  // correct path for the backend app.
            ]            
        ],
        'session' => [
            'name' => '_backendSessionId', // unique for backend
            'savePath' => __DIR__ . '/../runtime', // a temporary folder on backend
        ],
        //formatter for null display mengganti not-set ----@hoaaah
        'formatter' => [
                'class' => 'yii\i18n\Formatter',
                'nullDisplay' => '<span class="not-set">Tidak Diisi</span>',
                'currencyCode' => 'IDR',           
                'thousandSeparator' => '.',
                'decimalSeparator' => ',',                
        ],        
        /* for testing the theme you want, you can actually use this for all web, but I think you don't want to edit any vendors component ----@hoaaah
        'view' => [
             'theme' => [
                 'pathMap' => [
                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                 ],
             ],
        ],        
        */
        //This for using costumize bundle manager, use this only if you are using another bundle manager, if not jus comment it ----@hoaaah
        /*List of bundle manager for admin-LTE theme, you can change the "skin" directly
        "skin-blue",
        "skin-black",
        "skin-red",
        "skin-yellow",
        "skin-purple",
        "skin-green",
        "skin-blue-light",
        "skin-black-light",
        "skin-red-light",
        "skin-yellow-light",
        "skin-purple-light",
        "skin-green-light"
        ----@hoaaah
        */        
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-green',
                ],
            ],
        ],  
        //End of Bundle manager ----@hoaaah        
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        //Enable pretty URL. To make it real pretty, edit your .htaccess to get rid index.php ----@hoaaah
        'urlManager' => [
            //'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                  '<controller:\w+>/<id:\d+>' => '<controller>/view',
                  '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                  '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
