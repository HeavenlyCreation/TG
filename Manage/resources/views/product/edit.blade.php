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
                    <div class="col-sm-9">
                        <div class="input-group">
                            <span class="input-group-addon">￥</span>
                            <input type="text" class="form-control col-sm-11" id="txtPrice" name="txtPrice" value="{{ $product->Price or "" }}"
                                 aria-label="Amount (to the nearest dollar)">
                        </div>
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
        function Init(){
            $("#txtPrice").on("focus",function(){
                $(this).select();
            });
        }

        function vaildForm(){
            if ($.trim($("#txtPrice").val())=="" 
                || isNaN($("#txtPrice").val())) {
                alert("请输入正确价格");
                return false;
            }
            return true;
        }
    </script>
    <script type="text/javascript">
        Init();
        $('.btn-save').click(function() {
            if (vaildForm()) {
                // bind 'myForm' and provide a simple callback function
                $('#myForm').ajaxSubmit({
                    url: '/Product/Edit',
                    type: 'POST',
                    data: {'ProductID': '{{ $product->ProductID }}'},
                    dataType:"json",
                    success: function(data){
                        if(data.status=="success"){
                            location.href="/Product/List";
                        }else{
                            alert(data.mess);
                        }
                    }
                });
            }
        });
    </script>
@stop