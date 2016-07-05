<?php

use yii\widgets\Breadcrumbs;
use app\assets\SignupAsset;
use app\components\widgets\AlertWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
/* @var $this \yii\web\View */
/* @var $content string */

SignupAsset::register($this);

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = Yii::t('app', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>

<!--        <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

        <main class="content">
			<div class="wrapper-register">
				<ul>
					<li><a href="/">вход на сайт</a>
					<li class="active"><a href="">регистрация</a>
				</ul>

					<h2><span class="red">Регистрация</span></h2>
                    <?php $form = ActiveForm::begin(['id' => 'form-signup','options' => [
                        'class' => 'form-group'
                    ]]); ?>

						<p>электронная почта:</p>
                        <?= $form->field($model, 'email')->label('')->textInput(array('placeholder'=>"Введите почту"))  ?>
<!--						<input type="email" placeholder="Введите почту">-->

						<p>Логин:</p>
                        <?= $form->field($model, 'username')->label('')->textInput(array('placeholder'=>"Введите логин"))  ?>
<!--						<input type="text" placeholder="Введите логин ">-->


							<span>пароль:</span>
                            <?= $form->field($model, 'password')->passwordInput(array('placeholder'=>"Введите пароль"))->label('') ?>
				<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
					'captchaAction' => '/user/default/captcha',
					'template' => '<div class="row"><div class="col-lg-4">{image}</div><div class="col-lg-6">{input}</div></div>',
				]) ?>
						<div class="checkbox">
							<input id="check" type="checkbox" class = "checkbox" checked="checked" checked="checked">
							<label for="check" >Запомнить меня, если захожу с этого компьютера</label>
						</div>

						<div class="checkbox">
							<input id="check2" type="checkbox" class = "checkbox" checked="checked">
							<label for="check2">Извещать меня о новостях</label>
						</div>
              
						<p class="button">
                            <?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
						</p>

                    <?php ActiveForm::end(); ?>

			</div>
		</main>
