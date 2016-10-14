@extends('layout.auth')

@section('content')
<div class="container">
    <div class="login-logo"><i class="fa fa-angellist fa-3x"></i></div>
    <!-- /.login-logo -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">登陆</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('loginid') ? ' has-error' : '' }} has-feedback">
                            <div class="col-md-8 col-md-offset-2">
                                <input id="loginid" type="text" class="form-control" name="loginid" value="{{ old('loginid') }}" style="border-radius: 0;" autofocus placeholder="Username">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('loginid'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('loginid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                            <div class="col-md-8 col-md-offset-2">
                                <input id="password" type="password" class="form-control" name="password" style="border-radius: 0;" placeholder="Password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5 col-md-offset-2">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name="remember"> 记住我
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">
                                    登陆
                                </button>

                                {{--<a class="btn btn-link" href="{{ url('/password/reset') }}">--}}
                                    {{--忘记密码?--}}
                                {{--</a>--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection