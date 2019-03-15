<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Starter</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/bower_components/bootstrap//dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="/dist/css/skins/skin-blue.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .d_pos {
            position: fixed;
            bottom: 10vh;
            right: 2vw;
            width: 350px;
        }
        .box-content{
            height: 300px;
        }
    </style>
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div id="compent">

</div>
<div class="wrapper">

    <div class="row d_pos"  >
        <div class="col-md-12 ">
            <!-- DIRECT CHAT SUCCESS -->
            <div class="box box-success direct-chat direct-chat-success" >
                <div class="box-header with-border">
                    <h3 class="box-title" >online Chat</h3>

                    <div class="box-tools pull-right">
                        <span data-toggle="tooltip" title="3 New Messages" class="badge bg-green">3</span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                            <i class="fa fa-comments"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body box-content">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages" id ='direct-chat-msg' style="height:295px;">





                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="/dist/img/user1-128x128.jpg" alt="User Image">

                                    <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              Count Dracula
                              <small class="contacts-list-date pull-right">2/28/2015</small>
                            </span>
                                        <span class="contacts-list-msg">How have you been? I was...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                        </ul>
                        <!-- /.contatcts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <form action="#" method="post">
                        <div class="input-group">
                            <input type="text" name="message"  placeholder="Type Message ..." class="form-control">
                            <span class="input-group-btn">
                                                    <button id="btn-send" type="button" class="btn btn-success btn-flat" data-clientid="" onclick="sendToMsg(this)">Send</button>
                                                </span>
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                    <form action="#" method="post">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <img class="" style="display: inline;vertical-align: middle;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAEIElEQVQ4ja2UXWyTZRTHf33e923XD8a6bkPGgsAcQxxxIYIdRIQwhGAYasAERCHBG43xwiujmOiFkSv5UCABQgzKjUH52IYYNBB10I5MB9MhNGTAxoBRutJ27dr343hRFvGDxAtPcpLn+T8n/3PynPM/8D+b60EP9WU0LHuY55+cTFNNhV4DMBC3BqLXOHP8KocuJvn1PxGWl1D17hw2b2ipeHlc4yJdmzwfl78aABkZxL7WQbr7pPXZ0fjnH57l7cQoQw+sdmopM6IbVcw81iwSbxMZ6RZJRUSGfyh6KlLE4m1iHmuW6EYVm1rKjPsLGzu4gh6qTryiIo0vLZuizXod8mlwsiDyt7QuUD7wjMPu2Un3geNXlux3wsN5hgDR7oVpHy1w7WpZM22B3rAGcoNgDoGTBjsNZgqsNDiZImbegfwdVKieKm+szHszOfHbKxwZI1R1ZTTuetW73fv4XBfKgPwQGDkopEDLQj4Fdgb07J9YLgH2KMqrmOnub/iq0zqaGOWWArQVta61vpqAwmVBtg/0OL3Rc6xft5tTrR2g3wL9FqdaO1i/bje90XOgx4uxmoWvJqBW1LrWApoO6E21elgrdUPhJmAADocP/ka136H9yHkWPpEGoP1IH9V+h8MHu5g54zEYVYCJVuqmqVYP02XqCjCqQ1oVhhsKaSjEkUSC4KQA729poH52BZmkQybpUD+7gg+2NBCcFEASCSjEi81zu6kOaVWA4QLKO15zR8IrK+uURwO3DQEBtw6OA44GebvYOo8GygZdQdaCjAtMDSdvEzl6OzZ/VyGsA3I9YccxM3V4YdN7I4RCFvWPwISHoKwcSryAA7kcJBNw4wb0/g6mbbDpHT+khesJ+zYgOmBG+pzzz+XNJhWwMH3jUU/vJ+HL0R+/in15CMfKFgfW8GP4JuCbOQUqLOzODeDPYvcbRPqcHsAEMOqCtKR2eGzpCch3W5HVC+bKzh0fy49nf5EbKVtMEcmLyEAiLydPR2X71s3ywrxZEt2DSHdAUp947LogLYChA1ZsmK59rWb7m9OMFYtXBrh6oZO+PZ0MfglfK3BU8QuVDX4HJAmrm2HuMwGkB/a1m+2xYboAa0x67vIS5n3/hv5F4yrvJGrgmwMmmQsWpSU2hl6Un2kqUnlFsFGn+UUD+qD7UO764k+tdYlRTgOFMek5OYu7J3qd2FNeJzyxUhtft8jAN0XnrqaR03TM8QbeWoOG5W5mz9PhosPPraP9q/Zabw1mOANk/7FtgMqQl6Xblqu29D6PJaf9IpdLRfrv+eVSkZ/8kt7rsbYtV20hL0uByn/bNvffxwE19SHmPDvdtTA8XT1aU+WqABgYknjkknOh/ZKcuniHs8AAkAbkQYRjpoAyIAj4Afc9vACMAMNAsjidf7U/AC8J3bioSnIJAAAAAElFTkSuQmCC" unicode16="1f604">
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.box-footer-->
            </div>
            <!--/.direct-chat -->
        </div>
    </div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="/bower_components/jquery//dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/bower_components/bootstrap//dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>

<script src="/js/socket.js"></script>

<script src="/js/emoji-lib/emoji-list-with-image.js"></script>
<script src="/js/emoji-lib/punycode.js"></script>
<script src="/js/emoji-lib/emoji.js "></script>
<script>
    var obj = {
        'bindRoutep': routes.personbind,
        'msginit': personMsgInit,
        'onmsg': onMsgchat,
    }
    startWebSocket(obj);
    function personMsgInit(json) {
        var uid = json.data.adminid;
        console.log('会话开始', json);
        $('#btn-send').attr('data-clientid',uid);
        // console.log( $('#btn-send'));
        var value = $('#btn-send').attr('data-clientid');
        // console.log('data-client',value);

    }

    function sendToMsg(ele)
    {
        var inpuele = $(ele).parent().parent().find('input');
        var value = inpuele.val();
        var elementid = $(ele).attr('data-clientid');
        sendMsg(value,elementid);
        console.log(elementid,'data-clientid');
        var temp = rightMssage({'msg':value});
        $('#direct-chat-msg').append(temp);
        inpuele.val('');
        scrollLow();
    }
    function onMsgchat(json) {
        console.log('onmsgchat',json);
        var temp = leftMessage({'msg':json.data});
        $('#direct-chat-msg').append(temp);
        scrollLow();
    }

    //示例生成emoji图片输入
    function renderEmoji()
    {
        var emos = getEmojiList()[0];//此处按需是否生成所有emoji
        var html = '<div >常用表情</div><ul>';
        for (var j = 0; j < emos.length; j++) {
            var emo = emos[j];
            var data = 'data:image/png;base64,' + emo[2];
            if (j % 20 == 0) {
                html += '<li class="">';
            } else {
                html += '<li>';
            }
            html += '<img style="display: inline;vertical-align: middle;" src="' + data + '"  unicode16="' + emo[1] + '" /></li>';

        }
        $('#compent').append(html);
    }
    renderEmoji();
</script>

</body>
</html>