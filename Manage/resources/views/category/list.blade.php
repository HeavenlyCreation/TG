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
                        <a href="/ProductCategory/Add" class="btn btn-default">新增</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID</th>
                            <th>产品类别</th>
                            <th>上级类别</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>ID</th>
                            <th>产品类别</th>
                            <th>上级类别</th>
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
                "url": "/ProductCategory/List",
                "data": {
                    "_token": "{{ csrf_token() }}"
                },
                "dataSrc":function(json){
                    return json.data;
                }
            },
            columns: [
                { "data": "ProductCategoryID" },
                { "data": "ParentID" },
                { "data": "CategoryName" },
                { "data": "FCategoryName" },
                { "data": "" }
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": 1,
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": -1,
                    "render": function(data, type, row){
                        return "<span style='margin-right:14px;'><a href='{{url('ProductCategory/Detail/')}}/"+row.ProductCategoryID+"'><i class='fa fa-file-text-o'></i></a></span>"
                                +"<span style='margin-right:14px;'><a href='{{url('ProductCategory/Edit/')}}/"+row.ProductCategoryID+"'><i class='fa fa-edit'></i></a></span>"
                                +"<span><a href='javascript:DelCategory(" + row.ProductCategoryID + "," + row.ParentID + ")'><i class='fa fa-remove'></i></a></span>";
                    }
                }
            ]
        });
    });

    function DelCategory(ProductCategoryID,ParentID){
        var mess = "确定删除？";
        if(ParentID == null) {
            mess="确定删除该类别以及其子类别？";
        }
        if (!confirm(mess)) {
            return;
        }
        $.ajax({
            type: "post",
            url: "{{url('ProductCategory/Del/')}}/" + ProductCategoryID,
            data: {"_token": "{{ csrf_token() }}"},
            success: function (data) {
                alert(data);
                $("#example1").dataTable().fnDraw(false);
            }
        });
    }
</script>
@stop