<?php

use yii\widgets\ListView;
use yii\helpers\Html;
?>

<div class="content-header">
    заказы
</div>

<div class="block title-block">
    <ul>
        <li>&#8470; <!--<i class="to-arrow"></i>-->
        <li>Тип
        <li>информация
        <li>дата
        <li>Дата готовности
        <!--<li>комментарий -->
        <li>Статус
<!--        <li>Действие</li>-->
        <li>В архив
    </ul>
</div>

<?=
ListView::widget([
    'itemView' => '_itemMyOrder',
    'layout' => '{items}<br>{pager}',
    'dataProvider' => $dataProvider,
]);

?>

