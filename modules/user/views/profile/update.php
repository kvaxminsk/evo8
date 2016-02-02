<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

    $this->title = Yii::t('app', 'Update user profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User profile'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'email') ?>
<?= Html::submitInput(Yii::t('app', 'Btn save'), ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>