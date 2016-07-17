<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\base\ActionFilter;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SubCategory */
/* @var $form yii\widgets\ActiveForm */
//var_dump($categoriesArray);
?>

<div class="sub-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?=$form->field($model, 'id_category')->dropDownList($categoriesArray,
        ['prompt'=>'Выбрать'])->label('Категория'); ?>
    <?php
   // echo $form->field($model, 'name')->dropDownList(['1' => 'Yes', '0' => 'No'],['prompt'=>'Select Option']);

//    echo $form->field($model, 'id_category')->dropDownList([
//    '0' => 'Активный',
//    '1' => 'Отключен',
//    '2'=>'Удален'
//    ]);
    ?>
<!--    --><?//= $form->field($model, 'comment')->checkbox() ?>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Редактировать'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
