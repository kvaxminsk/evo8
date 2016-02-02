<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'newPassword')->textInput() ?>
    
    <?= $form->field($model, 'newPasswordRepeat')->textInput() ?>
    
    <?= $form->field($model, 'status')->dropDownList($model->getStatusesArray()) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : Yii::t('app', 'Btn update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php if(!$model->isNewRecord && \app\modules\user\models\AuthAssignment::findOne(['user_id' => $model->id])->item_name == 'manager') { ?>
            <a href="/admin/users/update-manager-profile/<?= $model->id ?>" class="btn btn-primary">Редактирование анкеты</a>
    <?php } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
