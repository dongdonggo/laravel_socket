let routes ={
    "sendmsg": "user/sendmsg" ,
    "adminbind": "/auth/custom/adminbind",
    "personbind": "/auth/custom/persionbind"
}
var bindRoute = '';

function startWebSocket(bindRoutep) {
    bindRoute = bindRoutep;
    var wsUri ="ws://127.0.0.1:44444";
    websocket = new WebSocket(wsUri);
    websocket.onopen = function(evt) {
        onOpen(evt)
    };
    websocket.onclose = function(evt) {
        onClose(evt)
    };
    websocket.onmessage = function(evt) {
        onMessage(evt)
    };
    websocket.onerror = function(evt) {
        onError(evt)
    };
}

/**
 * 绑定认证
 * @param client_id
 */
function binduid(client_id) {
    // '/admin/dev/custom/bind'
    $.ajax({
        url: bindRoute,
        type: 'POST',
        data: {
            'client_id':client_id
        },
        success:function ($query) {
            console.log($query);
            switch ($query.status) {
                case '-1':
                    alert($query.msg);
                    break;
                case '0':
                    $('#online_bg').removeClass('bg-green ');
                    $('#online_bg').addClass('bg-green');
                    break;
            }

        },
        error:function ($response, $sr) {
            console.log($response.responseJSON);
        }
    })
}

/**
 * 发送消息给用户
 * @param message
 * @param sendid
 */
function sendMsg(message,sendid)
{
    var jsondata = {
        'msg': message
    };
    doSend(jsondata, routes.sendmsg,sendid);
}

function onOpen(evt) {
    console.log('onOpen socket',evt);
    // binduid(evt);
}

function onClose(evt) {
    console.log('onClose socket',evt)
}

function onMessage(evt) {
    var json = JSON.parse(evt.data);
    console.log(json);
    if (!json.status) {
        alert(json.msg);
    } else {
        switch (json.type) {
            case 'connect':
                binduid(json.data.client_id);
                break;
            case 'ping':
                console.log(json);
                break;
            case 'default':
                console.log(json);
                break;
        }
    }

}

function onError(evt) {
    console.log('onError socket',evt)
}

function doSend(message, action, send_clientid) {
    var json = {
        'data':message,
        'action': action,//'user/sendmsg',
        'sendto': send_clientid,
        'sign':'123456asdwq',
    };
    var str = JSON.stringify(json);
    console.log("SENT: " + str);
    websocket.send(str);
}

