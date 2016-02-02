<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\client\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\main\models\Order;
/**
 * Description of OrderSearch
 *
 * @author mr
 */
class OrderSearch extends Model
{
    public $type_id;
    public $cvetnost;
    
    public function rules() {
        return [
            [['type_id', 'cvetnost'], 'string'],
        ];
    }
    
    public function searchMyOrders($params)
    {
        $q = Order::find()->where(['client_id' => Yii::$app->user->getId()]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $q,
        ]);
        
        $this->load($params);
        if(!$this->validate())
        {
            return $dataProvider;
        }
        
        $q->andFilterWhere([ 'type_id' => $this->type_id ])
                ->andFilterWhere(['like', 'cvetnost', $this->cvetnost]);
        
        return $dataProvider;
    }
}
