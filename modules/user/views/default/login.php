<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\models\LoginForm */

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="site-login">-->
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!--    -->
<!--    <p>--><?//= Yii::t('app', 'Login welcome') ?><!--</p>-->
<!---->
<!--    <div class="row">-->
<!--        <div class="col-lg-5">-->
<!--            --><?php //$form = ActiveForm::begin(['id' => 'login-form']); ?>
<!--                --><?//= $form->field($model, 'username') ?>
<!--                --><?//= $form->field($model, 'password')->passwordInput() ?>
<!--                --><?//= $form->field($model, 'rememberMe')->checkbox() ?>
<!--                <div style="color:#999;margin:1em 0">-->
<!--                    --><?//= Yii::t('app', 'Login ifreset') ?><!-- --><?//= Html::a(Yii::t('app', 'Login resetit'), ['/request-password-reset']) ?><!--.-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    --><?//= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
<!--                </div>-->
<!--            --><?php //ActiveForm::end(); ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--Content-->
<main class="content">
    <div class="wrapper-enter">
        <ul>
            <li class="active"><a href="#">вход на сайт</a>
            <li><a href="/signup">регистрация</a>
        </ul>

        <h2>Личный кабинет</h2>
        <?php $form = ActiveForm::begin(['id' => 'login-form','options' => [
            'class' => 'form-group'
        ]]); ?>
            <p>имя пользователя:</p>
            <?= $form->field($model, 'username')->label('')->textInput(array('placeholder'=>"Введите имя пользователя")) ?>
            <p>пароль:</p>
            <?= $form->field($model, 'password')->passwordInput(array('placeholder'=>"Введите пароль"))->label('') ?>


<!--                --><?//= $form->field($model, 'rememberMe',
//                    ['template' => '<div class=\"checkbox\">{input}</div>'])->checkbox() ?>
<!--                --><?////= $form->field($model, 'rememberMe')->checkbox() ?>
<!--                <input id="check" type="checkbox" class = "checkbox" checked="checked">-->
<!--                <label for="check">Запомнить меня</label>-->
        <div class="checkbox">
            <input id="check" type="checkbox" class="checkbox" checked="checked">
            <label for="check">Запомнить меня</label>
        </div>
            <p class="button">
                <?= Html::submitInput(Yii::t('app', 'Login')) ?>
            </p>
                <div class="form-footer">
                    <a href="/request-password-reset">Забыли пароль?</a>
                    <span><img src="img/arrow-new.png" alt=""><a href="http://evolineplus.by">Вернуться на главную</a></span>
                </div>
        <?php ActiveForm::end(); ?>
    </div>
</main>
<!--End Content-->