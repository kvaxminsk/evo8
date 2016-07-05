<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'organization')->textInput() ?>
<?= $form->field($model, 'address')->textInput() ?>
<?= $form->field($model, 'phone')->textInput() ?>
<?= $form->field($model, 's_account')->textInput() ?>
<?= $form->field($model, 'servicing_bank')->textInput() ?>
<?= $form->field($model, 'address_bank')->textInput() ?>
<?= $form->field($model, 'unp')->textInput() ?>
<?= $form->field($model, 'okpo')->textInput() ?>
<?= $form->field($model, 'comment')->textInput() ?>
<?= $form->field($model, 'mob_phone')->textInput() ?>
<?= $form->field($model, 'names_person')->textInput() ?>
<?= $form->field($model, 'file')->fileInput(); ?>

<?= Html::img(['/main/file/show','id'=>$model->avatar]) ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : Yii::t('app', 'Btn update')) ?>
</div>

<?php ActiveForm::end(); ?>