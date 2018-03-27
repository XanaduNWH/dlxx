<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-oauth',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'oauth\controllers',
	'modules' => [
		'user' =>[
			'class' => 'oauth\modules\user\Module',
		],
	],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-oauth',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => TRUE,
            'identityCookie' => ['name' => '_identity-oauth_Yii2-learning', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the oauth
            'name' => 'Yii2-learning-oauth',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,

        ],
    ],
    'params' => $params,
];
