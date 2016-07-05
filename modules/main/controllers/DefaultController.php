<?php

namespace app\modules\main\controllers;

use yii\web\Controller;
use app\components\actions\ActionHelper;

class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    public function actionIndex()
    {
        //die('fff');
        ActionHelper::redirecToHome();
        return $this->render('index');
    }
    
    public function actionDev()
    {
        return $this->render('dev');
    }
}
