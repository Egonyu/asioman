<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf_token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" href="<?php echo e(IMAGE_PATH_SETTINGS.getSetting('site_favicon', 'site_settings')); ?>" type="image/x-icon" />
    <title>
    <?php echo $__env->yieldContent('title'); ?> <?php echo e(isset($title) ? $title : getSetting('site_title','site_settings')); ?>

    </title>


    <?php echo $__env->yieldContent('header_scripts'); ?>


     <link href="<?php echo e(themes('site/css/main.css')); ?>" rel="stylesheet">
     <link href="<?php echo e(themes('css/notify.css')); ?>" rel="stylesheet">
     <link href="<?php echo e(themes('css/angular-validation.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(themes('css/sweetalert.css')); ?>" rel="stylesheet">


<!--Testimonies css-->
<link href="<?php echo e(themes('site/css/testimonies/normalize.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(themes('site/css/testimonies/owl.carousel.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(themes('site/css/testimonies/owl.theme.default.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(themes('site/css/testimonies/style.css')); ?>" rel="stylesheet">
<!--Testimonies css-->


<?php echo $__env->yieldContent('home_css_scripts'); ?>


</head>

<body ng-app="academia">
    <!-- Navigation -->

     <?php echo $__env->make('site.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>




      <?php echo $__env->yieldContent('content'); ?>


    <?php echo $__env->make('site.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- jQuery -->

      <script src="<?php echo e(themes('site/js/jquery-3.1.1.min.js')); ?>"></script>
      <script src="<?php echo e(themes('site/js/bootstrap.min.js')); ?>"></script>
      <script src="<?php echo e(themes('site/js/slider/slick.min.js')); ?>"></script>
      <script src="<?php echo e(themes('site/js/bootstrap.offcanvas.js')); ?>"></script>
      <script src="<?php echo e(themes('site/js/jRate.min.js')); ?>"></script>
      <script src="<?php echo e(themes('site/js/wow.min.js')); ?>"></script>
      <script src="<?php echo e(themes('site/js/main.js')); ?>"></script>
      <script src="<?php echo e(themes('js/notify.js')); ?>"></script>
         <script src="<?php echo e(themes('js/sweetalert-dev.js')); ?>"></script>

        <?php echo $__env->make('errors.formMessages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <script>
        function showSubscription(use_first = ''){

        if(use_first == 'yes'){
        var user_email  = $("#email").val();
        }
        else{
        var user_email  = $("#email1").val();

        }

      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

      if(!re.test(user_email))
      {
          showMessage('Sorry','Please enter a valid email','error');
          return;
      }
     else{


         $.ajax({

                url      : '<?php echo e(URL_SAVE_SUBSCRIPTION_EMAIL); ?>',
                type     : 'post',
                data: {

                useremail    : user_email,
                '_token'     : $('[name="csrf_token"]').attr('content')

                },

                success: function( response ){
                    var email_staus  = $.parseJSON(response);
                     if(email_staus.status == 'existed'){
                        showMessage('Ok','You are already subscribed','info');
                     }
                     else{

                        showMessage('Success','You are subscription was successfull','success');
                     }
                 }


            });

           var mytext  = ''
           $("#email").val(mytext);
           $("#email1").val(mytext);


    }



  function showMessage(title,msg,type){
// console.log(u_title);
   $(function(){
            PNotify.removeAll();
            new PNotify({
                title: title,
                text: msg,
                type: type,
                delay: 2000,
                shadow: true,
                width: "300px",

                animate: {
                            animate: true,
                            in_class: 'fadeInLeft',
                            out_class: 'fadeOutRight'
                        }
                });
        });
  }

}
      </script>

   <?php echo $__env->yieldContent('footer_scripts'); ?>

    <?php echo getSetting('google_analytics', 'seo_settings'); ?>





</body>

</html>