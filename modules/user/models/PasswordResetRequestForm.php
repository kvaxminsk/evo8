<?php
namespace app\modules\user\models;

use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => User::className(),
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => Yii::t('app', 'No user')
            ],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                $confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/confirm-email', 'token' => $user->email_confirm_token]);


                
                $message = "Здравствуйте, ".  Html::encode($user->username) ."!";

                $message .= "Пройдите по ссылке, чтобы сменить пароль:";

                $message .= $resetLink ;

                $message .="Если Вы не регистрировались у на нашем сайте, то просто удалите это письмо.";
                /* \Yii::$app->mailer->compose(['html' => 'passwordResetToken'], ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Password reset for ' . \Yii::$app->name)
                    ->send();*/
            }
        }

        return false;
    }
}
