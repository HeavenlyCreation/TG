@extends('layout.main')

@section("header")
    <link rel="stylesheet" href="{{asset("/plugin/datetimepicker/css/bootstrap-datetimepicker.min.css")}}">
@stop

@section('content')
<!-- SELECT2 EXAMPLE -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">
            {{ $product->ProductName }}
        </h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="form-horizontal">
        <div class="box-body">
            <form id="myForm" action="#">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">服务名称</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="txtProductName" name="txtProductName" value="{{ $product->ProductName or "" }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">服务类别</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="selCategorys" name="selCategorys">
                            @foreach($categorys->data as $item)
                                <option {{$item->ProductCategoryID == $categorys->default?"selected":""}} value={{$item->ProductCategoryID}}>{{$item->CategoryName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">价格</label>
                    <label for="" class="col-sm-1 control-label">￥</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtPrice" name="txtPrice" value="{{ $product->Price or "" }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">备注</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="txtRemark" name="txtRemark">{{ $product->Remark or "" }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                <label for="" class="col-sm-2 control-label">创建时间</label>
                <div class="col-sm-9">
                    <div class="input-group date dtpicker col-md-5" data-date="{{\Carbon\carbon::now()}}" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_CreatedTime">
                        <input id="dateCreatedTime" class="form-control" size="16" type="text" value="{{ $product->CreatedTime or \Carbon\carbon::now() }}" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                    <input type="hidden" id="dtp_CreatedTime" name="dateCreatedTime"  value="" /><br/>
                </div>
            </div>
            </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right">
                <button type="button" class="btn btn-default" onclick="location.href='/Product/List'">返回</button>
                <button type="submit" class="btn btn-primary btn-save">保存</button>
            </div>
        </div>
    </div>
</div>
<!-- /.box -->
@stop

@section("footer")
    <script src="{{asset("/plugin/datetimepicker/js/bootstrap-datetimepicker.js")}}"></script>
    <script src="{{asset("/plugin/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js")}}"></script>
    <script src="{{asset("/js/jquery.form.js")}}"></script>
    <script type="text/javascript">
    $('.btn-save').click(function() {
        // bind 'myForm' and provide a simple callback function
        $('#myForm').ajaxSubmit({
            url: '/Product/Edit',
            type: 'POST',
            data: {'ProductID': '{{ $product->ProductID }}'},
            success: function(data){
                alert(data);
            }
        });
    });

//    $('.dtpicker').datetimepicker({
//        language:  'zh-CN',
//        weekStart: 1,
//        todayBtn:  1,
//        autoclose: 1,
//        todayHighlight: 1,
//        startView: 2,
//        forceParse: 0,
//        showMeridian: 1
//    });
    </script>
@stop