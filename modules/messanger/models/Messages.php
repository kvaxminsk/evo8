<?php

namespace app\modules\messanger\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "messanger".
 *
 * @property integer $id
 * @property integer $id_chat
 * @property integer $from_user
 * @property integer $to_user
 * @property string $message
 * @property string $created_at
 */
class Messages extends \yii\db\ActiveRecord
{
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'created_at',
                'value' => new Expression('NOW()'),
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messanger';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_chat', 'from_user', 'to_user'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_chat' => 'Id Chat',
            'from_user' => 'From User',
            'to_user' => 'To User',
            'message' => 'Message',
            'created_at' => 'Created At',
        ];
    }
}
