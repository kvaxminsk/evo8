<?php

namespace app\modules\user\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use mdm\upload\UploadBehavior;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use app\modules\user\models\UserClient;
use app\modules\main\models\Order;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $username
 * @property string $auth_key
 * @property string $email_confirm_token
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_WAIT = 2;
    const SCENARIO_PROFILE = 'profile';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => self::className(), 'message' => Yii::t('app', 'Signup username busy')],
            ['username', 'string', 'min' => 3, 'max' => 255],
            
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::className(), 'message' => Yii::t('app', 'Signup email busy')],
            ['email', 'string', 'max' => 255],
            [['address', 'address_bank', 'comment'], 'string'],
            [['organization', 'phone', 's_account', 'servicing_bank', 'unp', 'okpo', 'mob_phone', 'names_person', 'avatar'], 'string', 'max' => 255],

            ['status', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => Yii::t('app', 'Create at'),
            'updated_at' => Yii::t('app', 'Update at'),
            'username' => Yii::t('app', 'Username'),            
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
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
//    public function behaviors()
//    {
//        return [
//            [
//                'class' => UploadBehavior::className(),
//                'attribute' => 'file',
//                'savedAttribute' => 'avatar',
//                'uploadPath' => '@webroot/uploads',
//            ]
//        ];
//    }
    public function behaviors() {
        return [
//            'timestamp' => [
//                'class' => TimestampBehavior::className(),
//                'value' => function() {
//                    return date('Y-m-d H:i:s');
//                },
//            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'file',
                'savedAttribute' => 'avatar',
                'uploadPath' => '@webroot/uploads',
            ]
        ];    
    }

//    public function scenarios() {
//        return [
//            self::SCENARIO_DEFAULT => ['username', 'email', 'status','organization', 'phone', 's_account', 'servicing_bank', 'unp', 'okpo', 'mob_phone', 'names_person', 'avatar'],
//            self::SCENARIO_PROFILE => ['email'],
//        ];
//    }
    
    /**
    * @inheritdoc
    */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
 
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('findIdentityByAccessToken is not implemented.');
    }
 
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
 
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    
    /**
     * Return name of the user status
     * @return type string 
     */
    public function getStatusName() 
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    } 
    
    public function getCountOrderActive() 
    {
        $model = new Order();
        $model = $model::findAll(['status' => [1,2,3],'client_id'=>$this->id]);
        return count($model);
    }
    
    public function getCountOrderUnActive()
    {
        $model = new Order();
        $model = $model::findAll(['status' => [3,4],'client_id'=> $this->id]);
        return count($model);
    }

    public function getRoleName()
    {
        $auth = Yii::$app->authManager;
        $assignment = $auth->getAssignments(Yii::$app->user->identity->getId());
        return end($assignment)->roleName;
    }
    
    /**
     * Return array is contain all status key and name of the status
     * @return type array
     */
    public static function getStatusesArray()
    {
        return [
            self::STATUS_BLOCKED => Yii::t('app', 'Status blocked'),
            self::STATUS_ACTIVE => Yii::t('app', 'Status active'),
            self::STATUS_WAIT => Yii::t('app', 'Status wait'),                
        ];
    }
    
    public function getUserClient()
    {
        return $this->hasOne(UserClient::className(), ['id' => 'user_id']);
    }
    
    /**
     * @param string $email_confirm_token
     * @return static|null
     */
    public static function findByEmailConfirmToken($email_confirm_token)
    {
        return static::findOne(['email_confirm_token' => $email_confirm_token, 'status' => self::STATUS_WAIT]);
    }
    
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }
    
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
     
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    
    /**
     * Generates email confirmation token
     */
    public function generateEmailConfirmToken()
    {
        $this->email_confirm_token = Yii::$app->security->generateRandomString();
    }
    
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }
    
    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }
 
    /**
     * Removes email confirmation token
     */
    public function removeEmailConfirmToken()
    {
        $this->email_confirm_token = null;
    }
    
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
