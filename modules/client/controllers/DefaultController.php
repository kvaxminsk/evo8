<?php

namespace app\modules\client\controllers;


use Yii;
use yii\web\Controller;
use app\modules\user\models\UserClient;
use app\modules\user\models\User;
use app\components\actions;
use app\modules\client\models;
use app\modules\main;
use yii\base\Action;
use yii\helpers\ArrayHelper;
use app\modules\main\models\Order;
use app\modules\admin\models\Product;
use app\modules\admin\models\Category;
use app\modules\admin\models\SubCategory;
use app\modules\admin\models\LinkProduct;
use app\modules\user\models\UserManager;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\actions\ItemsList;
class DefaultController extends Controller
{
    public $defaultAction = 'my-orders';
    
    public function actions() {

//        $searchModel = Yii::createObject($this->searchClass);
//        $dataProvider = $searchModel->{$this->searchMethod}(Yii::$app->request->queryParams);
//
//        return $this->controller->render($this->view, [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);

        return [
            'my-orders' => [
                'class' => actions\ItemsList::className(),
                'view' => 'myOrders',
                'searchClass' => models\OrderSearch::className(),
                'searchMethod' => 'searchMyOrders',
            ],
            'archive' => [
                'class' => actions\ItemsList::className(),
                'view' => 'myOrdersArchive',
                'searchClass' => models\OrderSearch::className(),
                'searchMethod' => 'searchMyOrders2',
            ],
        ];
    }
    public function actionAddArchive($id) {

        $model = new Order();
        $model = $model::findOne(['id'=>$id]);

        $model->status = 5;
        $model->save();
        return $this->redirect('/');
    }
    public function actionDeleteArchive($id) {

        $model = new Order();
        $model = $model::findOne(['id'=>$id]);

        $model->status = 1;
        $model->save();
        return $this->redirect('/');
    }
    public function actionDelete($id) {

        $model = new Order();
        $model = $model::findOne(['id'=>$id]);

        $model->delete();
        return $this->redirect('/');
    }
//    public function actionArchive() {
//        return [
//                'class' => actions\ItemsList::className(),
//                'view' => 'myOrdersArchive',
//                'searchClass' => models\OrderSearch::className(),
//                'searchMethod' => 'searchMyOrders2',
//        ];
//    }
    public function actionIndex() 
    {

        return $this->redirect(['my-orders']);
    }
    public function actionUpdateClientProfile($id)
    {
        $model = new User();
        $model = $model::findOne(['id' => $id]);
        $model->password_hash = '';
        if(Yii::$app->request->post()) {
//            var_dump();
//            die();
            if (Yii::$app->request->post()['User']['password_hash'] == "") {
                unset(Yii::$app->request->post()['User']['password_hash']);
            }
            if ($model->load(Yii::$app->request->post())) {
//                foreach (Yii::$app->request->post() as $key =>$value) {

                if (Yii::$app->request->post()['User']['password_hash'] != "") {
                   // var_dump(Yii::$app->request->post()['User']['password_hash']!= ""); echo "<br>";
                    $model->setPassword(Yii::$app->request->post()['User']['password_hash']);

                }
                if ($model->save()) {
                    $model->password_hash = '';$model->password_hash = '';
                    return $this->render('profile', [
                        'model' => $model,
                    ]);
                }
            }
        }
        else
        {
            return $this->render('profile', [
                'model' => $model,
            ]);
        }
//        return ArrayHelper::merge(parent::actions(), [
//            'update-client-profile' => [
//                    'class' => actions\UpdateProfile::className(),
//                    'view' => '@app/modules/client/views/default/ownProfile.php',
//                    'redirectAction' => '/',
//                    'modelClass' => 'app\modules\user\models\UserManager',
//                    'isManagerProfile' => true,
//            ],
//        ]);
    }




    public function actionShowInfoProduct()
    {
        $id=(int) $_POST['id'];
        $out = '<div class="wrap-block">';
        $modelProduct = Product::findOne(['id'=>$id]);


        $modelLinkProduct = LinkProduct::find()->where(['id_product'=>$id])->all();
        //var_dump(count($modelLinkProduct));die();
       // $out = "<b>" . $modelProduct->name . "</b>";
        $modelCategory = null;
        foreach ($modelLinkProduct as $linkProduct)
        {
            //ar_dump($modelCategory->id.'----'.$linkProduct->id_category);
            //var_dump($modelCategory->id != $linkProduct->id_category);
            if ($modelCategory->id != $linkProduct->id_category) {

                $modelCategory = Category::findOne(['id'=> $linkProduct->id_category]);

                $out .= "<div class='container-info border-con'>
								<p>" . $modelCategory->name . "</p></div>";
                $out .= "<input type='hidden' name='category[]" ."' value='" .  $modelCategory->id  . "'>";
                switch ($modelCategory->id_type) {
                    case 0:
                    {
                        $out .= "<div class=\"container-1 border-con\"><p><select name='sub_category_" . $modelCategory->id  . "'><option>Выбрать</option>";
                        $modelLinkProduct2 = LinkProduct::find()->where(['id_product'=>$id])->all();
                        foreach ($modelLinkProduct2 as $linkProduct2)
                        {
                            if ($modelCategory->id == $linkProduct2->id_category){
                               //var_dump($modelCategory->name);die();
                                $modelSubCategory = SubCategory::findOne(['id'=> $linkProduct2->id_sub_category]);
                               $out .= "<option value='" . $modelSubCategory->id . "'>" . $modelSubCategory->name . "</option>";
                            }
                            else {
                                continue;
                            }

                        }


                        $out .="</select></p></div>";
                        break;
                    }
                    case 1:
                    {
                        $modelSubCategory = SubCategory::findOne(['id'=> $linkProduct->id_sub_category]);
                        //var_dump($modelSubCategory);
                        $out .= "<input type='text' name='sub_category_" . $modelCategory->id . "' value='" . $modelSubCategory->id . "'>" . $modelSubCategory->name;


                        break;
                    }
                    case 2:
                    {
                        $modelLinkProduct2 = LinkProduct::find()->where(['id_product'=>$id])->all();
                        foreach ($modelLinkProduct2 as $linkProduct2)
                        {
                            //var_dump($modelCategory->id.$linkProduct2->id_category);
                            if ($modelCategory->id == $linkProduct2->id_category){

                                $modelSubCategory = SubCategory::findOne(['id'=> $linkProduct2->id_sub_category]);
                                //var_dump($modelSubCategory);
                                $out .= "<input type='radio' name='sub_category_" . $modelCategory->id . "' value='" . $modelSubCategory->id . "'>" . $modelSubCategory->name;
                            }
                            else {
                                continue;
                            }

                        }

                        break;
                    }
                    case 3:
                    {

                        foreach ($modelLinkProduct as $linkProduct2)
                        {
                            if ($modelCategory->id == $linkProduct2->id_category){
                                $modelSubCategory = SubCategory::findOne(['id'=> $linkProduct2->id_sub_category]);
                                $out .= "<input type='checkbox' name='sub_category_" . $modelCategory->id . "[]' value='" . $modelSubCategory->id . "'>" . $modelSubCategory->name;
                            }
                            else {
                                continue;
                            }

                        }

                        break;
                    }
                }
                $out .= '</div>';
            }
        }
        $out .= '<div class="form-group field-order-comment has-success">
<label class="control-label" for="order-comment">Комментарий</label>
<textarea id="order-comment" class="form-control" name="Order[comment]"></textarea>
<div class="help-block"></div>
</div><div class="form-group field-order-file has-success">
<label class="control-label" for="order-file">Файлы</label>
<input type="hidden" name="Order[file]" value=""><input type="file" id="order-file" name="Order[file]">

<div class="help-block"></div>
</div></div>';
        return $out;
    }
    public function actionCreateOrder()
    {
        $model = new Order();

        $products = Product::find()->asArray()->all();
        $listProducts = ArrayHelper::map($products, 'id', 'name');

        if(Yii::$app->request->post()){
            //var_dump($_POST);
            if($_POST['category']) {
                $categories = $_POST['category'];
                //var_dump($_POST); echo "<br/>";
                foreach ($categories as $category)
                {
                    if(count($_POST['sub_category_' . $category]) > 1)
                    {
                        foreach ($_POST['sub_category_' . $category] as $subCategory) {
                            $data[$category][] = $subCategory;
                        }
                    }
                    else {
                        $data[$category] = $_POST['sub_category_' . $category];
                    }
                }
//            var_dump(json_encode($data));
//            die();
            }
            else {

                return $this->render('createOrder', [

                    'model' => $model,
                    'listProducts' => $listProducts,
                ]);
            }

        }
        $clientId = Yii::$app->user->getId();
        $model->client_id = $clientId;
        //$model->manager_id = UserClient::findOne(['user_id' => $clientId])->manager_id;
        $model->status = 1;
        

        
        if(Yii::$app->request->post() && $model->save())
        {
            $model->product_id = $_POST['Order']['product_id'];
            $model->comment = $_POST['Order']['comment'];
            $model->data = json_encode($data);
            $model->save();

            Yii::$app->session->setFlash('success', 'Добавлена');
            return $this->render('showOrder', [
                'model' => $model,
                //'listProducts' => $listProducts,
            ]);
        } else {
            return $this->render('createOrder', [
                'model' => $model,
                'listProducts' => $listProducts,
            ]);
        }
    }
    public function actionShowOrder($id=10)
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
}