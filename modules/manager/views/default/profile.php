<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->params['leftMenu'] = 4;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'names_person')->textInput()->label('ФИО') ?>
<?= $form->field($model, 'username')->textInput()->label('Логин') ?>
<?=  $form->field($model, 'email')->textInput() ?>
<?=  $form->field($model, 'password_hash')->passwordInput()->label('Пароль') ?>
<?= $form->field($model, 'phone')->textInput() ?>
<?= $form->field($model, 'mob_phone')->textInput() ?>

<?= $form->field($model, 'file')->fileInput()->label('Аватар'); ?>

<?= Html::img(['/main/file/show','id'=>$model->avatar]) ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : Yii::t('app', 'Btn update')) ?>
</div>

<?php ActiveForm::end(); ?>