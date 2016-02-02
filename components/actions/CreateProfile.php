<?php

namespace app\components\actions;

use Yii;
use yii\base\Action;

/**
 * Description of CreateClientProfile
 *
 * @author mr
 */
class CreateProfile extends Action
{
    public $redirectAction = 'index';
    public $view = 'create';
    public $modelClass = 'app\modules\user\models\UserClient';
    public $isUseManager = false;
    public $isUseAdmin = false;
    public $isUseClient = false;
    
    public function run($id) 
    {
        $model = Yii::createObject([
            'class' => $this->modelClass,
        ]);
        
        if($this->isUseManager) {
            $model->user_id = $id;
            $model->manager_id = Yii::$app->user->getId();
        }
        
        if($this->isUseAdmin) {
            $model->user_id = $id;
        }
        
        if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->controller->redirect($this->redirectAction);
        } else {
            return $this->controller->render($this->view, [
                'model' => $model,
            ]);
        }
    }
}