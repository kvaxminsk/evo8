<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SubCategory */

$this->title = Yii::t('app', 'Создать');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Данные для категории'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categoriesArray'=>$categoriesArray
    ]) ?>

</div>
