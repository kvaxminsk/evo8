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
        echo "<table border='2px'>";
        foreach ($categoriesArray as $id => $name) {
                ?>
                <tr>
                <div class="form-group1">
                    <style>
                        .form-group1 input{
                           //width:auto;
                        }
                    </style>
                    <td>

                        <input type="checkbox" width="auto" name="category[]"
                               value="<?= $id ?>" >
                        <label  for="<?= $name ?>"><?= $name ?></label>

                    </td>
                    <td>
                    <div class="form-group1">
                        <? $count =0;
                        foreach ($subCategoriesArray as $subCategory) {
                            if ($subCategory->id_category == $id) {
                                $count = 1;
                                ?>
                                <input type="checkbox" name="subCategory<?= $id ?>[]"
                                       value="<?= $subCategory->id ?>">
                                <label style="font-weight: normal" for="<?= $subCategory->name ?>"><?= $subCategory->name ?></label>

                                <?
                            }
                        }
                        if($count == 0) {
                           foreach ($categories as $key => $value){
                               if($value->id == $id && $value->id_type == 0) {
                                   echo '<i style="color:red">Необходимо заполнить данные для категории<i>';
                               }
                           }
                        }

                        ?>
                    </div>
                    </td>
                </div>
                </tr>
                <?
//            }

    }
    ?>
    </table>
    <br>
    <div class="form-group1">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Редактировать'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
