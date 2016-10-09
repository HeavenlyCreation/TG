@extends('layout.main')

@section('content')
<!-- SELECT2 EXAMPLE -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">
            {{ $worker->User->Name }}
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
                <label for="" class="col-sm-2 control-label">工号</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">{{ $worker->JobNumber or "" }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">身份证</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">{{ $worker->IdentityNum or "" }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">电话号码</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">{{ $worker->User->Tel or "" }}</label><br/>
                    <label for="" class="control-label">{{ $worker->User->Tel2 or "" }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">微信号</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">{{ $worker->WxCD or "" }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">所在地区</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">{{ $worker->Address->AddressName or "" }}{{ $worker->AddressDif or "" }}</label>
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