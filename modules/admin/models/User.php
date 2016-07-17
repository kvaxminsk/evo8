<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\ArrayHelper;

class User extends \app\modules\user\models\User
{
    const SCENARIO_CREATE_USER = 'createUser';
    const SCENARIO_UPDATE_USER = 'updateUser';

    public $newPassword;
    public $newPasswordRepeat;
    
    public function rules() {
        return ArrayHelper::merge(parent::rules(), [
            [['newPassword', 'newPasswordRepeat'], 'required', 'on' => self::SCENARIO_CREATE_USER],
            ['newPassword', 'string', 'min' => 6],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
        ]);
    }

    public function scenarios()
    {
        return ArrayHelper::merge(parent::scenarios(), [
            self::SCENARIO_CREATE_USER => ['username', 'email', 'status', 'newPassword', 'newPasswordRepeat'],
            self::SCENARIO_UPDATE_USER => ['username', 'email', 'status', 'newPassword', 'newPasswordRepeat'],
        ]);
    }

    public function beforeSave($insert) {
        if(parent::beforeSave($insert))
        {
            if(!empty($this->newPassword))
            {
                $this->setPassword($this->newPassword);
            }
            return true;
        }
        return false;
    }

    public function attributeLabels() {
        return \yii\helpers\ArrayHelper::merge(parent::attributeLabels(), [
            'newPassword' => 'Новый пароль',
            'newPasswordRepeat' => 'Повтор нового пароля',
        ]);
    }
}
