<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components\actions;

use Yii;
use yii\base\Action;
use app\modules\admin\models\User;

/**
 * Description of CreateClient
 *
 * @author mr
 */
class CreateUser extends Action 
{
    public $redirectAction = 'view';
    public $view = 'create';
    public $context;
    public $role;
    
    public function run()
    {
        $model = new User();
        $model->scenario = User::SCENARIO_CREATE_USER;
        $model->status = User::STATUS_ACTIVE;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole($this->role);
            $auth->assign($role, $model->getId());
            return $this->controller->redirect([$this->redirectAction, 'id' => $model->id]);
        } else {
            
            return $this->controller->render($this->view, [
                'model' => $model,
            ]);
        }
    }
}
