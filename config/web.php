<?php

$config = [    
    'components' => [
        'defaultRoute' => 'main/default/index',
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,            
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/default/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'main/default/error',
        ],        
        'request' => [          
            'cookieValidationKey' => 'q-IJ-YKxsHRGRw4NuhSveF1YR7JaMNcB',
        ],        
    ],
    'modules' => [
        'main' => [
            'class' => 'app\modules\main\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'rbac' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'mainLayout' => '@app/views/layouts/main.php',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'app\modules\user\models\User',
                    'idField' => 'id'
                ],          
            ],
        ],
        'manager' => [
            'class' => 'app\modules\manager\Module',
        ],
        'client' => [
            'class' => 'app\modules\client\Module',
        ],
        'messanger' => [
            'class' => 'app\modules\messanger\Module',
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'main/*',
            'admin/*',
            'manager/*',
            'client/*',
            'rbac/*',
            'user/*',
            'gii/*',
            'debug/*',
            'file/*',
            'messanger/*',
        ]
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
