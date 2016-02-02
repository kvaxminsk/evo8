<?php

namespace app\modules\user\models;

use Yii;
use mdm\upload\UploadBehavior;
use app\modules\user\models\User;

/**
 * This is the model class for table "user_client".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $organization
 * @property string $address
 * @property string $phone
 * @property string $s_account
 * @property string $servicing_bank
 * @property string $address_bank
 * @property string $unp
 * @property string $okpo
 * @property string $comment
 * @property string $mob_phone
 * @property string $names_person
 * @property string $avatar
 */
class UserClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'manager_id'], 'integer'],
            [['address', 'address_bank', 'comment'], 'string'],
            [['organization', 'phone', 's_account', 'servicing_bank', 'unp', 'okpo', 'mob_phone', 'names_person', 'avatar'], 'string', 'max' => 255]
        ];
    }
    
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'manager_id' => 'Manager ID',
            'organization' => 'Организация',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            's_account' => 'Расчетный счет в банке',
            'servicing_bank' => 'Обслуживающий банк',
            'address_bank' => 'Адрес банка',
            'unp' => 'УНП',
            'okpo' => 'ОКПО',
            'comment' => 'Комментарий',
            'mob_phone' => 'Мобильный телефон',
            'names_person' => 'Контактный лица',
            'avatar' => 'Аватар',
        ];
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'id']);
    }
}
