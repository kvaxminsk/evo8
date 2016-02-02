<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\manager\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\modules\manager\models\OrderSearch;
use app\modules\manager\models\OrderTemplateSearch;
use app\components\actions\ItemsList;
use app\components\actions\CreateRecord;
use app\components\actions\UpdateRecord;

/**
 * Description of OrderController
 *
 * @author mr
 */
class OrderController extends Controller
{
    private $_orderTemplate = '\app\modules\main\models\OrderTemplate';
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['root', 'manager'],
                    ],
                ]
            ],
        ];
    }
    
    public function actions()
    {
        return [
            'template' => [
                'class' => ItemsList::className(),
                'view' => 'template',
                'searchClass' => OrderTemplateSearch::className(),
                'searchMethod' => 'search',
            ],
            'create-template' => [
                'class' => CreateRecord::className(),
                'view' => 'createTemplate', 
                'modelClass' => $this->_orderTemplate,
                'redirectAction' => 'template',
            ],
            'update-template' => [
                'class' => UpdateRecord::className(),
                'view' => 'updateTemplate',
                'modelClass' => $this->_orderTemplate,
                'redirectAction' => '/manager/order/template',
                'findAttribute' => 'id',
            ]
        ];
    }
    
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
