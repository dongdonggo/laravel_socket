let routes ={
    "sendmsg": "user/sendmsg" ,
    "adminbind": "/auth/custom/adminbind",
    "personbind": "/auth/custom/persionbind"
}
var bindRoute = '';

/**
 *
 * @param obj object bindRoutep 绑定的路由
 */
function startWebSocket(obj) {
    bindRoute =obj.bindRoutep;
    var wsUri ="ws://127.0.0.1:44444";
    websocket = new WebSocket(wsUri);
    websocket.onopen = function(evt) {
        onOpen(evt)
    };
    websocket.onclose = function(evt) {
        onClose(evt)
    };
    websocket.onmessage = function(evt) {
        onMessage(evt,obj)
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

/**
 * 滚动
 */
function scrollLow() {
    var scrollDom = document.getElementById('direct-chat-msg');
    scrollDom.scrollTop = scrollDom.scrollHeight
}

/**
 data.msg
 */
function rightMssage(data)
{
    return  `

            <div class="direct-chat-msg right" style="position: relative;">
                <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right">name</span>
                    <span class="direct-chat-timestamp" style="position: absolute;left:0px;right:0px;text-align: center;">23 Jan 2:05 pm</span>
                </div>
    
                <img class="direct-chat-img" src="/dist/img/user3-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                <div class="direct-chat-text" style="right: 0px; margin-left: 50px;">
                ${data.msg}
                </div>

            </div>
            `
}

// data.msg
function leftMessage(data)
{
    return `
        <div class="direct-chat-msg" style="position: relative;">
            <div class="direct-chat-info clearfix">
            <span class="direct-chat-name pull-left">name</span>
            <span class="direct-chat-timestamp pull-right" style="position: absolute;left:0px;right:0px;text-align: center;" >23 Jan 2:00 pm</span>
            </div>
            <img class="direct-chat-img" src="/dist/img/user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
            <div class="direct-chat-text" style="left: 0px; margin-right: 50px;">
            ${data.msg}
            </div>
         </div>
            `;
}

function onOpen(evt) {
    console.log('onOpen socket',evt);
    // binduid(evt);
}

function onClose(evt) {
    console.log('onClose socket',evt)
}

function onMessage(evt,eventjson) {
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
            case 'msginit':
                eventjson.msginit(json);
                console.log('会话开始');
                break;
            case 'message': //聊天内容
                eventjson.onmsg(json);
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

