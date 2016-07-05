<?php

use yii\helpers\ArrayHelper;

$params = ArrayHelper::merge(
    require(__DIR__.'/params.php'),
    require(__DIR__.'/params-local.php')
);

return [
    'id' => 'basic',
    'name' => 'Evoline',
    'language' => 'ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'main/default/index',
                'contact' => 'main/contact/index',
                '<_a:error>' => 'main/default/<_a>',                
                '<_a:(login|logout|signup|confirm-email|request-password-reset|reset-password)>' => 'user/default/<_a>',
                
                '<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_c>/<_a>',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/<_a>',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
                '<_m:[\w\-]+>' => '<_m>/default/index',
                '<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
            ],
        ],
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'useFileTransport' => false,
//            'viewPath' => '@app/mail'
////            'useFileTransport' => false,
////            'messageConfig' => [
////                'charset' => 'UTF-8',
////            ],
////            'transport' => [
////                'class' => 'Swift_SmtpTransport',
////                'host' => 'smtp.google.com',
////                'username' => 'korol101110@gmail.com',
////                'password' => 'XVXNPF^R',
////                'port' => '465',
////            ],
////            'class' => 'yii\swiftmailer\Mailer',
////            'viewPath' => '@app/mailer',
////            'useFileTransport' => false,
////            'transport' => [
////                'class' => 'Swift_SmtpTransport',
////                'host' => 'smtp.gmail.com',
////                'username' => 'korol101110@gmail.com',
////                'password' => 'XVXNPF^R',
////                'port' => '587',
////                'encryption' => 'tls',
////            ],
//        ],
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'useFileTransport' => false,
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'smtp.gmail.com',
//                'username' => 'korol101110@gmail.com',
//                'password' => 'XVXNPF^R',
//                'port' => '587',
//                'encryption' => 'tls',
//            ],
//        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ]
            ]
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ]
    ],    
    'params' => $params,
    'controllerMap' => [
        'file' => 'mdm\upload\FileController',
        'massanger' => [
            'class' => 'app\components\messanger\MessangerController',
            'enableCsrfValidation' => false,
        ],
        
    ],
];

