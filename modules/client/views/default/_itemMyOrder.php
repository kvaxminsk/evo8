<?php
use yii\widgets\LinkPager;
?>
<div class="block">
    <ul>
        <li><?= $model->id ?>
        <li><?= $model->name ?> <br>
        <li><a href="/client/default/show-order/<?= $model->id;?>">Показать</a></li>
        <li><?= Yii::$app->formatter->asDatetime($model->created_at, 'H:m d.M.Y') ?>
        <li><?= Yii::$app->formatter->asDatetime($model->created_at, 'H:m d.M.Y') ?>
        <!--<li> <i class="icon-pencil2"></i> <br> <a href="#">Написать</a><input type="hidden" value="<?= $model->id ?>">-->
        <li> <i class="icon-status<?= $model->status ?>" title="<?= $model->statusName ?>"></i> <br>
<!--        <li>--><?//= ($model->status == 1) ?  '<i class="icon-edit" title="Редактировать"></i>' : ''?><!--  <br>-->
        <li><a style="border-bottom: none; " href="/client/default/add-archive/<?= $model->id ?>"><i class="icon-remove"></i></a>
    </ul>
</div>
<?php
//echo LinkPager::widget([
//    'pagination' => $pages,
//]);
//?>
