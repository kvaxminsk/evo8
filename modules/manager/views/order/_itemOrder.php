<?php
use app\modules\main\models\Order;
$status = Order::getStatusesArray();
?>

<!--<ul>-->
<!--    <li>--><?//= $index ?>
<!--    <li>--><?//= $model->typeName ?><!-- <br>-->
<!--        <span>&#8470 --><?//= $model->id ?><!--</span>-->
<!--    <li> --><?//= $model->comment ?><!-- <br> --><?//= $model->data ?>
<!--    <li>--><?//= Yii::$app->formatter->asDatetime($model->created_at, 'H:m d.M.Y') ?>
<!--    <li>--><?//= Yii::$app->formatter->asDatetime($model->created_at, 'H:m d.M.Y') ?>
<!--    <li> <i class="icon-pencil2"></i> <br> <a href="#">Написать</a><input type="hidden" value="--><?//= $model->id ?><!--">-->
<!--</ul>-->

<ul>
    <li style="20px;"><?= $model->id ?>
    <li style="width:80px;word-wrap:break-word"><?= $model->clientOrganization ?>
    <li style="width:80px;word-wrap:break-word"><?= $model->name ?> <br>
    <li style="width:100px;word-wrap:break-word"><a href="/manager/order/show-order/<?= $model->id;?>">Показать</a></li>
    <li style="width:100px;word-wrap:break-word"><?= Yii::$app->formatter->asDatetime($model->created_at, 'H:m d.M.Y') ?>
    <li style="width:100px;word-wrap:break-word"><?= Yii::$app->formatter->asDatetime($model->created_at, 'H:m d.M.Y') ?>
    <li style="width:100px;word-wrap:break-word"> <i class="icon-pencil2"></i> <br> <a href="#">Написать</a><input type="hidden" value="<?= $model->id ?>">
    <li style="width:100px;word-wrap:break-word">
        <select class="filter-change" data-order-id='<?= $model->id ?>'>
            <?
            foreach ($status as $key=>$value) {
                echo "<option  " . (($key == $model->status) ?  'selected ' : '') . "value='" .  $key . "'>" . $value . "</option>";
            }
            ?>
        </select>

    </li>
</ul>

