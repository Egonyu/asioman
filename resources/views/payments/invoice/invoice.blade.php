@extends($layout)

@section('content')

<?php $settings = getSettings('subscription'); ?>
<div id="page-wrapper">
      <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>

              <li class="active"> {{ $title }} </li>
            </ol>
          </div>
        </div>

        <!-- /.row -->
      <div class="panel panel-custom">
          <div class="panel-heading">
            <h1>{{$title}}</h1>
          </div>
          <div class="panel-body packages">
            <div class="row">
              @include('payments.invoice.invoice-content', compact('invoice'))
            </div>
        </div>
      </div>
</div>
    <!-- /#page-wrapper -->
@stop