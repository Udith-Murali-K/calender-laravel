<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{config('settings.project-name')}}| Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    {!! HTML::style('node_modules/bootstrap/dist/css/bootstrap.min.css') !!}
    {!! HTML::style('node_modules/font-awesome/css/font-awesome.min.css') !!}
    {!! HTML::style('css/AdminLTE.min.css') !!}
    {!! HTML::style('plugins/iCheck/square/blue.css') !!}
</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="">{{config('settings.project-name')}}</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <p class="login-box-msg">Sign in to start your session</p>
        {!!Form::open(array('url' => '/login'))!!}
        <div class="form-group has-feedback">
            {!!Form::email('email',  old('email'), array('class'=>'form-control','placeholder'=>'Email'))!!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            {!!Form::password('password', array('class'=>'form-control','placeholder' => 'Password'))!!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>
            </div>
            <div class="col-xs-4">
                {!!Form::submit('Sign In', array('class' => 'btn btn-primary btn-block btn-flat'))!!}
            </div>
        </div>
        {!!Form::close()!!}
        {{-- {!!HTML::link('/password/email','I forgot my password', null,null);!!} --}}
    </div>
</div>
{!! HTML::script('node_modules/jquery/dist/jquery.min.js') !!}
{!! HTML::script('node_modules/bootstrap/dist/js/bootstrap.min.js') !!}
{!! HTML::script('plugins/iCheck/icheck.min.js') !!}
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>