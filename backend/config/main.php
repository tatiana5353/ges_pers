<?php

use yii\web\Request;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

/* use \yii\web\Request; */

include 'urlManager.php';

$baseUrl = str_replace('/backend/web', '/admin', (new Request())->getBaseUrl());

return [
    'language' => 'fr',
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
	   'request' => [
            'baseUrl' => $baseUrl,
            'enableCookieValidation' => true,
            'cookieValidationKey' => 'f763603732269fb75965b4a470455cf16b045326',
            //'class' => 'yii\web\Request',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            /* 'loginUrl' => ['site/login', 'error' => 'Nom d\'utilisateur ou mot de passe incorrect.'], */
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
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => $tab_url,
        ],
    ],
    'params' => $params,
    /* 'params' => require(__DIR__ . '/params.php'), */
    
];
