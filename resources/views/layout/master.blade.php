<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title',config('settings.project-name'))</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    {!! HTML::style('node_modules/bootstrap/dist/css/bootstrap.min.css') !!}
    {!! HTML::style('node_modules/font-awesome/css/font-awesome.min.css') !!}
    {!! HTML::style('node_modules/ionicons/dist/css/ionicons.min.css') !!}
    {!! HTML::style('css/skins/_all-skins.min.css') !!}
    {!! HTML::style('css/AdminLTE.min.css') !!}
{{--    {!! HTML::style('node_modules/datatables/media/css/jquery.dataTables.min.css')!!}--}}
    {!! ! HTML::style('//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css') !!}
    {!! HTML::style('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')!!}
    @yield('after-styles-end')
</head>
<body class="skin-blue sidebar-mini" data-base-url=''>
<div class="wrapper">
    @include('layout.header')
    @include('layout.menu')
    <div class="content-wrapper">
        {{----------FLASH MESSAGE-----------}}
          <div id="flash-message-container" class="flat">
            <div class="row">
                <div class="col-sm-12">
                    @include('vendor.flash.message')
                </div>
            </div>
        </div>
        {{-------FLASH MESSAGE ENDS---------}}
        @yield('content')
    </div>
    @include('layout.footer')
</div>
{!! HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js') !!}
{!! HTML::script('plugins/jQueryUI/jQuery-ui.js') !!}
{!! HTML::script('node_modules/bootstrap/dist/js/bootstrap.min.js') !!}
<script>
//  $.widget.bridge('uibutton', $.ui.button);
</script>
{{--{!! HTML::script('node_modules/datatables/media/js/jquery.dataTables.min.js') !!}--}}
{!! HTML::script('//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js') !!}
{{--<!-- {!! HTML::script('back-end/admin/plugins/datatables/dataTables.bootstrap.min.js') !!} -->--}}
{!! HTML::script('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')!!}
{!! HTML::script('js/adminlte.min.js') !!}
@stack('footer.script')
@yield('after-scripts-end')
</body>
</html>
