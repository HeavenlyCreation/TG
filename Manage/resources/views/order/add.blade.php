@extends('layout.main')

@section("header")
    <link rel="stylesheet" href="{{asset("/plugin/datetimepicker/css/bootstrap-datetimepicker.min.css")}}">
@stop

@section('content')
<!-- SELECT2 EXAMPLE -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">

        </h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="form-horizontal">
        <div class="box-body">
            <form action="#" id="myForm">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">下单人</label>
                    <div class="col-sm-9">
                        <label for="" class="col-sm-2 control-label">超级管理员</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">订单产品</label>
                    <div class="col-sm-9">
                        {{--@if (count($order->OrderProduct) > 0)--}}
                        {{--<div class="box">--}}
                            {{--<div class="box-body no-padding">--}}
                                {{--<table class="table table-striped">--}}
                                    {{--<tbody>--}}
                                    {{--<tr>--}}
                                        {{--<th style="width: 10px">#</th>--}}
                                        {{--<th>产品类别</th>--}}
                                        {{--<th>产品名称</th>--}}
                                        {{--<th>单价</th>--}}
                                        {{--<th>数量</th>--}}
                                    {{--</tr>--}}
                                    {{--@foreach ($order->OrderProduct as $item)--}}
                                    {{--<tr>--}}
                                        {{--<td>{{ $loop->index }}</td>--}}
                                        {{--<td>{{ $item->Product->Category->CategoryName }}</td>--}}
                                        {{--<td>{{ $item->Product->ProductName }}</td>--}}
                                        {{--<td>{{ $item->Product->Price }}</td>--}}
                                        {{--<td>{{ $item->Quantity }}</td>--}}
                                    {{--</tr>--}}
                                    {{--@endforeach--}}
                                    {{--</tbody>--}}
                                {{--</table>--}}
                            {{--</div>--}}
                            {{--<!-- /.box-body -->--}}
                        {{--</div>--}}
                        {{--@endif--}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">联系电话</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="txtTel" name="txtTel">
                    </div>
                    <label for="" class="col-sm-3 control-label">总金额</label>
                    <div class="col-sm-3">
                        <input type="SumPrice" class="form-control" id="txtSumPrice" name="txtSumPrice">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">安装地址</label>
                    <div class="col-sm-3">
                        <select class="form-control" id="province">
                            @foreach($province->data as $item)
                                <option {{$item->AddressCD == $province->default?"selected":""}} value={{$item->AddressCD}}>{{$item->AddressName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" id="city">
                            {{--@foreach($city->data as $item)--}}
                                {{--<option {{$item->AddressCD == $city->default?"selected":""}} value={{$item->AddressCD}}>{{$item->AddressName}}</option>--}}
                            {{--@endforeach--}}
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" id="district" name="selDistrict">
                            {{--@foreach($district->data as $item)--}}
                                {{--<option {{$item->AddressCD == $district->default?"selected":""}} value={{$item->AddressCD}}>{{$item->AddressName}}</option>--}}
                            {{--@endforeach--}}
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="txtAddress" name="txtAddress"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">提交时间</label>
                    <div class="col-sm-3">
                        <div class="input-group date dtpicker col-md-12" data-date="{{\Carbon\carbon::now()}}" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_CommitTime">
                            <input id="CommitTime" class="form-control" size="16" type="text" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                        <input type="hidden" id="dtp_CommitTime" name="dateCommitTime" value="" /><br/>
                    </div>
                    <label for="" class="col-sm-3 control-label">预约时间</label>
                    <div class="col-sm-3">
                        <div class="input-group date dtpicker col-md-12" data-date="{{\Carbon\carbon::now()}}" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_BookFitTime">
                            <input id="BookFitTime" class="form-control" size="16" type="text" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                        <input type="hidden" id="dtp_BookFitTime" name="dateBookFitTime" value="" /><br/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">订单状态</label>
                    <div class="col-sm-3">
                        <select class="form-control" id="OrderStatus" name="selOrderStatus">
                            @foreach($orderStatus->data as $item)
                                <option {{$item->CodeCD === $orderStatus->default?"selected":""}} value={{$item->CodeCD}}>{{$item->CodeDesc}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="" class="col-sm-3 control-label">完成时间</label>
                    <div class="col-sm-3">
                        <div class="input-group date dtpicker col-md-12" data-date="{{\Carbon\carbon::now()}}" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_FinishTime">
                            <input id="FinishTime" class="form-control" size="16" type="text" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                        <input type="hidden" id="dtp_FinishTime" name="dateFinishTime" value="" /><br/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">备注</label>
                    <div class="col-sm-9">
                        <textarea type="Remark" rows="3" class="form-control" id="txtRemark" name="txtRemark"></textarea>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right">
                <button type="button" class="btn btn-default" onclick="location.href='/Order/List'">返回</button>
                <button type="submit" class="btn btn-primary btn-save">保存</button>
            </div>
        </div>
    </div>

    
    <!--Modal-->
    <div id="myModal">
        <div class="modal modal-info fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Info Modal</h4>
                    </div>
                    <div class="modal-body">
                        <p>One fine body…</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
</div>
<!-- /.box -->

@stop

@section("footer")
    <script src="{{asset("/plugin/datetimepicker/js/bootstrap-datetimepicker.js")}}"></script>
    <script src="{{asset("/plugin/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js")}}"></script>
    <script src="{{asset("/js/jquery.form.js")}}"></script>
    <script type="text/javascript">
    // 省-市-区 下拉框联动
    var html = '';
    $(document).ready(function(){
        // 改变省，市改变
        $('#province').change(function () {
            $.ajax({
                type: 'POST',
                url: '/Order/GetAddress',
                data: {'AddressCD': $(this).val(), 'level': 2, '_token': '{{ csrf_token() }}'},
                success: function (json) {
                    html = '';
                    $.each(json.data, function(i, n){
                        html += "<option "+(n.AddressCD == json.default?"selected":"")+" value='"+n.AddressCD+"'>"+n.AddressName+"</option>";
                    });
                    $('#city').html(html);
                    $('#district').html('').val('');
                }
            });
        });
        // 改变市，区改变
        $('#city').change(function () {
            $.post(
                '/Order/GetAddress',
                {'AddressCD': $(this).val(), 'level': 3, '_token': '{{ csrf_token() }}'},
                function (json) {
                    html = '';
                    $.each(json.data, function(i, n){
                        html += "<option "+(n.AddressCD == json.default?"selected":"")+" value='"+n.AddressCD+"'>"+n.AddressName+"</option>";
                    });
                    $('#district').html(html);
                });
        });
    });

    // 提交编辑保存
    $('.btn-save').click(function() {
        // bind 'myForm' and provide a simple callback function
        $('#myForm').ajaxSubmit({
            url: '/Order/Add',
            type: 'POST',
            success: function(data){
                $('#myModal').modal('show');
                if(data=='0')
                    window.location.href="/Order/List";
            }
        });
    });

    // 日期控件初始化
    $('.dtpicker').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    </script>
@stop