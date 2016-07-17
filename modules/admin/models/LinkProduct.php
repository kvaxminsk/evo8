<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "link_product".
 *
 * @property integer $id
 * @property integer $id_product
 * @property integer $id_category
 * @property integer $id_sub_category
 */
class LinkProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'link_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'id_category', 'id_sub_category'], 'required'],
            [['id_product', 'id_category', 'id_sub_category'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_product' => 'Id Product',
            'id_category' => 'Id Category',
            'id_sub_category' => 'Id Sub Category',
        ];
    }
}
