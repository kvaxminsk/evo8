<?php ?>
<div class="block">
    <ul>
        <li><?= $model->id ?>
        <li><?= $model->name ?> <br>
        <li><a href="/client/default/show-order/<?= $model->id;?>">Показать</a></li>
        <li><?= Yii::$app->formatter->asDatetime($model->created_at, 'H:m d.M.Y') ?>
        <li> <i class="icon-pencil2"></i> <br> <a href="#">Написать</a><input type="hidden" value="<?= $model->id ?>">
        <li> <i class="icon-status<?= $model->status ?>" title="<?= $model->statusName ?>"></i> <br>
        <li><a style="margin-left: 40px;border-bottom: none; " href="/client/default/delete-archive/<?= $model->id ?>"><i class="icon-return"></i></a>
        <li><a style="border-bottom: none; " href="/client/default/delete/<?= $model->id ?>"><i class="icon-remove"></i></a>

    </ul>
</div>
