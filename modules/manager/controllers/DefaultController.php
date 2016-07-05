<?php

namespace app\modules\manager\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use app\modules\user\models\User;
use app\modules\manager\models\UserSearch;
use app\modules\user\models;
use app\components\actions;
use yii\data\ActiveDataProvider;

class DefaultController extends Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin', 'root', 'manager'],
                    ],
                ]
            ],
        ];
    }
    
    public function actions() {
        return ArrayHelper::merge(parent::actions(), [
            'create-client' => [
                'class' => actions\CreateUser::className(),
                'view' => '@app/modules/manager/views/default/createClient.php',
                'redirectAction' => 'update-client-profile',
                'role' => 'client',
            ],
//            'create-client-profile' => [
//                'class' => actions\CreateProfile::className(),
//                'view' => '@app/modules/manager/views/default/createClientProfile.php',
//                'redirectAction' => '/manager/default/index',
//                'modelClass' => 'app\modules\user\models\UserClient',
//                'isUseManager' => true,
//            ],
            'update-client-profile' => [
                'class' => actions\UpdateProfile::className(),
                'view' => '@app/modules/client/views/default/profile.php',
                'redirectAction' => '/',
                'modelClass' => 'app\modules\user\models\User',
            ],
            'profile' => [
                'class' => actions\UpdateProfile::className(),
                'view' => '@app/modules/manager/views/default/profile.php',
                'redirectAction' => '/manager/default/profile',
                'modelClass' => 'app\modules\user\models\User',
                'isManagerProfile' => true,
            ],
//            'delete-client' => [
//                'class' => actions\DeleteRecord::className(),
//                'modelClass' => 'app\modules\user\models\AuthAssignment',
//                'relatedAttributes' => [
//                    'user', 'client'
//                ],
//                'redirectAction' => '/manager/default/index',
//                'findAttribute' => 'user_id',
//            ]
        ]);
    }
    public function actionDeleteClient($id) {
        $model = new User();
        $model = $model::find()->where(['id'=> $id])->one();
        $model->delete();

        return $this->redirect(['/manager/default/index']);
    }
    public function actionIndex()
    {
        $model = new User();
        //$model = $model::find(['role'=>'client'])->all();

        $provider = new ActiveDataProvider([
            'query' => $model::find()->where(['role'=>'client']),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

//        $searchModel = new UserSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
        return $this->render('index', [
//            'searchModel' => $searchModel,
            'dataProvider' => $provider,
        ]);
    }
}
