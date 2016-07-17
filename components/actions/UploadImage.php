<?php



namespace app\components\actions;

use Yii;
use yii\base\Action;

/**
 * Description of UpdateClientProfile
 *
 * @author mr
 */
class UpdateImage extends Action
{
    public $redirectAction = 'index';
    public $view = 'update';
    public $modelClass;
    public $isManagerProfile = false;

    public function run($id)
    {
        $model = Yii::createObject($this->modelClass);
        $model = $model::findOne(['id' => $id]);
        if (Yii::$app->request->post()['User']['password_hash'] == "") {
            unset(Yii::$app->request->post()['User']['password_hash']);
        }
        if($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Yii::$app->request->post()['User']['password_hash'] != "") {
                //var_dump(Yii::$app->request->post()['User']['password_hash']!= ""); echo "<br>";
                $model->setPassword(Yii::$app->request->post()['User']['password_hash']);

            }
            if($this->isManagerProfile) {
                $this->redirectAction = [$this->redirectAction, 'id' => $id];
            }
            return $this->controller->redirect($this->redirectAction);
        } else {
            $model->password_hash = '';
            return $this->controller->render($this->view, [
                'model' => $model,
            ]);
        }
    }
}
