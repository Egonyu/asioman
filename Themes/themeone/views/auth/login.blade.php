@extends('layouts.sitelayout')

@section('content')

<style type="text/css">
  /*Demo Credentials */

.login-content {
    position: relative;
}
.login-user-details {
    display: none;
}
@media(min-width:768px) {
    .login-user-details {

        background-color: #d9edf7;
        padding: 15px 15px;
        display: block;
    }
    .login-user-details li {
        text-align: center;
        font-size: 18px;
    }
    .login-user-details li.title {
        color: #44a1ef;
        margin-bottom: 10px;
        font-weight: bold;
    }
    .login-user-details li + li {
        margin-top: 5px;
    }
    .login-user-details li a {
        padding: 5px 10px;
        display: block;
        text-decoration: none;
        border-radius: 3px;
        cursor: pointer;
    }
    .login-user-details li a.positive {
        border: 1px solid #44a1ef;
        background: #44a1ef;
        color: #fff;
    }
    .login-user-details li a:hover {
        color: #44a1ef;
        background: #FFF;
        border-color: #44a1ef;
    }
}
@media(min-width:1367px) {
    .login-user-details {
        top: 280px;
    }
</style>


       <!-- Login Section -->
       <div  style="background-image: url({{IMAGES}}login-bg.png);background-repeat: no-repeat;background-color: #f8fafb">
    <div class="container">
        <div class="row cs-row" style="margin-top: 180px">


            <div class="col-md-12">



                <div class="cs-box-resize  login-box row" style="max-width: 700px; padding:30px; ">

                  <?php
                    $env_demo = env('DEMO_MODE');
                  ?>

                  @if($env_demo == FALSE)
                    <div class="col-sm-6" style="margin-left:150px;">
                      @else
                    <div class="col-sm-6">
                  @endif



                 <h4 class="text-center login-head">{{getPhrase('login')}}</h4>

                    <!-- Form Login/Register -->
                      {!! Form::open(array('url' => URL_USERS_LOGIN, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"loginForm")) !!}

                        @include('errors.errors')

                        <div class="form-group">

                          <label for="email">{{getPhrase('email_address')}}:</label>

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

                        <div class="form-group">
                            <label for="pwd">Password:</label>

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


                         <div class="form-group">

                             @if($rechaptcha_status == 'yes')




                  <div class="  form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">



                                    {!! app('captcha')->display() !!}



                               </div>


                             @endif


                        </div>

                        <button type="submit" class="btn button btn-primary btn-lg" style="margin-left: 85px;">{{getPhrase('login')}}</button>

                    </form>

                    <br>
                    <p class=" text-center">Or Login with</p>

                     <div class="row text-center">
                      <div class="col-md-6" >
                    @if(getSetting('facebook_login', 'module'))
                      <a href="{{URL_FACEBOOK_LOGIN}}" class="btn btn-info btn-sm"><i class="fa fa-facebook"></i> {{getPhrase('facebook')}}</a>
                    @endif
                    </div>
                     <div class="col-md-6" >
                    @if(getSetting('twitter_login', 'module'))
                      <a href="{{URL_TWITTER_LOGIN}}" class="btn btn-success btn-sm"><i class="fa fa-twitter"></i>  {{getPhrase('twitter')}}</a>
                    @endif
                  </div>

                    <div class="col-md-12">
                    @if(getSetting('facebook_login', 'module')||getSetting('twitter_login', 'module'))
                    <br>
                    <div class="alert alert-info margintop30">
                      <strong>{{getPhrase('note')}}: </strong>
                      {{getPhrase('social_logins_are_only_for_student_accounts')}}
                    </div>
                    @endif

                    </div>
        </div>
        <br>
          <ul class="login-links mt-2">
                     <li><a href="{{URL_USERS_REGISTER}}">{{getPhrase('register')}}</a></li>
                     <li> <a href="javascript:void(0);" class="pull-left" data-toggle="modal" data-target="#myModal" ><i class="icon icon-question"></i> {{getPhrase('forgot_password')}}</a></li>
                  </ul>

                    <!-- Form Login/Register -->
               </div>

  <div class="col-sm-1" >
  </div>

 @if(env('DEMO_MODE'))
   <div class="col-sm-5" >

  <ul class="login-user-details list-unstyled">
  <li class="title">Login As</li>
  <li onclick="setCredentials('owner')" class=""><a class="positive" href="javascript:void(0);">Owner</a></li>
  <li onclick="setCredentials('admin')" class=""><a class="positive" href="javascript:void(0);">Admin</a></li>
  <li onclick="setCredentials('student')" class=""><a class="positive" href="javascript:void(0);">Student</a></li>
  <li onclick="setCredentials('parent')" class=""><a class="positive" href="javascript:void(0);">Parent</a></li>
  <li><a class="positive" href="http://phpstack-127011-871785.cloudwaysapps.com/Documentation/" target="_blank">Documentation</a></li>


</ul>

  </div>
@endif



            </div>
        </div>
    </div>
    <!-- Login Section -->


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

        <div class="form-group">
          <label>Email Address</label>





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

    <script src='https://www.google.com/recaptcha/api.js'></script>


@stop