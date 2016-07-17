<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\manager\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\modules\manager\models\OrderSearch;
use app\modules\manager\models\OrderTemplateSearch;
use app\components\actions\ItemsList;
use app\components\actions\CreateRecord;
use app\components\actions\UpdateRecord;
use yii\data\ActiveDataProvider;
use app\modules\main\models\Order;
use app\modules\admin\models\Product;
use app\modules\admin\models\Category;
use app\modules\admin\models\SubCategory;
use yii\helpers\ArrayHelper;

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
    
    public function actionIndex($id=null,$status=null)
    {
        $model = new Order();
        if($id) {
           /// $i =1;
//            foreach ($model::find()->where(['client_id' => $id])->all() as $key) {
//                echo $key->id. ' -' . ($i++). '<br/>';
//            }
            $provider = new ActiveDataProvider([
                'query' => $model::find()->where(['client_id' => $id]),
                'pagination' => [
                    'pageSize' => 20,
                ]
            ]);
        }
        elseif($status) {
            $statusOrder = $status;
            $provider = new ActiveDataProvider([
                'query' => $model::find()->where(['status' => $status]),
                'pagination' => [
                    'pageSize' => 20,
                ]
            ]);
        }
        else
        {
            $provider = new ActiveDataProvider([
                'query' => $model::find(),
                'pagination' => [
                    'pageSize' => 20,
                ]
            ]);
        }

//        $searchModel = new OrderSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
//            'searchModel' => $searchModel,
            'dataProvider' => $provider,
            'statusOrder' => $statusOrder,
        ]);
    }
    public function actionShowOrder($id=null)
    {

        $model = new Order();
        $model =$model::findOne(['id'=> $id]);
        //var_dump($model->product_id);die();



        $products = Product::find()->asArray()->all();
        $listProducts = ArrayHelper::map($products, 'id', 'name');



        $categories = Category::find()->asArray()->all();
        $listCategories = ArrayHelper::map($categories, 'id', 'name');
        $subCategories = SubCategory::find()->asArray()->all();
        $listSubCategories = ArrayHelper::map($subCategories, 'id', 'name');





        return $this->render('showOrder', [
            'model' => $model,
            'listProducts' => $listProducts,
            'listCategories' => $listCategories,
            'listSubCategories' => $listSubCategories,
        ]);
    }


    public function actionChangeStatus($id=null,$status=null)
    {

        $model = new Order();
        $model =$model::findOne(['id'=> $id]);
        //var_dump($model->product_id);die();
        $model->status=$status;
        $model->save();


        return '';
    }
}
