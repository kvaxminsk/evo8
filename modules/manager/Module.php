<?php

namespace app\modules\manager;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\manager\controllers';
    public $layout = '@app/views/layouts/manager';
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
