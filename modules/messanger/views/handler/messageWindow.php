<div class="close-windows"></div>
<div class="message-dialog__overlay">
    <div class="wrap-dialog">
        <div class="dialog">
            <div class="header-dialog">
                <span>переписка с:</span>
                <div class="client">
                    <input type="submit" value="<?= isset($manager) ? ' клиентом' : ' менеджером' ?>">
                    <i class="icon-client"></i>
                </div>
                <div class="close"><a href="#"></a></div>
            </div>

            <div class="massege-dialog">

            </div>

            <div class="input-massege">
                <p>Ваше сообщение:</p>
                <textarea id="" rows="10" placeholder="Текст сообщения..."></textarea>
                <div>
                    <input type="submit" id="<?= isset($manager) ? 'send-to-client' : 'send-to-manager' ?>" class="button-2" value="отправить">
                </div>
            </div>
        </div>

    </div>
</div>