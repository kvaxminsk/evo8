<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Category;
use app\modules\admin\models\SubCategory;
use app\modules\admin\models\LinkProduct;
use Yii;
use app\modules\admin\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {


        $model = new Product();
        $modelCategory = new Category();

        $categoriesArray = ArrayHelper::map(Category::find()->all(), 'id', 'name');
        $categories = Category::find()->all();
        $subCategoriesArray = SubCategory::find()->all();
//        if ($model->load(Yii::$app->request->post())){
//
//            var_dump($_POST);
//        die();
//        }
        //var_dump($_POST);
        //echo "<br>";
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach (Yii::$app->request->post()['category'] as $key=>$id)
            {
                //var_dump($id.'---');
                foreach (Yii::$app->request->post()['subCategory'.$id] as $keySub=>$idSub) {
                    //$linkProductArray = array($model->id,$id,$idSub);
                    $modelLinkProduct = new LinkProduct();
                    //var_dump($keySub.$idSub );echo "<br>";
                    $modelLinkProduct->id_product = $model->id;
                    $modelLinkProduct->id_category =$id;
                    $modelLinkProduct->id_sub_category =$idSub;
                    $modelLinkProduct->save();

                }
            }

            //die();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('_form-create.php', [
                'model' => $model,
                'categoriesArray'=>$categoriesArray,
                'categories'=>$categories,
                'subCategoriesArray'=>$subCategoriesArray,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelCategory = new Category();

        $categoriesArray = ArrayHelper::map(Category::find()->all(), 'id', 'name');
        $modelLinkProduct = LinkProduct::find()->where(['id_product'=>$id])->orderBy('id_category')->all();
       
        $subCategoriesArray = SubCategory::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            LinkProduct::deleteAll(['id_product'=>$id]);

            foreach (Yii::$app->request->post()['category'] as $key=>$id)
            {
                //var_dump($id.'---');
                if(Yii::$app->request->post()['subCategory'.$id]) {
                    foreach (Yii::$app->request->post()['subCategory' . $id] as $keySub => $idSub) {
                        //$linkProductArray = array($model->id,$id,$idSub);
                        $modelLinkProduct = new LinkProduct();
                        //var_dump($keySub.$idSub );echo "<br>";
                        $modelLinkProduct->id_product = $model->id;
                        $modelLinkProduct->id_category = $id;
                        $modelLinkProduct->id_sub_category = $idSub;
                        $modelLinkProduct->save();

                    }
                }
                else {

                    $modelLinkProduct = new LinkProduct();
                    //var_dump($keySub.$idSub );echo "<br>";
                    $modelLinkProduct->id_product = $model->id;
                    $modelLinkProduct->id_category = $id;
                    $modelLinkProduct->id_sub_category = 0;
                    $modelLinkProduct->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $modelLinkProduct = LinkProduct::find()->where(['id_product'=>$id])->orderBy('id_category')->all();
//            var_dump(ArrayHelper::map($modelLinkProduct,'id','id_product'));die();
            return $this->render('update', [
                'model' => $model,
                'categoriesArray'=>$categoriesArray,
                'subCategoriesArray'=>$subCategoriesArray,
                'modelLinkProductCategory'=>ArrayHelper::map($modelLinkProduct,'id','id_category'),
                'modelLinkProductSubCategory'=>ArrayHelper::map($modelLinkProduct,'id','id_sub_category'),
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
