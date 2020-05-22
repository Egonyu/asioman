@extends($layout)

@section('content')

<div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
               <div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
							<li> <a href="{{URL_STUDENT_LMS_SERIES}}">{{getPhrase('learning_management_series')}} </a> </li>
							<li class="active"> {{ $title }} </li>
						</ol>
					</div>
				</div>

                @include('errors.errors')

                <?php
                $validity_type = validityType();
                $item_type = 'lms';
                if ( $validity_type != 'individual' ) {
                    $item_type = 'subscribe';
                }
                ?>
                <div class="panel panel-custom">

                    <div class="panel-body">

                        @if(!$content_record)

                        <div class="row">
                        <?php
                             $image = IMAGE_PATH_UPLOAD_LMS_DEFAULT;
                             if($item->image)
                             $image = IMAGE_PATH_UPLOAD_LMS_SERIES.$item->image;
                         ?>

                            <div class="col-md-3"> <img src="{{$image}}" class="img-responsive center-block" alt=""> </div>
                            <div class="col-md-8 col-md-offset-1">
                                <div class="series-details">
                                    <h2>{{$item->title}} </h2>

                                    	{!! $item->description!!}
                                    @if($item->is_paid && !isItemPurchased($item->id, $item_type))
                                    <div class="buttons text-left">
                                        @if( 'individual' === $validity_type)
                                        <a href="{{URL_PAYMENTS_CHECKOUT.'lms/'.$item->slug}}" class="btn btn-dark text-uppercase">{{ getPhrase('buy_now')}}</a>
                                        @else
                                        <a href="javascript:void(0);" class="btn btn-dark text-uppercase" onclick="viewPackages()">{{ getPhrase('subscribe_now')}}</a>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @elseif($content_record->content_type == 'video' || $content_record->content_type == 'iframe' || $content_record->content_type == 'video_url')

                            @include('student.lms.series-video-player', array('series'=>$item, 'content' => $content_record))

                        @elseif($content_record->content_type == 'audio' || $content_record->content_type == 'audio_url')

                            @include('student.lms.series-audio-player', array('series'=>$item, 'content' => $content_record))
                        @endif
                        <hr>

                       @include('student.lms.series-items', array('series'=>$item, 'content'=>$content_record))

                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

		<!-- /#page-wrapper -->

        @if( $validity_type != 'individual' )
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
        {!! Form::open(['method' => 'POST', 'route' => ['payments.select_custom'],'name'=>'formQuiz']) !!}
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{getPhrase('packages')}} @if( 'subscriptioncustom' === $validity_type ){{getCurrencyCode()}}<span id="total_amount">0</span>@endif</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                   @if( 'subscriptioncustom' === $validity_type )
                    <?php
                    $validity_types_query = \App\Package::where('status', 1)->where('type', 'main')->groupBy('validity_type')->orderBy('validity_type')->get();
                    $validity_types = ['' => getPhrase('please_select')];
                    if ( $validity_types_query->count() > 0 ) {
                        foreach ($validity_types_query as $row) {
                            $validity_types[ $row->validity_type . '_' . $row->amount ] = $row->validity_type . ' ('.getCurrencyCode() . ' ' . $row->amount.')';
                        }
                    ?>
                    <fieldset class="form-group col-md-4">
                        {{ Form::label('validity', getphrase('validity')) }}
                        <span class="text-red">*</span>
                        {{ Form::number('validity', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('validity'),
                            'ng-model'=>'validity',
                            'id' => 'validity',
                            'min'=>1,
                            'required'=> 'true',
                            'ng-class'=>'{"has-error": formQuiz.validity.$touched && formQuiz.validity.$invalid}',
                            'onchange' => 'calculate()'
                        )) }}
                        <div class="validation-error" ng-messages="formQuiz.validity.$error" >
                            {!! getValidationMessage()!!}
                            {!! getValidationMessage('number')!!}
                        </div>
                    </fieldset>

                    <fieldset class="form-group col-md-4">
                        {{ Form::label('validity_type', getphrase('validity_type')) }}
                        <span class="text-red">*</span>
                        {{Form::select('validity_type', $validity_types, null, ['class'=>'form-control', 'id' => 'validity_type', 'onchange' => 'calculate()'])}}
                    </fieldset>

                    <fieldset class="form-group col-md-4">
                        <label for="validity_type">&nbsp;</label>
                        <button class="form-control-new btn btn-lg btn-success button"
                        ng-disabled='!formQuiz.$valid'>{{ getPhrase('subscribe_now') }}</button>
                    </fieldset>
                <?php } else {
                    echo getPhrase('no_packages_found');
                    }?>
                   @else
                       <?php
                       $packages = \App\Package::where('status', 1)->where('type', 'main')->get();
                       ?>
                       @forelse( $packages as $package)
                           <div class="col-md-4">
                                <h4>{{$package->name}}</h4>

                                <div>
                                    <b>{{getCurrencyCode() . ' ' . $package->amount}} {{$package->duration}} {{$package->duration_type}}</b>
                                </div>

                                <hr />
                                <p>{!!$package->description!!}</p>

                                <div class="modal-footer">
                                <a class="btn btn-lg btn-success button" href="{{URL_PAYMENTS_CHECKOUT.'subscribe/'.$package->slug}}" onclick="return confirm('Are you sure?')">{{ getPhrase('subscribe') }}&nbsp;{{getCurrencyCode() . ' ' . $package->amount}}</a>
                                </div>
                           </div>
                       @empty
                        {{getPhrase('no_packages')}}
                       @endforelse
                   @endif
                </div>
              </div>
            </div>
        {!! Form::close() !!}
          </div>
        </div>
        @endif

@stop
@section('footer_scripts')

@if($content_record)
    @if($content_record->content_type == 'video' || $content_record->content_type == 'video_url')
        @include('common.video-scripts')
    @endif

@endif
@include('common.custom-message-alert')

<script type="text/javascript">
function calculate() {
    var total_amount = 0;
    var validity = $('#validity').val();
    var amount = $('#validity_type').val().split('_')[1];
    total_amount = validity * amount;
    $('#total_amount').html(total_amount);
}

function viewPackages()
{
    $('#myModal').modal('show');
}
</script>
@stop