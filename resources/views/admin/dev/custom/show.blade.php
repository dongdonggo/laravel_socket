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

                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">客服--小小</h3>
                        <h5 class="widget-user-desc">商城客服
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
                    <br><br>
                        <div class="row" id="chat-row">
                            <div class="row d_pos">
                                <div class="col-md-12 ">
                                    <!-- DIRECT CHAT SUCCESS -->
                                    <div class="box box-success direct-chat direct-chat-success">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">online Chat</h3>

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
                                        <div class="box-body box-content" style="">
                                            <!-- Conversations are loaded here -->
                                            <div class="direct-chat-messages" id="direct-chat-msg" style="height:295px;">





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
                                        <div class="box-footer" style="">
                                            <form action="#" method="post">
                                                <div class="input-group">
                                                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                                    <span class="input-group-btn">
                                                    <button id="btn-send" type="button" class="btn btn-success btn-flat" data-clientid="3" onclick="sendToMsg(this)">Send</button>
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

                    <div class="box-footer no-padding">

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
        var atrrid = $('#'+uid).attr('id');
        if (atrrid) {
            console.log('adminMsgInit alerady has');
            return ;
        }
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
        scrollLow();

    }
    function sendToMsg(ele)
    {

        var inpuele = $(ele).parent().parent().find('input');
        var value = inpuele.val();
        var elementid = $(ele).attr('data-clientid');
        sendMsg(value,elementid);
        console.log(elementid,'data-clientid');
        var temp = rightMssage({'msg':value});
        $(ele).parents('.direct-chat').find('#direct-chat-msg').append(temp);
        inpuele.val('');
        scrollLow();
    }
    //聊天的模板
    function tempChat(data) {
        var tem  = `
       <div class="row d_pos ">
        <div class="col-md-5"  id='${data.uid}'>
            <!-- DIRECT CHAT SUCCESS -->
            <div class="box box-success direct-chat direct-chat-success">
            <div class="box-header with-border">
            <h3 class="box-title">online Chat</h3>

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
            <div class="box-body box-content" style="">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages" id="direct-chat-msg" style="height:295px;">






            <div class="direct-chat-msg" style="position: relative;">
            <div class="direct-chat-info clearfix">
            <span class="direct-chat-name pull-left">name</span>
            <span class="direct-chat-timestamp pull-right" style="position: absolute;left:0px;right:0px;text-align: center;">23 Jan 2:00 pm</span>
            </div>
            <img class="direct-chat-img" src="/dist/img/user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
            <div class="direct-chat-text" style="left: 0px; margin-right: 50px;">
            开始会话
            </div>
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
            <div class="box-footer" style="">
            <form action="#" method="post">
            <div class="input-group">
            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
            <span class="input-group-btn">
            <button id="btn-send" type="button" class="btn btn-success btn-flat" data-clientid="${data.uid}" onclick="sendToMsg(this)">Send</button>
            </span>
            </div>
            </form>
            </div>
            <!-- /.box-footer-->
            </div>
            <!--/.direct-chat -->
            </div>
            </div>
            `;
        return  tem;
    }






</script>
@endsection
