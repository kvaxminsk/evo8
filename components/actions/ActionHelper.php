<?php

namespace app\components\actions;

use Yii;

/**
 * Description of ActionHalper
 *
 * @author Robert Kuznetsov rvk.by
 */
class ActionHelper 
{

    public static function redirecToHome() 
    {
        $user = Yii::$app->user->identity;
        $response = Yii::$app->getResponse();
        if (empty($user)) {
            return $response->redirect('/login');
        }
        if ($user->roleName == 'admin') {
            return $response->redirect('/admin');
        }
        if ($user->roleName == 'manager') {
            return $response->redirect('/manager');
        }
        if ($user->roleName == 'client') {
            return $response->redirect('/client');
        }
    }

}
