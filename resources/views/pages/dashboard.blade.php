@extends('layout.master')
@section('after-styles-end')
  {!! HTML::style('node_modules/morris-js-module/morris.css')!!}
  {!! HTML::style('plugins/jvectormap/jquery-jvectormap-1.2.2.css') !!}
@section ('title', config('settings.project-name').' | Dashboard')
@endsection

@section('content')
        <!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>your content</h3>
          <p>Participants Registered</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>your content</h3>
          <p>Sponosrs/Partners Registered</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>your content</h3>
          <p> Enquiry submitted</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
  </div><!-- /.row -->
  <!-- Main row -->
</section><!-- /.content -->
@endsection

@section('after-scripts-end')
  {{--  {!! HTML::script('http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js'); !!}
  {!! HTML::script('node_modules/morris-js-module/morris.js')!!}
  {!! HTML::script('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); !!}
  {!! HTML::script('plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); !!}  --}}
@endsection
