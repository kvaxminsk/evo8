<?php

namespace app\modules\user\models;

use Yii;
use mdm\upload\UploadBehavior;

/**
 * This is the model class for table "user_manager".
 *
 * @property integer $id
 * @property string $fio
 * @property string $phone
 * @property string $email
 * @property string $info
 * @property string $avatar
 */
class UserManager extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'file',
                'savedAttribute' => 'avatar',
                'uploadPath' => '@webroot/uploads',
            ]            
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_manager';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['fio', 'info'], 'string'],
            [['phone', 'email', 'avatar'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'Е-майл',
            'info' => 'Дополнительная информация',
            'avatar' => 'Аватар',
            'user_id' => 'Id of the manager',
        ];
    }
}
