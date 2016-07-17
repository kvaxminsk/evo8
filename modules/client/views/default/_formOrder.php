<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\widgets\FileInput;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'product_id')->dropDownList($listProducts,['prompt'=>'Выбрать'])->label('Тип') ?>
<div id="info" class="open-block">
    

</div>



<?//= $form->field($model, 'comment')->textarea()->label('Комментарий');?>
<?//= $form->field($model, 'files')->fileInput() ?>
<BR/>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : Yii::t('app', 'Btn update')) ?>
    </div>
<?php ActiveForm::end(); ?>