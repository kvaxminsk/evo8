<?php

use yii\widgets\ListView;
use yii\helpers\Html;
?>

<div class="content-header">
    заказы
</div>

<div class="block title-block">
    <ul>
        <li>&#8470; <i class="to-arrow"></i>
        <li>Заказ<i class="to-arrow"></i>
        <li>информация<i class="to-arrow"></i>
        <li>дата <i class="to-arrow"></i>
        <li>статус <i class="to-arrow"></i>
        <li>комментарий <i class="to-arrow"></i>
    </ul>
</div>

<?=
ListView::widget([
    'itemView' => '_itemMyOrder',
    'layout' => '{items}<br>{pager}',
    'dataProvider' => $dataProvider
])
?>