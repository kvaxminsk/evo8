<?php
namespace app\modules\user\models;
 
use yii\base\Model;
use Yii;
use yii\helpers\Html;
 
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $verifyCode;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => Yii::t('app', 'Signup username busy')],
            ['username', 'string', 'min' => 2, 'max' => 255],
 
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => Yii::t('app', 'Signup email busy')],
 
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
 
            ['verifyCode', 'captcha', 'captchaAction' => '/user/default/captcha'],
        ];
    }
 
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'verifyCode' => Yii::t('app', 'Verify'),
        ];
    }
    
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->status = User::STATUS_WAIT;
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();
//

            if ($user->save()) {
                $auth = Yii::$app->authManager;
            $role = $auth->getRole('client');
            $auth->assign($role, $user->getId());
$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/confirm-email', 'token' => $user->email_confirm_token]);

$message = "Здравствуйте, ".  Html::encode($user->username) ."!";

$message .= "Для подтверждения адреса пройдите по ссылке:";

//$message .= Html::a(Html::encode($confirmLink), $confirmLink) ;
$message .= $confirmLink ;

$message .=" Если Вы не регистрировались у на нашем сайте, то просто удалите это письмо.";

// Отправляем
                mail($user->email, 'Регистрация на сайте', $message);
//                $mailer =Yii::$app->get('mailsmtp');
//
//                $message =$mailer->compose('confirmEmail', ['user' => $user])
//
//                    ->setTo($this->email)
//                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
//                    ->setSubject('Email confirmation for ' . Yii::$app->name);
//
//                $message->getSwiftMessage()->getHeaders()->addTextHeader('name', 'value');
//                $failures =null;
//                try {
//
//                    if(!$mailer->send($message, $failures)) $errorCode=$failures; //отправляем
//
//                }catch (\Swift_TransportException $e) { //проверяем на ошибки
//                    $pattern = '|got code "(.+?)", with|is';
//                    preg_match($pattern, $e->getMessage(), $out);
//                    $errorCode=$out[1];
//                }
                /*Yii::$app->mailer->compose('confirmEmail', ['user' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject('Email confirmation for ' . Yii::$app->name)
                    ->send();*/
            }
 
            return $user;
        }
 
        return null;
    }
}