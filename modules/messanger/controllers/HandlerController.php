<?php
namespace app\modules\messanger\controllers;

use Yii;
use yii\web\Controller;
use app\modules\messanger\models\Messages;
/**
 * Description of ChatController
 *
 * @author Robert Kuznetsov <RK at buildinggame.ru>
 */
class HandlerController extends Controller
{
    public $defaultAction = 'get-messages';
    public $enableCsrfValidation = false;
    
    public function actionGetMessages($id) 
    {
        $models = Messages::find()->where(['id_chat' => $id])->asArray()->all();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(isset($models)) {
            return $models;
        } else {
            return [];
        }
        
    }
    
    public function actionSendToManager($idChat, $message)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Messages();
        $model->id_chat = $idChat;
        $model->from_user = Yii::$app->user->getId();
        $model->to_user = \app\modules\user\models\UserClient::findOne(['user_id' => $model->from_user])->manager_id;
        $model->message = $message;
        if($model->save()) {
            return [
                'status' => true,
            ];
        } else {
            return [
                'status' => false,
            ];
        }
    }
    
    public function actionSendToClient($idChat, $message)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Messages();
        $model->id_chat = $idChat;
        $model->from_user = Yii::$app->user->getId();
        $model->to_user = \app\modules\main\models\Order::findOne(['id' => $idChat])->client_id;
        $model->message = $message;
        if($model->save()) {
            return [
                'status' => true,
            ];
        } else {
            return [
                'status' => false,
            ];
        }
    }
    
    public function actionGetIdsUser($id) 
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userFrom = Yii::$app->user->getId();
        return [
            'id' => $userFrom,
        ];
    }
    
    public function actionWindow() 
    {
        $manager = \app\modules\user\models\UserManager::findOne(['user_id' => Yii::$app->user->getId()]);
        return $this->renderAjax('messageWindow', [
            'manager' => $manager
        ]);
    }
}