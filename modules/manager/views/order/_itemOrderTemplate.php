<?php ?>

<ul>
    <li><?= $index ?></li>
    <li><span class="tooltip" data-title="Изменить"><a href="/manager/order/update-template/<?= $model->id ?>">Изменить</a></span><?= $model->typeName ?></li>
    <li><?= $model->cvetnost ?></li>
    <li><?= $model->material ?></li>
    <li>200 <span>мг/см<sup>2</sup></span></li>
    <li><?= $model->kol ?> <span>шт</span></li>
</ul>