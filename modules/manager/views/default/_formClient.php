<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'newPassword')->textInput() ?>

<?= $form->field($model, 'newPasswordRepeat')->textInput() ?>

<?= $form->field($model, 'status')->dropDownList($model->getStatusesArray()) ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : Yii::t('app', 'Btn update')) ?>
</div>

<?php ActiveForm::end(); ?>