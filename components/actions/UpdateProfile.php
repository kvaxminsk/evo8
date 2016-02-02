<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components\actions;

use Yii;
use yii\base\Action;

/**
 * Description of UpdateClientProfile
 *
 * @author mr
 */
class UpdateProfile extends Action 
{
    public $redirectAction = 'index';
    public $view = 'update';
    public $modelClass;
    public $isManagerProfile = false;
    
    public function run($id) 
    {
        $model = Yii::createObject($this->modelClass);
        $model = $model::findOne(['user_id' => $id]);
        
        if($model->load(Yii::$app->request->post()) && $model->save()) {
            if($this->isManagerProfile) {
                $this->redirectAction = [$this->redirectAction, 'id' => $id];
            }
            return $this->controller->redirect($this->redirectAction);
        } else {
            return $this->controller->render($this->view, [
                'model' => $model,
            ]);
        }
    }
}
