<?php

namespace app\components\actions;

use Yii;
use yii\base\Action;
use app\modules\admin\models\User;
/**
 * Description of UpdateClient
 *
 * @author mr
 */
class UpdateUser extends Action 
{
    public $redirectAction = 'view';
    public $view = 'create';
    public $context;
    public $role;
    
    public function run()
    {
        $model = new User();
        $model->scenario = User::SCENARIO_UPDATE_USER;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole($this->role);
            $auth->assign($role, $model->getId());
            return $this->controller->redirect([$this->redirectAction]);
        } else {
            
            return $this->controller->render($this->view, [
                'model' => $model,
            ]);
        }
    }
}
