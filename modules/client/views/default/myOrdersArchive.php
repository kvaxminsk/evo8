<?php

use yii\widgets\ListView;
use yii\helpers\Html;
?>

<div class="content-header">
    заказы
</div>

<div class="block title-block">
    <ul>
        <li>&#8470;
        <li>Тип
        <li>информация
        <li>дата
        <li>комментарий
        <li>Статус
        <li>Ввернуть<br>в заказ
        <li>Удалить<br>навсегда
    </ul>
</div>

<?=
ListView::widget([
    'itemView' => '_itemMyOrderArchive',
    'layout' => '{items}<br>{pager}',
    'dataProvider' => $dataProvider
])
?>