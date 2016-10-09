@extends('layout.main')

@section('header')
    <link rel="stylesheet" href="{{asset("/plugin/datatables/dataTables.bootstrap.css")}}" />
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            {{--<div class="box-header">--}}
            {{--<h3 class="box-title">订单信息</h3>--}}
            {{--</div>--}}
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
                    "dataSrc":function(json){
                        return json.data;
                    }
                },
                columns: [
                    { "data": "WorkerID" },
                    { "data": "JobNumber" },
                    { "data": "Name" },
                    { "data": "Tel" },
                    { "data": "WxCD" },
                    { "data": "AddressName" },
                    { "data": "WorkStatus" },
                    { "data": "" }
                ],
                columnDefs: [
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": -1,
                        "render": function(data, type, row){
                            return "<span style='margin-right:14px;'><a href='{{url('Worker/Detail/')}}/"+row.WorkerID+"'><i class='fa fa-file-text-o'></i></a></span>"
                                    +"<span style='margin-right:14px;'><a href='{{url('Worker/Edit/')}}/"+row.WorkerID+"'><i class='fa fa-edit'></i></a></span>";
                        }
                    },
                    {
                        "targets": -2,
                        "render": function(data, type, row){
                            switch(row.WorkStatus){
                                case 0:
                                    return "正常工作";
                                case 1:
                                    return "休息";
                                default:
                                    return "正常工作";
                            }
                        }
                    }
                ]
            });
        });
    </script>
@stop