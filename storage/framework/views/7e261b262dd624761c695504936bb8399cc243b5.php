<!--Print out any errors with form inputs-->
<?php if(count($errors)>0): ?>
<div class="alert alert-danger">
		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<p><font color = "red"><?php echo e($error); ?></font></p>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
<?php endif; ?>
<!--show/hide form on button click-->
<div class="details" style="display:none">
	<form action=<?php echo e(route('user.update', $user->id)); ?> method="post">
	  <div class="form-group">
		  <label for="inputName">Name</label>
				<input type="name" class="form-control" name="name" id="name" placeholder="<?php echo e($user->profile->name); ?>" value="<?php echo e($user->profile->name); ?>">
		  <label for="inputPassword">Password</label>
				<input type="password" class="form-control" name="password" id="password" placeholder="<?php echo e($user->profile->password); ?>", value="<?php echo e($user->profile->password); ?>">
		  <label for="inputEmail">Description</label>
				<input type="description" class="form-control" name="description" id="description" placeholder="<?php echo e($user->profile->description); ?>", value="<?php echo e($user->profile->description); ?>">
		  <label for="inputEmail">Email</label>
				<input type="email" class="form-control" name="email" id="email" placeholder="<?php echo e($user->email); ?>", value="<?php echo e($user->email); ?>">
		  <label for="inputAge">Age</label>
				<input type="age" class="form-control" name="age" id="age" placeholder="<?php echo e($user->age); ?>", value="<?php echo e($user->age); ?>">
		  <button style="margin-top: 5px;" class="btn btn-primary" type="submit">Save profile info</button>
		  <?php echo e(csrf_field()); ?>

	  </div>
	</form>
</div>
<button style="margin-top: 5px;" class="btn btn-primary" id="more" href="" onclick="$('.details').slideToggle(function(){$('#more').html($('.details').is(':visible')?'Stop Editing Profile':'Edit Profile');});">Edit Profile</button>
<?php /**PATH /Users/afrahahmed/Desktop/Nozy/resources/views/user/edit_user_profile_form.blade.php ENDPATH**/ ?>