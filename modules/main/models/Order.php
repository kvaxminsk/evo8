<?php

namespace app\modules\main\models;

use Yii;
use app\modules\user\models\UserManager;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $cvetnost
 * @property string $bumaga
 * @property string $tirazh
 * @property string $files
 * @property string $material
 * @property double $stoimost
 * @property integer $status
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS = 0;
    const STATUS1 = 1;
    const STATUS2 = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    public function behaviors() 
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new \yii\db\Expression('NOW()'),
            ]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'status', 'client_id', 'manager_id'], 'integer'],
            [['cvetnost', 'bumaga', 'tirazh', 'material'], 'string'],
            [['stoimost'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['files'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Type ID',
            'created_at' => 'Создан',
            'updated_at' => 'Отредактирован',
            'cvetnost' => 'Цветность',
            'bumaga' => 'Бумага',
            'tirazh' => 'Тираж',
            'files' => 'Файлы',
            'material' => 'Материал',
            'stoimost' => 'Стоимость',
            'status' => 'Статус',
            'manager_id' => 'Менеджер',
            'client_id' => 'Клиент',
            'kol' => 'Количество',
        ];
    }
    
    public function getManager()
    {
        return $this->hasOne(UserManager::className(), ['user_id' => 'manager_id']);
    }
    
    public function getTypeName() 
    {
        return $this->hasOne(OrderTypes::className(), ['id' => 'type_id'])->one()->name;
    }
    
    public static function getStatusesArray()
    {
        return [
            self::STATUS => 'статус',
            self::STATUS1 => 'статус1',
            self::STATUS2 => 'статус2',
        ];
    }
    
    public function getStatusName()
    {
        return self::getStatusesArray()[$this->status];
    }
    
    public static function countMyOrder()
    {
        return self::find()->where(['client_id' => Yii::$app->user->getId()])->count();
    }
}
