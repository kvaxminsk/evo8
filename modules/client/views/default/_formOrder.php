<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'type_id')->dropDownList($typesOrder)->label('Тип') ?>
<?= $form->field($model, 'cvetnost')->textInput() ?>
<?= $form->field($model, 'bumaga')->textInput() ?>
<?= $form->field($model, 'tirazh')->textInput() ?>
<?= $form->field($model, 'material')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : Yii::t('app', 'Btn update')) ?>
</div>

<?php ActiveForm::end(); ?>