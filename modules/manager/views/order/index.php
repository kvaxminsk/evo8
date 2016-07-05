<?php

use yii\widgets\ListView;
use yii\helpers\Html;
use app\modules\main\models\Order;
use yii\helpers\Url;

$status = Order::getStatusesArray();
$this->params['leftMenu'] = 1;
?>

<div class="content-header">
    заказы
</div>
<div class="new-template">
    <select id="filter" name="filter">
        <option value="0">Все заказы</option>
        <?
            foreach ($status as $key=>$value) {
                echo "<option " .  (($statusOrder==$key) ? 'selected ' : '') . "value='" .  $key . "'>" . $value . "</option>";
            }
        ?>
    </select>
</div>
<script>
    $(document).ready(function(){
        $('#filter').change(function() {
            if($( "#filter option:selected" ).val() == 0) {
                window.location.href = "/manager/order";
            }
            else {
                window.location.href = "?status=" + $( "#filter option:selected" ).val();
            }

        });
        $('.filter-change').change(function() {
            $.ajax({
                url: '/manager/order/change-status/' + $(this).attr('data-order-id') + '?status=' + $('option:selected',this).val(),
                success: function() {
                    alert('Статус изменен')
                }
            })
        });
    });

</script>
<div class="block title-block">
    <ul>
        <li>&#8470; <!--<i class="to-arrow"></i>-->
        <li style="width:80px;word-wrap:break-word">Клиент
        <li style="width:80px;word-wrap:break-word">Тип
        <li style="width:100px;word-wrap:break-word">Информация
        <li style="width:100px;word-wrap:break-word">Дата
        <li style="width:100px;word-wrap:break-word">Дата готовности
        <li style="width:100px;word-wrap:break-word">Комментарий
        <li style="width:100px;word-wrap:break-word">Статус
    </ul>
</div>


<?
echo ListView::widget([
    'itemView' => '_itemOrder',
    'layout' => '{items}<br>{pager}',
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'block']
]);

?>
