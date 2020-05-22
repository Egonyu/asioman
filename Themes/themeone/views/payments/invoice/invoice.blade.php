@extends($layout)

@section('content')

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
              <!-- <a class="btn btn-large btn-primary buttons-print ml-sm" href="{{route('payments.view_invoice_pdf', ['invoice_id' => $invoice->id] )}}">{{getPhrase('PDF')}}</a>
              &nbsp;|&nbsp; -->
              <a class="btn btn-large btn-primary buttons-print ml-sm" href="{{route('payments.send_invoice', ['invoice_id' => $invoice->id] )}}">{{getPhrase('send_invoice')}}</a>
            </div>
            <div class="row">
              @include('payments.invoice.invoice-content', compact('invoice'))
            </div>
        </div>
      </div>
</div>
    <!-- /#page-wrapper -->
@stop