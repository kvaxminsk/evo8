<?php

use yii\widgets\ListView;
use yii\helpers\Html;
$this->params['leftMenu'] = 3;
$this->registerCssFile('/css/style4.css');
?>

<div class="content-header">
    шаблоны
</div>

<div class="new-template">
    <p>
        <a href="/manager/order/create-template">Создать шаблон</a>
    </p>    
</div>

<div class="block title-block">
    <ul>
        <li>&#8470; <i class="to-arrow"></i>
        <li>Тип<i class="to-arrow"></i>
        <li>Подробная информация<i class="to-arrow"></i>
        <li>статус <i class="to-arrow"></i>
        <li>... <i class="to-arrow"></i>
        <li>Действие <i class="to-arrow"></i>
    </ul>
</div>

<?=
ListView::widget([
    'itemView' => '_itemOrderTemplate',
    'layout' => '{items}<br>{pager}',
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'block']
])
?>