<?php

?>
<div class="block">
    <ul>
        <li><?= $model->user_id ?>
        <li><?= $model->user->username ?>
        <li><b>Создан:</b> <?= $model->user->created_at ?><br><b>Наименование организации:</b> <?= $model->client->organization ?>
        <li><?= $model->user->statusName ?>
        <li>  
        <li><a href="/manager/default/update-client-profile/<?=$model->user_id ?>">Редактировать профиль</a>
            <br> <a href="/manager/default/delete-client/<?=$model->user_id ?>" data-confirm="Вы точно хотите безвозвратно удалить этого клиента?">Удалить</a>
    </ul>
</div>