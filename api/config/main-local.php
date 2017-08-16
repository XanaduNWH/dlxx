<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'dj3jE30_D03@34DFdep03kdmcmd+pe%3sxx',
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
			],
        ],
		'response' => [
			// ...
			'formatters' => [
				\yii\web\Response::FORMAT_JSON => [
					'class' => 'yii\web\JsonResponseFormatter',
					'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
					'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
					// ...
				],
			],
		],
        'urlManager' => [
            'enablePrettyUrl' => true,
			'enableStrictParsing' => true,
            'showScriptName' => false,
			'rules' => [
				['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => 'country',
					'tokens' => [
						'{id}' => '<id:\\w+>',
                    ],
				],
			],
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
