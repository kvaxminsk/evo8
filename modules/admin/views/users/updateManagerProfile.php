<?php 
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = 'Редактирование анкеты менеджера';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>
<?= $this->render('_formManagerProfile', ['model' => $model]) ?>
</div>
