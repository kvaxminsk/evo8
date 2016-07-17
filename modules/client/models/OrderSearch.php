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
    public $product_id;
    public $comment;
    
    public function rules() {
        return [
            [['product_id', 'comment'], 'string'],
        ];
    }
    
    public function searchMyOrders($params)
    {
        $q = Order::find()->where(['client_id' => Yii::$app->user->getId(), 'status' => [1,2,3]]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $q,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        
        $this->load($params);
        if(!$this->validate())
        {
            return $dataProvider;
        }
        
        $q->andFilterWhere([ 'product_id' => $this->product_id ])
                ->andFilterWhere(['like', 'comment', $this->comment]);
        
        return $dataProvider;
    }
    public function searchMyOrders2($params)
    {
        $q = Order::find()->where(['client_id' => Yii::$app->user->getId(), 'status' => [5]]);

        $dataProvider = new ActiveDataProvider([
            'query' => $q,
        ]);

        $this->load($params);
        if(!$this->validate())
        {
            return $dataProvider;
        }

        $q->andFilterWhere([ 'product_id' => $this->product_id])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
