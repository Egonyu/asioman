<?php $__env->startSection('content'); ?>

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
       <div  style="background-image: url(<?php echo e(IMAGES); ?>login-bg.png);background-repeat: no-repeat;background-color: #f8fafb">
    <div class="container">
        <div class="row cs-row" style="margin-top: 180px">


            <div class="col-md-12">



                <div class="cs-box-resize  login-box row" style="max-width: 700px; padding:30px; ">

                  <?php
                    $env_demo = env('DEMO_MODE');
                  ?>

                  <?php if($env_demo == FALSE): ?>
                    <div class="col-sm-6" style="margin-left:150px;">
                      <?php else: ?>
                    <div class="col-sm-6">
                  <?php endif; ?>



                 <h4 class="text-center login-head"><?php echo e(getPhrase('login')); ?></h4>

                    <!-- Form Login/Register -->
                      <?php echo Form::open(array('url' => URL_USERS_LOGIN, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"loginForm")); ?>


                        <?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <div class="form-group">

                          <label for="email"><?php echo e(getPhrase('email_address')); ?>:</label>

                            <?php echo e(Form::text('email', $value = null , $attributes = array('class'=>'form-control',

                        'ng-model'=>'email',

                        'required'=> 'true',

                        'id'=> 'email',

                        'placeholder' => getPhrase('username').'/'.getPhrase('email'),

                        'ng-class'=>'{"has-error": loginForm.email.$touched && loginForm.email.$invalid}',

                       ))); ?>


                        <div class="validation-error" ng-messages="loginForm.email.$error" >

                          <?php echo getValidationMessage(); ?>


                          <?php echo getValidationMessage('email'); ?>


                        </div>

                        </div>

                        <div class="form-group">
                            <label for="pwd">Password:</label>

                           <?php echo e(Form::password('password', $attributes = array('class'=>'form-control instruction-call',

                        'placeholder' => getPhrase("password"),

                        'ng-model'=>'registration.password',

                        'required'=> 'true',
                        'id'=> 'password',

                        'ng-class'=>'{"has-error": loginForm.password.$touched && loginForm.password.$invalid}',

                        'ng-minlength' => 5

                          ))); ?>


                        <div class="validation-error" ng-messages="loginForm.password.$error" >

                          <?php echo getValidationMessage(); ?>


                          <?php echo getValidationMessage('password'); ?>


                        </div>

                        </div>


                         <div class="form-group">

                             <?php if($rechaptcha_status == 'yes'): ?>




                  <div class="  form-group<?php echo e($errors->has('g-recaptcha-response') ? ' has-error' : ''); ?>">



                                    <?php echo app('captcha')->display(); ?>




                               </div>


                             <?php endif; ?>


                        </div>

                        <button type="submit" class="btn button btn-primary btn-lg" style="margin-left: 85px;"><?php echo e(getPhrase('login')); ?></button>

                    </form>

                    <br>
                    <p class=" text-center">Or Login with</p>

                     <div class="row text-center">
                      <div class="col-md-6" >
                    <?php if(getSetting('facebook_login', 'module')): ?>
                      <a href="<?php echo e(URL_FACEBOOK_LOGIN); ?>" class="btn btn-info btn-sm"><i class="fa fa-facebook"></i> <?php echo e(getPhrase('facebook')); ?></a>
                    <?php endif; ?>
                    </div>
                     <div class="col-md-6" >
                    <?php if(getSetting('twitter_login', 'module')): ?>
                      <a href="<?php echo e(URL_TWITTER_LOGIN); ?>" class="btn btn-success btn-sm"><i class="fa fa-twitter"></i>  <?php echo e(getPhrase('twitter')); ?></a>
                    <?php endif; ?>
                  </div>

                    <div class="col-md-12">
                    <?php if(getSetting('facebook_login', 'module')||getSetting('twitter_login', 'module')): ?>
                    <br>
                    <div class="alert alert-info margintop30">
                      <strong><?php echo e(getPhrase('note')); ?>: </strong>
                      <?php echo e(getPhrase('social_logins_are_only_for_student_accounts')); ?>

                    </div>
                    <?php endif; ?>

                    </div>
        </div>
        <br>
          <ul class="login-links mt-2">
                     <li><a href="<?php echo e(URL_USERS_REGISTER); ?>"><?php echo e(getPhrase('register')); ?></a></li>
                     <li> <a href="javascript:void(0);" class="pull-left" data-toggle="modal" data-target="#myModal" ><i class="icon icon-question"></i> <?php echo e(getPhrase('forgot_password')); ?></a></li>
                  </ul>

                    <!-- Form Login/Register -->
               </div>

  <div class="col-sm-1" >
  </div>

 <?php if(env('DEMO_MODE')): ?>
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
<?php endif; ?>



            </div>
        </div>
    </div>
    <!-- Login Section -->


  <!-- Modal -->

<div id="myModal" class="modal fade" role="dialog">

  <div class="modal-dialog">

  <?php echo Form::open(array('url' => URL_USERS_FORGOT_PASSWORD, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"passwordForm")); ?>


    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title"><?php echo e(getPhrase('forgot_password')); ?></h4>

      </div>

      <div class="modal-body">

        <div class="form-group">
          <label>Email Address</label>





          <?php echo e(Form::email('email', $value = null , $attributes = array('class'=>'form-control',

      'ng-model'=>'email',

      'required'=> 'true',

      'placeholder' => getPhrase('email'),

      'ng-class'=>'{"has-error": passwordForm.email.$touched && passwordForm.email.$invalid}',

    ))); ?>


  <div class="validation-error" ng-messages="passwordForm.email.$error" >

    <?php echo getValidationMessage(); ?>


    <?php echo getValidationMessage('email'); ?>


  </div>



      </div>

      </div>

      <div class="modal-footer">

      <div class="pull-right">

        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(getPhrase('close')); ?></button>

        <button type="submit" class="btn btn-primary" ng-disabled='!passwordForm.$valid'><?php echo e(getPhrase('submit')); ?></button>

        </div>

      </div>

    </div>

  <?php echo Form::close(); ?>


  </div>

</div>
</div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('footer_scripts'); ?>

  <?php echo $__env->make('common.validations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.sitelayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>