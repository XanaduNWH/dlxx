<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
	'modules' => [
		'users' => [
			'class' => 'api\modules\users\Module',
		],
	],
    'components' => [
        'request' => [
			'enableCookieValidation' => false,
        ],
        'user' => [
			'loginUrl' => NULL,
            'identityClass' => 'common\models\User',
            'enableSession' => FALSE,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
			'enableStrictParsing' => true,
            'showScriptName' => false,
			'rules' => [
//				['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
				['class' => 'yii\rest\UrlRule', 'controller' => 'users/user'],
				['class' => 'yii\rest\UrlRule', 'controller' => 'thread'],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'country',
					'tokens' => [
						'{id}' => '<id:\\w+>',
                    ],
				],
			],
        ],
		'response' => [
			'format' => \yii\web\Response::FORMAT_JSON,
			'formatters' => [
				\yii\web\Response::FORMAT_JSON => [
					'class' => 'yii\web\JsonResponseFormatter',
					'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
					'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
				],
			],
		],
    ],
    'params' => $params,
];
