<?php

namespace app\modules\main\models;

use Yii;

/**
 * This is the model class for table "order_template".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $cvetnost
 * @property string $bumaga
 * @property string $tirazh
 * @property string $files
 * @property string $material
 * @property double $stoimost
 * @property integer $status
 * @property integer $manager_id
 * @property integer $kol
 */
class OrderTemplate extends Order
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_template';
    }    
}
