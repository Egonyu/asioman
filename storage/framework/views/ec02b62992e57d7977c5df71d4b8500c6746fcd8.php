<?php $__env->startSection('header_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="<?php echo e(PREFIX); ?>"><i class="mdi mdi-home"></i></a> </li>
							<li><a href="<?php echo e(URL_SETTINGS_LIST); ?>"><?php echo e(getPhrase('settings')); ?></a>  </li>
							<li><?php echo e($title); ?></li>
						</ol>
					</div>
				</div>
								
				<!-- /.row -->
				<div class="panel panel-custom col-lg-10 col-lg-offset-1">
					<div class="panel-heading">
						
					<div class="pull-right messages-buttons">
							<?php if($slug == "recaptcha-settings"): ?>
							
							<img src="<?php echo e(IMAGES); ?>rechaptcha.png" height="25px"><a href="https://www.google.com/recaptcha/admin#list" target="_blank" class="btn  btn-primary button" >
								 Manage your reCAPTCHA API keys</a>
						<?php endif; ?>		 
							 
						</div>
						<h1><?php echo e($title); ?>


						</h1>

					</div>
					<div class="panel-body packages">
					<div class="row">
						<?php if($record->image): ?>
						<img src="<?php echo e(IMAGE_PATH_SETTINGS.$record->image); ?>" width="100" height="100">
						<?php endif; ?>
					</div>
					<?php echo Form::open(array('url' => URL_SETTINGS_ADD_SUBSETTINGS.$record->slug, 'method' => 'PATCH', 
						'novalidate'=>'','name'=>'formSettings ', 'files'=>'true')); ?>

						<div class="row"> 
						<ul class="list-group">
						<?php if(count($settings_data)): ?>

						<?php $__currentLoopData = $settings_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php 
							$type_name = 'text';

							if($value->type == 'number' || $value->type == 'email' || $value->type=='password')
								$type_name = 'text';
							else
								$type_name = $value->type;
						?>
						 
						<?php echo $__env->make(
									'mastersettings.settings.sub-list-views.'.$type_name.'-type', 
									array('key'=>$key, 'value'=>$value)
								, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						  <?php else: ?>
							  <li class="list-group-item"><?php echo e(getPhrase('no_settings_available')); ?></li>
						  <?php endif; ?>
						</ul>

						</div>

						<?php if(count($settings_data)): ?>
						<div class="buttons text-center clearfix">
							<button class="btn btn-lg btn-success button" ng-disabled='!formTopics.$valid'
							><?php echo e(getPhrase('update')); ?></button>
						</div>
						<?php endif; ?>
							<?php echo Form::close(); ?>

					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
<?php $__env->stopSection(); ?>
 

<?php $__env->startSection('footer_scripts'); ?>
  
 
  <script src="<?php echo e(JS); ?>bootstrap-toggle.min.js"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>