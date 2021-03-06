@extends('layout.main')

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
                    <label for="" class="control-label">{{ $order->Customer->UserName or "" }}</label>
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
                    <label for="" class="control-label">{{ $order->Tel or "" }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">下单人地址</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">{{ $order->AddressCD }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">总金额</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">{{ $order->SumPrice }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">提交时间</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">
                        {{ $order->CommitTime or "" }}

                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">预约时间</label>
                <div class="col-sm-9">{{ $order->BookFitTime or "" }}
                    <label for="" class="control-label">{{ $order["BookFitTime"] }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">订单状态</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">{{ $order->OrderStatus }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">完成时间</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">{{ $order->FinishTime }}</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">备注</label>
                <div class="col-sm-9">
                    <label for="" class="control-label">{{ $order["Remark"] }}</label>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-default pull-right" onclick="location.href='/Order/List'">返回</button>
        </div>
    </div>
</div>
<!-- /.box -->
@stop