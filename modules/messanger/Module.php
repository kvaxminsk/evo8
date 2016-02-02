<?php

namespace app\modules\messanger;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\messanger\controllers';
    public $defaultRout = 'handler';
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
