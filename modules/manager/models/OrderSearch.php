<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\manager\models;

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
    public $type;
    public $cvetnost;
    
    public function rules() {
        return [
            [['type', 'cvetnost'], 'string']
        ];
    }
    
    public function attributeLabels() {
        return [
            'type' => 'Тип',
            'cvetnost' => 'Цветность',
        ];
    }
    
    public function search($params) 
    {
        $q = Order::find()->where([
            'manager_id' => Yii::$app->user->getId(),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $q
        ]);
        
        $this->load($params);
        if(!$this->validate()) {
            return $dataProvider;
        }
        
        $q->andFilterWhere([
            'type' => $this->type,
        ])->andFilterWhere(['like', 'cvetnost', $this->cvetnost]);
        
        return $dataProvider;
    }
}
