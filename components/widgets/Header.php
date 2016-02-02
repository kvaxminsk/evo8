<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components\widgets;

use Yii;
use yii\base\Widget;
use app\modules\user\models;
/**
 * Description of Header
 *
 * @author Robert Kuznetsov <RK at buildinggame.ru>
 */
class Header extends Widget
{
    protected $nameImg;
    public function init()
    {
        if(!strcmp(Yii::$app->user->identity->roleName, 'manager')) {
            $user = models\UserManager::findOne(['user_id' => Yii::$app->user->getId()]);
        }
        
        if(!strcmp(Yii::$app->user->identity->roleName, 'client')) {
            $user = models\UserClient::findOne(['user_id' => Yii::$app->user->getId()]);
        }
                    
        if(empty($user)) {
            $this->nameImg = '1';
        } else {
            $this->nameImg = $user->avatar;
        }
    }
    
    public function run()
    {
        return $this->render('header', [
            'nameImg' => $this->nameImg,
        ]);
    }
}
