<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\modules\main\models\OrderTypes;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(OrderTypes::find()->all(), 'id', 'name'))->label('Тип') ?>
<?= $form->field($model, 'comment')->textInput() ?>
<?= $form->field($model, 'bumaga')->textInput() ?>
<?= $form->field($model, 'tirazh')->textInput() ?>
<?= $form->field($model, 'data')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : Yii::t('app', 'Btn update')) ?>
</div>

<?php ActiveForm::end(); ?>
