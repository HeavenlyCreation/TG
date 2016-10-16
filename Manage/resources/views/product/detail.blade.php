@extends('layout.main')

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
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">产品名称</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">{{ $product->ProductName or "" }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">类别名称</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">{{ $product->Category->CategoryName }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">价格</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">{{ $product->Price }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">备注</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">{{ $product->Remark }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">创建时间</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">{{ $product->CreatedTime }}</label>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-default pull-right" onclick="history.back();">返回</button>
        </div>
    </div>
</div>
<!-- /.box -->
@stop