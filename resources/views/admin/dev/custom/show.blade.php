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
            <a href="#" id="socket_start" class="btn btn-primary  margin-bottom" data-start="end">开 始 </a>
            <a href="#" id="socket_pause" class="btn btn-warning margin-bottom" data-start="end">暂 停 </a>
            <a href="#" id="socket_end" class="btn btn-default margin-bottom" data-start="end">下 线</a>

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <h2 class="page-header">

        </h2>


        <!-- /.row -->
        <div class="row">

            <div class="col-md-3">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-aqua-active">
                        <div class="widget-user-image">
                            <img class="img-circle" src="/dist/img/user7-128x128.jpg" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">Nadia Carmichael</h3>
                        <h5 class="widget-user-desc">Lead Developer
                            <span class="pull-right badge " id = 'online_bg'>Online</span>
                        </h5>

                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
                            <li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                            <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                            <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.widget-user -->


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
                        <div class="row" id="chat-row">


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
        var obj = {
            'bindRoutep': routes.adminbind,
            'msginit': adminMsgInit,
            'onmsg' : adminOnMsg,
        }
        startWebSocket(obj);
    });

    //暂停
    $('#socket_pause').click(function () {
        // 发送 socket信息 暂停信息  修改数据库状态

    });
    //停止
    $('#socket_end').click(function(){
        //发送 socket 关闭信息 修改数据库状态 关闭连接
    });

    //消息连接处理
    function adminMsgInit(json) {
        var uid = json.data.uid;
        var datas = {
            'uid':uid,
            // 'from':json.from,
        };
           console.log('adminMsgInit', json);
        var html = tempChat(datas);
        $("#chat-row").append(html);
        console.log('adminMsgInit');
    }
    //消息处理
    function adminOnMsg(json)
    {
        var uid = json.from;

        console.log('onmsgchat',json);
        var temp = leftMessage({'msg':json.data});
        $('#'+uid+' #direct-chat-msg').append(temp);

    }
    function sendToMsg(ele)
    {
        var value = $(ele).parent().parent().find('input').val();
        var elementid = $(ele).attr('data-clientid');
        sendMsg(value,elementid);
        console.log(elementid,'data-clientid');
        var temp = rightMssage({'msg':value});
        $(ele).parents('.direct-chat').find('#direct-chat-msg').append(temp);
    }
    //聊天的模板
    function tempChat(data) {
        var tem  = `
        <div class="col-md-5" id='${data.uid}'>
            <div class="box box-success direct-chat direct-chat-success" >
            <div class="box-header with-border">
            <h3 class="box-title" >Direct Chat</h3>

            <div class="box-tools pull-right">
            <span data-toggle="tooltip" title="3 New Messages" class="badge bg-green">3</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
            <i class="fa fa-comments"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            </div>

            <div class="box-body">

            <div class="direct-chat-messages">

            <div class="direct-chat-msg" id='direct-chat-msg'>


            </div>




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
            <button type="button" class="btn btn-success btn-flat" data-clientid="${data.uid}" onclick="sendToMsg(this)">Send</button>
            </span>
            </div>
            </form>
            </div>
            <!-- /.box-footer-->
            </div>
            <!--/.direct-chat -->
            </div>
            `;
        return  tem;
    }






</script>
@endsection
