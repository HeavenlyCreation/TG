@extends('layout.main')

@section('content')
<!-- SELECT2 EXAMPLE -->
<form id="formData" action="#">
{{ csrf_field() }}
<div class="box box-default">
    <div class="box-header with-border">
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="form-horizontal">
        <div class="box-body">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">姓名</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="WorkerName" value="{{ $worker->Name or "" }}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">登录账户</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" {{ isset($account) ? "disabled='disabled'" : "" }} name="UserName" value="{{ $account->UserName or "" }}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">工号</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="JobNumber" value="{{ $worker->JobNumber or "" }}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">身份证</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="IdentityNum" value="{{ $worker->IdentityNum or "" }}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">电话号码</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="Tel" value="{{ $worker->Tel or "" }}"><br/>
                    <input type="text" class="form-control" name="Tel2" value="{{ $worker->Tel2 or "" }}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">微信号</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="WxCD" value="{{ $worker->WxCD or '' }}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">所在地区</label>
                <div class="col-sm-9">
                    <input type="text" name="Address" class="form-control"
                    value="{{--{{ $worker->Address->AddressName or "" }}--}}{{ $worker->AddressDif or "" }}">
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button id="btnSubmit" type="submit" class="btn btn-primary pull-right">保存</button>
            <button type="button" class="btn btn-default pull-right" onclick="history.back();">返回</button>
        </div>
    </div>
</div>

</form>
<!-- /.box -->
@stop

@section('footer')
    <script src="{{asset("/plugin/datetimepicker/js/bootstrap-datetimepicker.js")}}"></script>
    <script src="{{asset("/plugin/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js")}}"></script>
    <script src="{{asset("/js/jquery.form.js")}}"></script>
    <script type="text/javascript">
    $("#btnSubmit").on("click",function(){
        $('#formData').ajaxSubmit({
            type:"post",
            url:"/Worker/Edit",
            data:{},
            success:function(data){
                alert(data);
                if(data=="修改成功"){
                    location.href="/Worker/List";
                }
            }
        });
        return false;
    });
    </script>

@stop
