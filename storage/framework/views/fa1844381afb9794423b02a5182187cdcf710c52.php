
				<div class="row">

 					<fieldset class="form-group col-md-6">
						<?php echo e(Form::label('name', getphrase('name'))); ?>

						<span class="text-red">*</span>
						<?php echo e(Form::text('name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('name'),
							'ng-model'=>'name',
							'required'=> 'true',
							'ng-class'=>'{"has-error": formQuiz.name.$touched && formQuiz.name.$invalid}',
							'ng-minlength' => '4',
							'ng-maxlength' => '50',
						))); ?>

						<div class="validation-error" ng-messages="formQuiz.name.$error" >
	    					<?php echo getValidationMessage(); ?>

	    					<?php echo getValidationMessage('minlength'); ?>

	    					<?php echo getValidationMessage('maxlength'); ?>

						</div>
					</fieldset>

					<fieldset class="form-group col-md-3">
						<?php echo e(Form::label('validity', getphrase('validity'))); ?>

						<span class="text-red">*</span>
						<?php echo e(Form::number('validity', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('validity'),
							'ng-model'=>'validity',
							'min'=>1,
							'required'=> 'true',
							'ng-class'=>'{"has-error": formQuiz.validity.$touched && formQuiz.validity.$invalid}',
						))); ?>

						<div class="validation-error" ng-messages="formQuiz.validity.$error" >
	    					<?php echo getValidationMessage(); ?>

	    					<?php echo getValidationMessage('number'); ?>

						</div>
					</fieldset>

					<fieldset class="form-group col-md-3">
						<?php $validity_types = array('Day', 'Week' =>'Week', 'Month' => 'Month', 'Year' => 'Year');?>
						<?php echo e(Form::label('validity_type', getphrase('validity_type'))); ?>

						<span class="text-red">*</span>
						<?php echo e(Form::select('validity_type', $validity_types, null, ['class'=>'form-control'])); ?>

					</fieldset>

					<fieldset class="form-group col-md-6">
						<?php echo e(Form::label('amount', getphrase('amount'))); ?>

						<span class="text-red">*</span>
						<?php echo e(Form::number('amount', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('amount'),
							'ng-model'=>'amount',
							'required'=> 'true',
							'ng-class'=>'{"has-error": formQuiz.amount.$touched && formQuiz.amount.$invalid}',
							'step' => '0.01',
							'min' => '1'
						))); ?>

						<div class="validation-error" ng-messages="formQuiz.amount.$error" >
	    					<?php echo getValidationMessage(); ?>

						</div>
					</fieldset>


					<fieldset class="form-group col-md-6">

						<?php $status = array('1' =>'Active', '0' => 'Inactive', );?>

						<?php echo e(Form::label('status', getphrase('status'))); ?>


						<span class="text-red">*</span>

						<?php echo e(Form::select('status', $status, null, ['class'=>'form-control'])); ?>


					</fieldset>

				</div>


				<div class="row">



					<fieldset class="form-group">

						<?php echo e(Form::label('description', getphrase('description'))); ?>




						<?php
	                        $val=old('description');
	                        if ($record)
	                         $val = $record->description;
                    	?>


						<?php echo e(Form::textarea('description', $value = null , $attributes =

						array('class' => 'form-control ckeditor',

		                    'placeholder' => 'description',

		                    'ng-model' => 'description',

		                    'ng-init'=>'description="'.$val.'"',

		                    ))); ?>


					</fieldset>


					<div class="buttons text-center">

						<button class="btn btn-lg btn-success button"

						ng-disabled='!formQuiz.$valid'><?php echo e($button_name); ?></button>

					</div>

		 		</div>