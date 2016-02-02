var Messanger = {};
Messanger.currentOrder = 0;
Messanger.fromUser = 12;
Messanger.toUser = 0;
Messanger.sendMessage = function (url) {
    var dialog = $('.massege-dialog');
    var textOfMessage = $('.input-massege textarea').val();
    $.ajax({
        url: url,
        dataType: 'JSON',
        type: 'GET',
        data: {
            idChat: Messanger.currentOrder,
            message: textOfMessage
        },
        success: function (data) {
            if(data['status'] == true) {
                message = '<div class="pole-dialog"><p><span>Я</span> / ' + '</p><span class="user-massege">' + textOfMessage + '</span></div>';
                dialog.append(message);
            } else {
                message = '<div class="pole-dialog"><p><span>Внимание!</span>' + '</p><span class="user-massege">Ошибка при передаче Вашего сообщения!</span></div>';
                dialog.append(message);
            }
            Messanger.scrollBottom();
        }
    });
}
Messanger.sendMessageToClient = function () {
    Messanger.sendMessage('/messanger/handler/send-to-client');
}
Messanger.sendMessageToManager = function () {
    Messanger.sendMessage('/messanger/handler/send-to-manager');
}
Messanger.getMessages = function () {
    $.ajax({
        url: '/messanger/handler/get-ids-user',
        data: {
            id: Messanger.currentOrder
        },
        type: 'GET',
        success: function (data) {
            Messanger.fromUser = data.id;
            console.log(Messanger.fromUser);
        }
    });
    $.ajax({
        url: '/messanger/handler/get-messages',
        data: {
            id: Messanger.currentOrder
        },
        type: 'GET',
        success: function (data) {
            Messanger.fillDialogue(data);
        }
    });
    Messanger.scrollBottom();
}
Messanger.fillDialogue = function (data) {
    var dialog = $('.massege-dialog');
    for(var i in data) {
        if(data[i].from_user == Messanger.fromUser) {
            var message = '<div class="pole-dialog"><p><span>Я</span> / ' + data[i].created_at + '</p><span class="user-massege">' + data[i].message + '</span></div>';
            dialog.append(message);
        } else {
            var message = '<div class="pole-dialog"><p class="client-data"><span>Ваш собеседник</span> / ' + data[i].created_at + '</p><span class="client-massege">' + data[i].message + '</span></div>'; 
            dialog.append(message);
        }
    }
}
Messanger.scrollBottom = function () {
    var height = $('.massege-dialog')[0].scrollHeight;
    $('.massege-dialog').scrollTop(height);
}

$(document).ready(function () {
    //Open the window
    $('.icon-pencil2').click(function () {
        var iTag = this;
        $.ajax({
            url: '/messanger/handler/window',
            type: 'POST',
            success: function (data) {
                Messanger.currentOrder = $(iTag).parent().find('input').val();
                $('body').append(data);
                Messanger.getMessages();
            }
        });
    });
    //Close the window with messages
    $(document).on('click', '.close-windows, .close a', function () {
        $('.message-dialog__overlay').remove();
        $('.close-windows').remove();
    });
    //Send message
    $(document).on('click', '#send-to-manager', Messanger.sendMessageToManager);
    $(document).on('click', '#send-to-client', Messanger.sendMessageToClient);
});