<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'fio')->textInput() ?>
<?= $form->field($model, 'phone')->textInput() ?>
<?php // $form->field($model, 'email')->textInput() ?>
<?= $form->field($model, 'info')->textInput() ?>
<?= $form->field($model, 'file')->fileInput()->label('Аватар') ?>

<?= Html::img(['/main/file/show','id'=>$model->avatar]) ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : Yii::t('app', 'Btn update')) ?>
</div>

<?php ActiveForm::end(); ?>