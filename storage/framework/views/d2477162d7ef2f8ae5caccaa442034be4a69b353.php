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
	<form action=<?php echo e(route('community.updateUserCommunity', [$user, $community])); ?> method="post">
	  <div class="form-group">
		  <label for="inputName">Name</label>
				<input type="name" class="form-control" name="name" id="name" placeholder="<?php echo e($community->profile->name); ?>" value="<?php echo e($community->profile->name); ?>">
		  <label for="inputPassword">Password</label>
				<input type="password" class="form-control" name="password" id="password" placeholder="<?php echo e($community->profile->password); ?>", value="<?php echo e($community->profile->password); ?>">
		  <label for="inputEmail">Description</label>
				<input type="description" class="form-control" name="description" id="description" placeholder="<?php echo e($community->profile->description); ?>", value="<?php echo e($community->profile->description); ?>">
		  <button style="margin-top: 5px;" class="btn btn-primary" type="submit">Save profile info</button>
		  <?php echo e(csrf_field()); ?>

	  </div>
	</form>
</div>
<button style="margin-top: 5px;" class="btn btn-primary" id="more" href="" onclick="$('.details').slideToggle(function(){$('#more').html($('.details').is(':visible')?'Stop Community Editing Profile':'Edit Community Profile');});">Edit Community Profile</button>
<?php /**PATH /Users/afrahahmed/Desktop/Nozy/resources/views/community/edit_community_profile_form.blade.php ENDPATH**/ ?>