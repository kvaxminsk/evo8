<?php ?>

<ul>
    <li><?= $index ?>
    <li><?= $model->typeName ?> <br>
        <span>&#8470 <?= $model->id ?></span>
    <li><?= $model->kol ?> шт. <?= $model->cvetnost ?> <br> <?= $model->material ?>
    <li><?= Yii::$app->formatter->asDatetime($model->created_at, 'H:m d.M.Y') ?>
    <li> <i class="icon-status1"></i> <br> <?= $model->statusName ?>
    <li> <i class="icon-pencil2"></i> <br> <a href="#">Написать</a><input type="hidden" value="<?= $model->id ?>">
</ul>
