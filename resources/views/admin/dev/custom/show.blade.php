@extends('admin.layout.head')

@section('pagetitle', '客服消息')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            客服系统
            <small>13 人等待中 </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="#" id="socket_start" class="btn btn-primary btn-block margin-bottom" data-start="end">开 始 接 待</a>
                <a href="#" id="socket_pause" class="btn btn-warning btn-block margin-bottom" data-start="end">暂 停 接 待</a>
                <a href="#" id="socket_end" class="btn btn-default btn-block margin-bottom" data-start="end">下 线</a>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">统计</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="#"><i class="fa fa-inbox"></i> 总接待人数
                                    <span class="label label-primary pull-right">500</span></a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i> 本周</a></li>
                            <li><a href="#"><i class="fa fa-file-text-o"></i> 今日</a></li>
                            <li><a href="#"><i class="fa fa-filter"></i> 满意 <span class="label label-warning pull-right">65</span></a>
                            </li>
                            <li><a href="#"><i class="fa fa-trash-o"></i> 一般</a></li>
                            <li><a href="#"><i class="fa fa-trash-o"></i> 不满意</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">接待中(3)人</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chat</h3>

                       {{-- <div class="box-tools pull-right">
                            <div class="has-feedback">
                                <input type="text" class="form-control input-sm" placeholder="Search Mail">
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div>
                        </div>--}}
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <!-- Direct Chat -->
                        <div class="row">
                            <div class="col-md-5">
                                <!-- DIRECT CHAT SUCCESS -->
                                <div class="box box-success direct-chat direct-chat-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Direct Chat</h3>

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
                                    <div class="box-body">
                                        <!-- Conversations are loaded here -->
                                        <div class="direct-chat-messages">
                                            <!-- Message. Default to the left -->
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-info clearfix">
                                                    <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                                    <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                                                </div>
                                                <!-- /.direct-chat-info -->
                                                <img class="direct-chat-img" src="/dist/img/user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                                                <div class="direct-chat-text">
                                                    Is this template really for free? That's unbelievable!
                                                </div>
                                                <!-- /.direct-chat-text -->
                                            </div>
                                            <!-- /.direct-chat-msg -->

                                            <!-- Message to the right -->
                                            <div class="direct-chat-msg right">
                                                <div class="direct-chat-info clearfix">
                                                    <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                                    <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                                                </div>
                                                <!-- /.direct-chat-info -->
                                                <img class="direct-chat-img" src="/dist/img/user3-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                                                <div class="direct-chat-text">
                                                    You better believe it!
                                                </div>
                                                <!-- /.direct-chat-text -->
                                            </div>
                                            <!-- /.direct-chat-msg -->
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
                                                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                                <span class="input-group-btn">
                        <button type="submit" class="btn btn-success btn-flat">Send</button>
                      </span>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.box-footer-->
                                </div>
                                <!--/.direct-chat -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-5">
                                <!-- DIRECT CHAT SUCCESS -->
                                <div class="box box-success direct-chat direct-chat-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Direct Chat</h3>

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
                                    <div class="box-body">
                                        <!-- Conversations are loaded here -->
                                        <div class="direct-chat-messages">
                                            <!-- Message. Default to the left -->
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-info clearfix">
                                                    <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                                    <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                                                </div>
                                                <!-- /.direct-chat-info -->
                                                <img class="direct-chat-img" src="/dist/img/user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                                                <div class="direct-chat-text">
                                                    Is this template really for free? That's unbelievable!
                                                </div>
                                                <!-- /.direct-chat-text -->
                                            </div>
                                            <!-- /.direct-chat-msg -->

                                            <!-- Message to the right -->
                                            <div class="direct-chat-msg right">
                                                <div class="direct-chat-info clearfix">
                                                    <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                                    <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                                                </div>
                                                <!-- /.direct-chat-info -->
                                                <img class="direct-chat-img" src="/dist/img/user3-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                                                <div class="direct-chat-text">
                                                    You better believe it!
                                                </div>
                                                <!-- /.direct-chat-text -->
                                            </div>
                                            <!-- /.direct-chat-msg -->
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
                                                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                                <span class="input-group-btn">
                        <button type="submit" class="btn btn-success btn-flat">Send</button>
                      </span>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.box-footer-->
                                </div>
                                <!--/.direct-chat -->
                            </div>
                        </div>
                        <!-- /.row -->
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">
                        {{--<div class="mailbox-controls">--}}
                            {{--<!-- Check all button -->--}}
                            {{--<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>--}}
                            {{--</button>--}}
                            {{--<div class="btn-group">--}}
                                {{--<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>--}}
                                {{--<button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>--}}
                                {{--<button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>--}}
                            {{--</div>--}}
                            {{--<!-- /.btn-group -->--}}
                            {{--<button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>--}}
                            {{--<div class="pull-right">--}}
                                {{--1-50/200--}}
                                {{--<div class="btn-group">--}}
                                    {{--<button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>--}}
                                    {{--<button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>--}}
                                {{--</div>--}}
                                {{--<!-- /.btn-group -->--}}
                            {{--</div>--}}
                            {{--<!-- /.pull-right -->--}}
                        {{--</div>--}}
                    </div>
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    $('#socket_start').click(function () {
        var wsUri ="ws://127.0.0.1:44444";
        testWebSocket(wsUri);

        //发送认证 信息 token  请求接口，获取一个token uuid
        // $.ajax({
        //     url: '',
        //     data: { },
        //     success: function ($data) {

    //         }
    //     });
    //
    });

    //暂停
    $('#socket_pause').click(function () {
        // 发送 socket信息 暂停信息  修改数据库状态

    });
    //停止
    $('#socket_end').click(function(){
        //发送 socket 关闭信息 修改数据库状态 关闭连接
    });



    function testWebSocket(wsUri) {
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

    function onOpen(evt) {
        console.log('onOpen socket',evt)
        var token  = '66ab5577974e9f50';
        var uuid = '7272aee0-cbc8-11e8-a6af-33fed8b105fd';
        doSend({
            //认证
            "token":token,
            "type" : 'custom',
            "uuid" : uuid,
        },'auth/bind');

    }

    function onClose(evt) {
        console.log('onClose socket',evt)
    }

    function onMessage(evt) {
        console.log('onMessage socket',evt)
    }

    function onError(evt) {
        console.log('onError socket',evt)
    }

    function doSend(message,action) {
        var json = {
            'data':message,
            'action': action,//'user/sendmsg',
            'sign':'123456asdwq',
        };
        var str = JSON.stringify(json);
        console.log("SENT: " + str);
        websocket.send(str);
    }


</script>
@endsection
