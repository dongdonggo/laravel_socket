@extends('admin.layout.head')

@section('pagetitle', '用户列表')


@section('content')

<!-- DataTables -->
<link rel="stylesheet" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

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

    <!-- Main content -->
    <section class="content"> 

      <!-- Main row -->
      <div class="row">
          <div class="col-xs-12">
              <div class="box">
                  <div class="box-header with-border">
                      <div class="pull-right">

                          <div class="btn-group pull-right" style="margin-right: 10px">
                              <a class="btn btn-sm btn-twitter" title="导出"><i class="fa fa-download"></i><span class="hidden-xs"> 导出</span></a>
                              <button type="button" class="btn btn-sm btn-twitter dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="/auth/users?_pjax=%23pjax-container&amp;_export_=all" target="_blank">全部</a></li>
                                  <li><a href="/auth/users?_pjax=%23pjax-container&amp;_export_=page%3A1" target="_blank">当前页</a></li>
                                  <li><a href="/auth/users?_pjax=%23pjax-container&amp;_export_=selected%3A__rows__" target="_blank" class="export-selected">选择的行</a></li>
                              </ul>
                          </div>

                          <div class="btn-group pull-right" style="margin-right: 10px">
                              <a href="/admin/dev/users/adduser" class="btn btn-sm btn-success" title="新增">
                                  <i class="fa fa-save"></i><span class="hidden-xs">&nbsp;&nbsp;新增</span>
                              </a>
                          </div>

                      </div>
                      <span>
             <a class="btn btn-sm btn-primary grid-refresh" title="刷新"><i class="fa fa-refresh"></i><span class="hidden-xs"> 刷新</span></a> <div class="btn-group" style="margin-right: 10px" data-toggle="buttons">
    <label class="btn btn-sm btn-dropbox 5bbc3a3fe1513-filter-btn " title="筛选">
        <input type="checkbox"><i class="fa fa-filter"></i><span class="hidden-xs">&nbsp;&nbsp;筛选</span>
    </label>

    </div>
        </span>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body table-responsive no-padding">
                      <table id="example2" class="table table-hover">
                          <thead>
                          <tr>
                              <th>ID</th>
                              <th>用户名</th>
                              <th>姓名</th>
                              <th>角色</th>
                              <th>创建时间</th>
                              <th>更新时间</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($users as $key=>$val)
                              <tr>
                                  <td> {{ $val->id }} </td>
                                  <td> {{ $val->username }} </td>
                                  <td> {{ $val->name }} </td>

                                  <td><span class="label label-success"> {{ $val->roles[0]->name}} </span></td>
                                  <td> {{ $val->created_at }} </td>
                                  <td> {{ $val->updated_at }} </td>
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                  </div>
                  <div class="box-footer clearfix">
                      从 <b>1</b> 到 <b>20</b> ，总共 <b>173</b> 条<ul class="pagination pagination-sm no-margin pull-right">
                          <!-- Previous Page Link --><li class="page-item disabled"><span class="page-link">«</span></li>

                          <!-- Pagination Elements -->
                          <!-- "Three Dots" Separator -->

                          <!-- Array Of Links -->
                          <li class="page-item active"><span class="page-link">1</span></li>
                          <li class="page-item"><a class="page-link" href="http://demo.laravel-admin.org/config?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc&amp;_pjax=%23pjax-container&amp;page=2">2</a></li>
                          <li class="page-item"><a class="page-link" href="http://demo.laravel-admin.org/config?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc&amp;_pjax=%23pjax-container&amp;page=3">3</a></li>
                          <li class="page-item"><a class="page-link" href="http://demo.laravel-admin.org/config?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc&amp;_pjax=%23pjax-container&amp;page=4">4</a></li>
                          <li class="page-item"><a class="page-link" href="http://demo.laravel-admin.org/config?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc&amp;_pjax=%23pjax-container&amp;page=5">5</a></li>
                          <li class="page-item"><a class="page-link" href="http://demo.laravel-admin.org/config?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc&amp;_pjax=%23pjax-container&amp;page=6">6</a></li>
                          <li class="page-item"><a class="page-link" href="http://demo.laravel-admin.org/config?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc&amp;_pjax=%23pjax-container&amp;page=7">7</a></li>
                          <li class="page-item"><a class="page-link" href="http://demo.laravel-admin.org/config?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc&amp;_pjax=%23pjax-container&amp;page=8">8</a></li>
                          <li class="page-item"><a class="page-link" href="http://demo.laravel-admin.org/config?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc&amp;_pjax=%23pjax-container&amp;page=9">9</a></li>

                          <!-- Next Page Link -->
                          <li class="page-item"><a class="page-link" href="http://demo.laravel-admin.org/config?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc&amp;_pjax=%23pjax-container&amp;page=2" rel="next">»</a></li>
                      </ul>
                      <label class="control-label pull-right" style="margin-right: 10px; font-weight: 100;">

                          <small>显示</small>&nbsp;
                          <select class="input-sm grid-per-pager" name="per-page"><option value="http://demo.laravel-admin.org/config?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc&amp;_pjax=%23pjax-container&amp;per_page=10">10</option>
                              <option value="http://demo.laravel-admin.org/config?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc&amp;_pjax=%23pjax-container&amp;per_page=20" selected="">20</option>
                              <option value="http://demo.laravel-admin.org/config?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc&amp;_pjax=%23pjax-container&amp;per_page=30">30</option>
                              <option value="http://demo.laravel-admin.org/config?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc&amp;_pjax=%23pjax-container&amp;per_page=50">50</option>
                              <option value="http://demo.laravel-admin.org/config?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc&amp;_pjax=%23pjax-container&amp;per_page=100">100</option></select>
                          &nbsp;<small>条</small>
                      </label>

                  </div>
                  <!-- /.box-body -->
              </div>
          </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>



  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>





  <!-- DataTables -->
  <script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="/bower_components/fastclick/lib/fastclick.js"></script>
    <script>
        $(function () {
            var jsos = {
                'paging'      : false,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : false,
                'autoWidth'   : false,
                "columns": [
                    { "orderable": true , "targets": 0},
                    { "orderable": false , "targets": 1},
                    { "orderable": false , "targets": 2},
                    { "orderable": false , "targets": 3},
                    { "orderable": false , "targets": 4},
                ]
            };
            $('#example2').DataTable(jsos);
        })
    </script>
@endsection
