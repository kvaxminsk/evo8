<?php ?>

<ul>
    <li><?= $index ?></li>
    <li><?= $model->typeName ?></li>
    <li><?= $model->data ?><?= $model->comment ?></li>
    <li>200 <span>мг/см<sup>2</sup></span></li>
    <li> <span>шт</span></li>
    <li><span class="tooltip" data-title="Изменить"><a href="/manager/order/update-template/<?= $model->id ?>">Изменить</a></span></li>
</ul>