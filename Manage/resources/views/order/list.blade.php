@extends('layout.main')

@section('header')
    <link rel="stylesheet" href="{{asset("/plugin/datatables/dataTables.bootstrap.css")}}" />
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="btn-group">
                        <a href="/Order/Add" class="btn btn-default">新增</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>订单编号</th>
                            <th>顾客</th>
                            <th>总价</th>
                            <th>下单时间</th>
                            <th>预定时间</th>
                            <th>订单状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>订单编号</th>
                            <th>顾客</th>
                            <th>总价</th>
                            <th>下单时间</th>
                            <th>预定时间</th>
                            <th>订单状态</th>
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
                "url": "/Order/List",
                "data": {
                    "_token": "{{ csrf_token() }}"
                },
                "dataSrc":function(json){
                    return json.data;
                }
            },
            columns: [
                { "data": "OrderID" },
                { "data": "OrderNum" },
                { "data": "Customer" },
                { "data": "SumPrice" },
                { "data": "CommitTime" },
                { "data": "BookFitTime" },
                { "data": "OrderStatus" },
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
                        return "<span style='margin-right:14px;'><a href='{{url('Order/Detail/')}}/"+row.OrderID+"'><i class='fa fa-file-text-o'></i></a></span>"
                                +"<span style='margin-right:14px;'><a href='{{url('Order/Edit/')}}/"+row.OrderID+"'><i class='fa fa-edit'></i></a></span>"
                                +"<span><a href='javascript:DelOrder("+row.OrderID+")'><i class='fa fa-remove'></i></a></span>";
                    }
                }
            ]
        });
    });
    function DelOrder(OrderID){
        var mess = "确定删除？";
        if (!confirm(mess)) {
            return;
        }
        $.ajax({
            type: "post",
            url: "{{url('Order/Del/')}}/" + OrderID,
            data: {"_token": "{{ csrf_token() }}"},
            success: function (data) {
                alert(data);
                $("#example1").dataTable().fnDraw(false);
            }
        });
    }
</script>
@stop