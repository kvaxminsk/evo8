<?php

namespace app\modules\main\models;

use app\modules\admin\models\Product;
use Yii;
use app\modules\user\models\UserManager;
use yii\behaviors\TimestampBehavior;
use mdm\upload\UploadBehavior;
use app\modules\user\models\User;
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
    const STATUS = 1;
    const STATUS1 = 2;
    const STATUS2 = 3;
    const STATUS3 = 4;
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
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'file',
                'savedAttribute' => 'files',
                'uploadPath' => '@webroot/uploads/files',
            ]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'status', 'client_id','manager_id'], 'integer'],
            [['comment', 'data'], 'string'],
            [['stoimost'], 'number'],
            [['date'], 'date'],
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
            'product_id' => 'Type ID',
            'created_at' => 'Создан',
            'updated_at' => 'Отредактирован',
            'comment' => 'Цветность',
            'data' => 'Бумага',
            'files' => 'Файлы',
            'stoimost' => 'Стоимость',
            'status' => 'Статус',
            'manager_id' => 'Менеджер',
            'client_id' => 'Клиент',
            'date' => "Дата готовности"
        ];
    }
    
    public function getManager()
    {
        return $this->hasOne(UserManager::className(), ['user_id' => 'manager_id']);
    }
    
    public function getName() 
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id'])->one()->name;
    }
    
    public static function getStatusesArray()
    {
        return [
            self::STATUS => 'Новый',
            self::STATUS1 => 'В обработке',
            self::STATUS2 => 'В работе',
            self::STATUS3 => 'Завершен',
        ];
    }
    

    public function getStatusName()
    {
        return self::getStatusesArray()[$this->status];
    }
    public function getClientOrganization()
    {
        $model = new User();
        $model = $model::find()->where(['id'=> $this->client_id])->one();

        return $model->organization;
    }
    public static function countMyOrder()
    {
        return self::find()->where(['client_id' => Yii::$app->user->getId(),'status' => [1,2,3]])->count();
    }
}
