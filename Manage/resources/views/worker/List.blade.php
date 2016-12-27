@extends('layout.main')

@section('header')
    <link rel="stylesheet" href="{{asset("/plugin/datatables/dataTables.bootstrap.css")}}"/>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            <div class="box-header">
                <div class="btn-group">
                    <a href="/Worker/Add" class="btn btn-default">新增</a>
                </div>
            </div>
            <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>工号</th>
                            <th>姓名</th>
                            <th>手机号</th>
                            <th>微信号</th>
                            <th>所在地区</th>
                            <th>工作状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>工号</th>
                            <th>姓名</th>
                            <th>手机号</th>
                            <th>微信号</th>
                            <th>所在地区</th>
                            <th>工作状态</th>
                            <th>操作</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@stop


@section('footer')
    <!-- DataTables -->
    <script src="{{asset("/plugin/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("/plugin/datatables/extensions/TableTools/js/dataTables.tableTools.min.js")}}"></script>
    <script src="{{asset("/plugin/datatables/dataTables.bootstrap.min.js")}}"></script>
    <script src="{{asset("/js/dt.js")}}"></script>
    <!-- page script -->
    <script>
        $(function () {
            $('#example1').dataTable({
                ajax: {
                    "url": "/Worker/List",
                    "data": {
                        "_token": "{{ csrf_token() }}"
                    },
                    "dataSrc": function (json) {
                        return json.data;
                    }
                },
                columns: [
                    {"data": "UserID"},
                    {"data": "JobNumber"},
                    {"data": "Name"},
                    {"data": "Tel"},
                    {"data": "WxCD"},
                    {"data": "AddressDif"},
                    {"data": "WorkStatus"},
                    {"data": ""}
                ],
                columnDefs: [
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": -1,
                        "render": function (data, type, row) {
                            return "<span style='margin-right:14px;'><a href='{{url('Worker/Detail/')}}/" + row.UserID + "'><i class='fa fa-file-text-o'></i></a></span>"
                                    + "<span style='margin-right:14px;'><a href='{{url('Worker/Edit/')}}/" + row.UserID + "'><i class='fa fa-edit'></i></a></span>"
                                    + "<span style='margin-right:14px;'><a href='javascript:removeWorker(" + row.UserID + ")'><i class='fa fa-remove'></i></a></span>";
                        }
                    }
                ]
            });
        });

        function removeWorker(workerId) {
            if (!confirm("确定删除？")) {
                return;
            }
            $.ajax({
                type: "post",
                url: "{{url('Worker/Del/')}}/" + workerId,
                data: {"_token": "{{ csrf_token() }}"},
                dataType:"json",
                success: function (data) {
                    alert(data.mess);
                    $("#example1").dataTable().fnDraw(false);
                }
            });
        }

    </script>
@stop