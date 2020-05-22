
@extends('layouts.site')

@section('content')

<div class="login-content">
  
 @if(env('DEMO_MODE')) 
  <ul class="login-user-details list-unstyled">
  <li class="title">Login As</li>
  <li onclick="setCredentials('owner')" class=""><a class="positive" href="javascript:void(0);">Owner</a></li>
  <li onclick="setCredentials('admin')" class=""><a class="positive" href="javascript:void(0);">Admin</a></li>
  <li onclick="setCredentials('student')" class=""><a class="positive" href="javascript:void(0);">Student</a></li>
  <li onclick="setCredentials('parent')" class=""><a class="positive" href="javascript:void(0);">Parent</a></li>
  <li><a class="positive" href="http://phpstack-127383-482309.cloudwaysapps.com/Documentation/" target="_blank">Documentation</a></li>
</ul>
@endif

    <div class="logo text-center"><img src="{{IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')}}" alt="" height="59" width="211" ></div>

      @include('layouts.site-navigation')

    {!! Form::open(array('url' => URL_USERS_LOGIN, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"loginForm")) !!}



    @include('errors.errors')



      <div class="input-group">

        <span class="input-group-addon" id="basic-addon1"><i class="icon icon-user"></i></span>



          {{ Form::text('email', $value = null , $attributes = array('class'=>'form-control',

      'ng-model'=>'email',

      'required'=> 'true',
      'id'=> 'email',


      'placeholder' => getPhrase('username').'/'.getPhrase('email'),

      'ng-class'=>'{"has-error": loginForm.email.$touched && loginForm.email.$invalid}',

    )) }}

  <div class="validation-error" ng-messages="loginForm.email.$error" >

    {!! getValidationMessage()!!}

    {!! getValidationMessage('email')!!}

  </div>



      </div>



      <div class="input-group">

        <span class="input-group-addon" id="basic-addon1"><i class="icon icon-lock"></i></span>

          {{ Form::password('password', $attributes = array('class'=>'form-control instruction-call',

      'placeholder' => getPhrase("password"),

      'ng-model'=>'registration.password',

      'required'=> 'true',
      'id'=> 'password',

      'ng-class'=>'{"has-error": loginForm.password.$touched && loginForm.password.$invalid}',

      'ng-minlength' => 5

    )) }}

  <div class="validation-error" ng-messages="loginForm.password.$error" >

    {!! getValidationMessage()!!}

    {!! getValidationMessage('password')!!}

  </div>



      </div>


              @if($rechaptcha_status == 'yes')

        <div class="input-group">



              <div class="col-md-12 form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">


                            <div class="col-md-6 pull-center">
                                {!! app('captcha')->display() !!}

                            </div>
                        </div>


                    </div>

                @endif


      <div class="text-center buttons">

       <!--  <button type="submit" class="btn button btn-success btn-lg" ng-disabled='!loginForm.$valid'>{{getPhrase('login')}}</button> -->
        <button type="submit" class="btn button btn-success btn-lg" >{{getPhrase('login')}}</button>

        <div class="social-logins">
          @if(getSetting('facebook_login', 'module'))
            <a href="{{URL_FACEBOOK_LOGIN}}" class="btn btn-lg btn-facebook btn-full"><i class="fa fa-facebook"></i> {{getPhrase('login_with_facebook')}}</a>
          @endif

          @if(getSetting('twitter_login', 'module'))
            <a href="{{URL_TWITTER_LOGIN}}" class="btn btn-lg btn-google-plus btn-full"><i class="fa fa-twitter"></i>  {{getPhrase('twitter')}}</a>
          @endif

          @if(getSetting('facebook_login', 'module')||getSetting('twitter_login', 'module'))
          <div class="alert alert-info margintop30">
            <strong>{{getPhrase('note')}}: </strong>
            {{getPhrase('social_logins_are_only_for_student_accounts')}}
          </div>
          @endif
        </div>

      </div>

    {!! Form::close() !!}



    <div class="footer">

      <a href="javascript:void(0);" class="pull-left" data-toggle="modal" data-target="#myModal" ><i class="icon icon-question"></i> {{getPhrase('forgot_password')}}</a>



      <a href="{{URL_USERS_REGISTER}}" class="pull-right"><i class="icon icon-add-user"></i> {{ getPhrase('register') }}</a>

    </div>

  </div>



  <!-- Modal -->

<div id="myModal" class="modal fade" role="dialog">

  <div class="modal-dialog">

  {!! Form::open(array('url' => URL_USERS_FORGOT_PASSWORD, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"passwordForm")) !!}

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">{{getPhrase('forgot_password')}}</h4>

      </div>

      <div class="modal-body">

        <div class="input-group">

        <span class="input-group-addon" id="basic-addon1"><i class="icon icon-email-resend"></i></span>



          {{ Form::email('email', $value = null , $attributes = array('class'=>'form-control',

      'ng-model'=>'email',

      'required'=> 'true',

      'placeholder' => getPhrase('email'),

      'ng-class'=>'{"has-error": passwordForm.email.$touched && passwordForm.email.$invalid}',

    )) }}

  <div class="validation-error" ng-messages="passwordForm.email.$error" >

    {!! getValidationMessage()!!}

    {!! getValidationMessage('email')!!}

  </div>



      </div>

      </div>

      <div class="modal-footer">

      <div class="pull-right">

        <button type="button" class="btn btn-default" data-dismiss="modal">{{getPhrase('close')}}</button>

        <button type="submit" class="btn btn-primary" ng-disabled='!passwordForm.$valid'>{{getPhrase('submit')}}</button>

        </div>

      </div>

    </div>

  {!! Form::close() !!}

  </div>

</div>

@stop



@section('footer_scripts')

  @include('common.validations')

  <script>
function setCredentials(userType) {
  username = 'student@student.com';
  password = 'password';
  if(userType=='owner') {
    username = 'owner@owner.com';
    password = 'password';
  }
  else if(userType=='admin') {
    username = 'admin@admin.com';
    password = 'password';
  }
  else if(userType=='parent') {
    username = 'parent@parent.com';
    password = 'password';
  }
  $('#email').val(username);
  $('#password').val(password);
  $('#submit_button').prop("disabled", false);
}
</script>

          {{-- <script src="{{JS}}recaptcha.js"></script> --}}
                  <script src='https://www.google.com/recaptcha/api.js'></script>



@stop