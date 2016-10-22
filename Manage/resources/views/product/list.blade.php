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
                        <a href="/Product/Add" class="btn btn-default">新增</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>产品名称</th>
                            <th>产品类别</th>
                            <th>价格</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>产品名称</th>
                            <th>产品类别</th>
                            <th>价格</th>
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
                "url": "/Product/List",
                "data": {
                    "_token": "{{ csrf_token() }}"
                },
                "dataSrc":function(json){
                    return json.data;
                }
            },
            columns: [
                { "data": "ProductID" },
                { "data": "ProductName" },
                { "data": "CategoryName" },
                { "data": "Price" },
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
                        return "<span style='margin-right:14px;'><a href='{{url('Product/Detail/')}}/"+row.ProductID+"'><i class='fa fa-file-text-o'></i></a></span>"
                                +"<span style='margin-right:14px;'><a href='{{url('Product/Edit/')}}/"+row.ProductID+"'><i class='fa fa-edit'></i></a></span>"
                                +"<span><a href='{{url('Order/Detail/')}}/"+row.OrderID+"'><i class='fa fa-remove'></i></a></span>";
                    }
                }
            ]
        });
    });
    function DelProduct(ProductId){
        var mess = "确定删除？";
        if (!confirm(mess)) {
            return;
        }
        $.ajax({
            type: "post",
            url: "{{url('Product/Del/')}}/" + ProductId,
            data: {"_token": "{{ csrf_token() }}"},
            success: function (data) {
                alert(data);
                $("#example1").dataTable().fnDraw(false);
            }
        });
    }
</script>
@stop