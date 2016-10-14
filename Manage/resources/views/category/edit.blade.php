@extends('layout.main')

@section("header")
    <link rel="stylesheet" href="{{asset("/plugin/datetimepicker/css/bootstrap-datetimepicker.min.css")}}">
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
                <label for="" class="col-sm-2 control-label">联系电话</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="txtTel" value="{{ ($order->Customer->User->Tel or $order->Customer->User->Tel2) or "" }}">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">安装地址</label>
                <div class="col-sm-9">
                    <select class="form-control" id="province">
                    </select>

                    <select class="form-control" id="city">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                    </select>

                    <select class="form-control" id="district">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                    </select>

                    <input type="text" class="form-control" id="txtAddress" value="{{ $order->AddressDif }}">
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
                    <div class="input-group date dtpicker col-md-5" data-date="1979-09-16T05:25:07Z" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_CommitTime">
                        <input id="CommitTime" class="form-control" size="16" type="text" value="{{ $order->CommitTime }}" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                    <input type="hidden" id="dtp_CommitTime" value="" /><br/>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">预约时间</label>
                <div class="col-sm-9">
                    <div class="input-group date dtpicker col-md-5" data-date="1979-09-16T05:25:07Z" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_BookFitTime">
                        <input id="BookFitTime" class="form-control" size="16" type="text" value="{{ $order->BookFitTime }}" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                    <input type="hidden" id="dtp_BookFitTime" value="" /><br/>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">订单状态</label>
                <div class="col-sm-9">
                    <select class="form-control" id="OrderStatus">{{0==="ac"}}
                        @foreach($orderStatus->get('data') as $status)
                            <option {{$status->CodeKey === $orderStatus->get('default')?"selected":""}} value="{{$status->CodeKey}}">{{$status->CodeDesc}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">完成时间</label>
                <div class="col-sm-9">
                    <div class="input-group date dtpicker col-md-5" data-date="1979-09-16T05:25:07Z" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_FinishTime">
                        <input id="FinishTime" class="form-control" size="16" type="text" value="{{ $order->FinishTime }}" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                    <input type="hidden" id="dtp_FinishTime" value="" /><br/>
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
    $()
    </script>
@stop