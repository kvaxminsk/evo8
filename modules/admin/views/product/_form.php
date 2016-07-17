<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>
<?
// foreach ($subCategoriesArray as $subCategory) {
//     var_dump($subCategory);
// }

?>
    <?= $form->field($model, 'name')->textInput() ?>
    <?

        foreach ($categoriesArray as $id => $name) {
//            if($linkProduct->id_category == $id) {
                ?>
                <div class="form-group">
                    <style>
                        .form-group input{
                            width:auto;
                        }
                    </style>
                    <label for="<?= $name ?>"><?= $name ?></label>
                         <input type="checkbox" name="category[]"
                            value="<?= $id ?>" <?= (in_array($id,$modelLinkProductCategory))  ? 'checked' : ''; ?>>
                    <div class="form-group">
                        <?
//                        var_dump($modelLinkProductSubCategory);
                        foreach ($subCategoriesArray as $subCategory) {
                            //echo in_array($subCategory->id,$modelLinkProductSubCategory).'<br>';
                            if ($subCategory->id_category == $id) {
                                ?>
                                <label for="<?= $subCategory->name ?>"><?= $subCategory->name ?></label>
                                <input type="checkbox" name="subCategory<?= $id ?>[]"
                                       value="<?= $subCategory->id ?>" <?= (in_array($subCategory->id,$modelLinkProductSubCategory)) ? 'checked' : ''; ?>>
                                <?
                            }
                        }


                        ?>
                    </div>
                </div>
                <?
//            }

        
    }
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Редактировать'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
