<?php

return [    
    'components' =>[
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=evo8',
            'username' => 'root',
            'password' => '',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'viewPath' => '@app/mail',
            'transport' => [
                'class' => 'Swift_MailTransport',
            ],
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'korol1011',
                'password' => 'xvxnpf6r',
                'port' => '587', // Port 25 is a very common port too
                'encryption' => 'tls', // It is often used, check your provider or mail server specs
//                'plugins' => [
//                    [
//                        'class' => 'Swift_Plugins_LoggerPlugin',
//                        'constructArgs' => [new Swift_Plugins_Loggers_ArrayLogger],
//                    ],
//                ],
            ],
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'smtp.mail.ru',
//                'username' => 'korol1011101@mail.ru',
//                'password' => 'XVXNPF^R',
//                'port' => '587',
//                'encryption' => 'tls',
//                'plugins' => [
//                    [
//                        'class' => 'Swift_Plugins_ThrottlerPlugin',
//                        'constructArgs' => [20],
//                    ],
//                ],
//            ],
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'smtp.gmail.com',
//                'username' => 'korol101110@gmail.com',
//                'password' => 'XVXNPF^R',
//                'port' => '486',
//                'encryption' => 'ssl',
//            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],        
    ]
];
