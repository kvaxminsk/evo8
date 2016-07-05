<?php
$this->params['leftMenu'] = 2;
//var_dump($model->getStatusName());die();
?>
<div class="block">
    <ul>
        <li style="width:50px"><?= $model->id ?></li>
        <li style="width:80px;word-wrap:break-word"><?= $model->username ?></li>
        <li style="width:180px;word-wrap:break-word"><b>Создан:</b> <?= $model->created_at ?><br><b>Наименование организации:</b> <?= $model->organization ?><br>
            <b>Телефон:</b> <?= $model->phone ?></li>
        <li style="width:70px;word-wrap:break-word"><?= $model->statusName ?></li>
        <li style="width:60px;word-wrap:break-word"><a href="/manager/order/<?= $model->id ?>"><?= $model->countOrderActive ?></a></li>
        <li style="width:50px;word-wrap:break-word"><?= $model->countOrderUnActive ?></li>
        <li style="width:200px;word-wrap:break-word"><a href="/manager/default/update-client-profile/<?= $model->id ?>">Редактировать профиль</a>
            <br> <a href="/manager/default/delete-client/<?=$model->id ?>" data-confirm="Вы точно хотите безвозвратно удалить этого клиента?">Удалить</a></li>
    </ul>
</div>