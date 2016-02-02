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
        <li>&#8470; <i class="to-arrow"></i>
        <li>Логин клиента<i class="to-arrow"></i>
        <li>информация<i class="to-arrow"></i>
        <li>статус <i class="to-arrow"></i>
        <li>... <i class="to-arrow"></i>
        <li>Действие <i class="to-arrow"></i>
    </ul>
</div>

<?=
ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_itemClient',
    'layout' => '{items}<br>{pager}',
]);
