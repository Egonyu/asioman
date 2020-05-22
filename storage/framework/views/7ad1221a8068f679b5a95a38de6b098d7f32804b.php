<!DOCTYPE html>
<html lang="en" >

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	 
	<link rel="icon" href="#" type="image/x-icon" />
	
	<title><?php echo e(isset($title) ? $title : 'Exam system'); ?></title>

	<?php echo $__env->yieldContent('header_scripts'); ?>
	<!-- Bootstrap Core CSS -->
	<link href="<?php echo e(CSS); ?>bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="<?php echo e(CSS); ?>sb-admin.css" rel="stylesheet">
	<!-- Morris Charts CSS -->
	<link href="<?php echo e(CSS); ?>plugins/morris.css" rel="stylesheet">
	<!-- Proxima Nova Fonts CSS -->
	<link href="<?php echo e(CSS); ?>proximanova.css" rel="stylesheet">
	<!-- Custom Fonts -->
	<link href="<?php echo e(CSS); ?>custom-fonts.css" rel="stylesheet" type="text/css">
	<link href="<?php echo e(CSS); ?>materialdesignicons.css" rel="stylesheet" type="text/css">
	<link href="<?php echo e(FONTAWSOME); ?>font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo e(CSS); ?>sweetalert.css" rel="stylesheet" type="text/css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="login-screen" ng-app="academia" >


	<?php echo $__env->yieldContent('content'); ?>
	

		<!-- /#wrapper -->
		<!-- jQuery -->
		<script src="<?php echo e(JS); ?>jquery-1.12.1.min.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="<?php echo e(JS); ?>bootstrap.min.js"></script>

		<!-- Morris Charts JavaScript -->
		
		
		<!--JS Control-->
		<script src="<?php echo e(JS); ?>main.js"></script>
		<script src="<?php echo e(JS); ?>sweetalert-dev.js"></script>
		<?php echo $__env->make('errors.formMessages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->yieldContent('footer_scripts'); ?>
</body>

</html>