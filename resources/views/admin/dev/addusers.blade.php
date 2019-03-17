@extends('admin.layout.head')

@section('pagetitle', '用户列表')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                后台用户列表
                <small>所有用户列表</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 账户管理</a></li>
                <li class="active">用户列表</li>
            </ol>
        </section>
        <section class="content"><div class="row"><div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">创建</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="/admin/dev/users/adduser" method="post" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" pjax-container="">

                    <div class="box-body">

                        <div class="fields-group">

                            <div class="form-group  ">

                                <label for="username" class="col-sm-2  control-label">用户名</label>

                                <div class="col-sm-8">


                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                        <input type="text" id="username" name="username" value="" class="form-control username" placeholder="输入 用户名">
                                    </div>


                                </div>
                            </div>
                            <div class="form-group  ">

                                <label for="name" class="col-sm-2  control-label">名称</label>

                                <div class="col-sm-8">


                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                        <input type="text" id="name" name="name" value="" class="form-control name" placeholder="输入 名称">
                                    </div>


                                </div>
                            </div>
                            <div class="form-group  ">

                                <label for="password" class="col-sm-2  control-label">密码</label>

                                <div class="col-sm-8">


                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-eye-slash fa-fw"></i></span>

                                        <input type="password" id="password" name="password" value="" class="form-control password" placeholder="输入 密码">
                                    </div>


                                </div>
                            </div>
                            <div class="form-group  ">

                                <label for="roles" class="col-sm-2  control-label">角色</label>

                                <div class="col-sm-8">
                                        <select class="form-control roles select2-hidden-accessible" style="width: 100%;" name="role" multiple="" data-placeholder="输入 角色" data-value="" tabindex="-1" aria-hidden="true">
                                            @foreach($roles as $key=>$val)
                                                <option value="{{ $val->id }}">{{ $val->name  }}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">

                        <input type="hidden" name="_token" value="{{csrf_token()}}" ><div class="col-md-2">
                        </div>

                        <div class="col-md-8">

                            <div class="btn-group pull-right">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>

                            <label class="pull-right" style="margin: 5px 10px 0 0;">
                                <div class="icheckbox_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" class="after-submit" name="after-save" value="1" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 继续编辑
                            </label>

                            <label class="pull-right" style="margin: 5px 10px 0 0;">
                                <div class="icheckbox_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" class="after-submit" name="after-save" value="2" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 查看
                            </label>


                            <div class="btn-group pull-left">
                                <button type="reset" class="btn btn-warning">重置</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div></div>

</section>

    </div>
    <!-- /end Content Wrapper. Contains page content -->
@endsection
