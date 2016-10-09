@extends('layout.main')

@section("header")
    <link rel="stylesheet" href="{{asset("/plugin/datetimepicker/css/bootstrap-datetimepicker.min.css")}}">
    {{--<link rel="stylesheet" href="{{asset("/plugin/daterangepicker/daterangepicker.css")}}">--}}
@stop

@section('content')
<!-- SELECT2 EXAMPLE -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">
            {{ $order->OrderNum }}
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
                <label for="" class="col-sm-2 control-label">下单人</label>
                <div class="col-sm-9">
                    <input type="Name" class="form-control" id="txtName" value="{{ $order->Customer->User->Nickname or "" }}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">订单产品</label>
                <div class="col-sm-9">
                    @if (count($order->OrderProduct) > 0)
                    <div class="box">
                        <div class="box-body no-padding">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>产品类别</th>
                                    <th>产品名称</th>
                                    <th>单价</th>
                                    <th>数量</th>
                                </tr>
                                @foreach ($order->OrderProduct as $item)
                                <tr>
                                    <td>{{ $loop->index }}</td>
                                    <td>{{ $item->Product->Category->CategoryName }}</td>
                                    <td>{{ $item->Product->ProductName }}</td>
                                    <td>{{ $item->Product->Price }}</td>
                                    <td>{{ $item->Quantity }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">下单人电话</label>
                <div class="col-sm-9">
                    <input type="Tel" class="form-control" id="txtTel" value="{{ ($order->Customer->User->Tel or $order->Customer->User->Tel2) or "" }}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">下单人地址</label>
                <div class="col-sm-9">
                    <input type="Address" class="form-control" id="txtAddress" value="{{ $order->AddressCD }}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">总金额</label>
                <div class="col-sm-9">
                    <input type="SumPrice" class="form-control" id="txtSumPrice" value="{{ $order->SumPrice }}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">提交时间</label>
                <div class="col-sm-9">
                    <input type="Name" class="form-control" id="txtName" value="">
                    <label for="" class="control-label">
                        {{ $order->CommitTime or "" }}
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">预约时间</label>
                <div class="col-sm-9">
                    <input type="Name" class="form-control" id="txtName" value="">
                    <label for="" class="control-label">{{ $order["BookFitTime"] }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">订单状态</label>
                <div class="col-sm-9">
                    <input type="Name" class="form-control" id="txtName" value="">
                    <label for="" class="control-label">{{ $order->OrderStatus }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">完成时间</label>
                <div class="col-sm-9">
                    <input type="Name" class="form-control" id="txtName" value="">
                    <label for="" class="control-label">{{ $order->FinishTime }}</label>
                    <div class="input-group date form_datetime col-md-5" data-date="1979-09-16T05:25:07Z" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_input1">
                        <input class="form-control" size="16" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                    <input type="hidden" id="dtp_input1" value="" /><br/>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">备注</label>
                <div class="col-sm-9">
                    <textarea type="Remark" rows="3" class="form-control" id="txtRemark" value="{{ $order["Remark"] }}"></textarea>
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

@section("footer")
    <script src="{{asset("/plugin/datetimepicker/js/bootstrap-datetimepicker.js")}}"></script>
    <script src="{{asset("/plugin/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js")}}"></script>
    <script type="text/javascript">
    $('.form_datetime').datetimepicker({
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