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

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} has-feedback">
                            <div class="col-md-8 col-md-offset-2">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" style="border-radius: 0;" autofocus placeholder="Username">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
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
<div id="footer" class="container">
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="navbar-inner navbar-content-center">
            <p class="text-muted credit" style="padding: 10px;text-align: center;">
                <a href="http://www.miitbeian.gov.cn/">京ICP备16068411号</a>
            </p>
        </div>
    </nav>
</div>

@endsection
