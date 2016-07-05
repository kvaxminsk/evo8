<?php

use yii\widgets\ListView;

$this->registerJsFile('/js/core.js');
?>

<div class="content-header">
    Клиенты
</div>

<div class="new-template">
    <p><a href="/manager/default/create-client">Создать клиента</a> </p>
</div>


<div class="block title-block">
    <ul>
        <li style="width:50px">&#8470;
        <li style="width:80px">Логин клиента</li>
        <li style="width:180px">информация</li>
        <li style="width:70px">Cтатус </li>
        <li style="width:60px">Кол. активных</br> заказов </li>
        <li style="width:50px">Кол. неактивных</br> заказов </li>
        <li style="width:200px">Действие </li>
    </ul>
</div>

<?=
ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_itemClient',
    'layout' => '{items}<br>{pager}',
]);
