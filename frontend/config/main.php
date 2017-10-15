<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'SIMDA Perencanaan',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'common\components\Bootstrap',
    ],
    'controllerNamespace' => 'frontend\controllers',
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
        'musrenbang' => [
            'class' => 'frontend\modules\musrenbang\musrenrw',
        ],        
        'musrenrw' => [
            'class' => 'frontend\modules\musrenrw\musrenrw',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],        
    ],    
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_frontendUser', // unique for frontend
                'path'=>'/frontend/web'  // correct path for the frontend app.
            ]            
        ],
        'session' => [
            'name' => '_frontendSessionId', // unique for frontend
            'savePath' => __DIR__ . '/../runtime', // a temporary folder on frontend
        ],        
        //coba controller for all ----@hoaaah
        'controller' => [
                'class' => 'frontend\components\CommonController'
        ],
        //formatter for null display mengganti not-set ----@hoaaah
        'formatter' => [
                'class' => 'yii\i18n\Formatter',
                'nullDisplay' => '<span class="not-set">Tidak Diisi</span>',
                'thousandSeparator' => '.',
                'decimalSeparator' => ',',
                'currencyCode' => 'IDR',           
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
		
		'assetManager' => [
			'bundles' => [
				'dmstr\web\AdminLteAsset' => [
					'skin' => 'skin-blue',
				],
			],
		],	
		*/
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
