<?php

namespace app\modules\client\controllers;

use Yii;
use yii\web\Controller;
use app\modules\user\models\UserClient;
use app\components\actions;
use app\modules\client\models;
use app\modules\main;

class DefaultController extends Controller
{
    public $defaultAction = 'my-orders';
    
    public function actions() {
        return [
            'my-orders' => [
                'class' => actions\ItemsList::className(),
                'view' => 'myOrders',
                'searchClass' => models\OrderSearch::className(),
                'searchMethod' => 'searchMyOrders',
            ],            
        ];
    }
    
    public function actionIndex() 
    {
        return $this->redirect(['my-orders']);
    }
    
    public function actionCreateOrder()
    {
        $model = new main\models\Order();
        $clientId = Yii::$app->user->getId();
        $model->client_id = $clientId;
        $model->manager_id = UserClient::findOne(['user_id' => $clientId])->manager_id;
        $model->status = 1;
        
        $typesOrder = main\models\OrderTypes::find()->asArray()->all();
        $typesOrder = \yii\helpers\ArrayHelper::map($typesOrder, 'id', 'name');
        
        if($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->session->setFlash('success', 'Добавлена');
            return $this->redirect('my-orders');
        } else {
            return $this->render('createOrder', [
                'model' => $model,
                'typesOrder' => $typesOrder,                
            ]);
        }
    }
}