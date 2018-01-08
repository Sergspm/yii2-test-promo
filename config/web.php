<?php

$config = [
	'id' => 'test-promo',

	'basePath' => dirname(__DIR__),

	'language' => 'ru-RU',

	'bootstrap' => ['log'],

	'aliases' => [
		'@bower' => '@vendor/bower-asset',
		'@npm' => '@vendor/npm-asset',
	],

	'components' => [

		'i18n' => [
			'translations' => [
				'yii*' => [
					'class'    => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/i18n',
					'fileMap'  => [
						'yii' => 'yii.php',
					],
				],
				'app*' => [
					'class'    => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/i18n',
					'fileMap'  => [
						'app/promo' => 'app-promo.php',
					],
				],
			],
		],

		'request' => [
			'enableCookieValidation' => true,
			'enableCsrfValidation' => true,
			'cookieValidationKey' => '48946848E7D7E7E2FE82D798DBAAC',
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
			]
		],

		'cache' => [
			'class' => 'yii\caching\FileCache',
		],

		'user' => [
			'identityClass' => 'app\models\User',
			'enableAutoLogin' => true,
		],

		'errorHandler' => [
			'errorAction' => 'site/error',
		],

		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			'useFileTransport' => true,
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

		'db' => require __DIR__ . '/db.php',

		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName'  => false,
			'rules' => [
				'/'                        => 'site/index',
				'create-promo-code'        => 'site/create-promo-code',
				'edit-promo-code/<id:\d+>' => 'site/edit-promo-code',

				'GET api/get-discount-info/<name:[a-zA-Z]+>' => 'api-promo-code-info/get-discount-info',
				'POST,PUT api/activate-discount'             => 'api-promo-code-info/activate-discount',
			],

		],
	],

	'params' => require __DIR__ . '/params.php',
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
	];

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
	];
}

return $config;