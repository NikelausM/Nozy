<?php $__env->startSection('content'); ?>
<div class="masthead">
	<div class="container h-100">
		<br></br>
		<div class="row h-75 align-items-center">
			<div style="top: 20%;" class="col-12">
				<h1 class="font-weight-bold"><font color="black"><?php echo e($user->profile->name); ?></font></h1>
				<h1 class="font-weight-bold"><font color="black"><?php echo e($user->profile->description); ?></font></h1>
				<?php if(Auth::guard('profile')->user()->id == $user->profile->id): ?>
				<?php echo $__env->make('user.edit_user_profile_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
				<h2 class="font-weight-bold"><font color="black">Communities</font></h2>
				<?php echo $__env->make('layouts.makeCommunity_button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php $__currentLoopData = $user->communities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $community): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php echo $__env->make('layouts.community_box', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<h2 class="font-weight-bold"><font color="black">Posts</font></h2>
				<?php echo $__env->make('layouts.makePost_button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php $__currentLoopData = $user->profile->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php echo $__env->make('layouts.post_box', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<br></br>
				<br></br>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.welcome_loggedin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/afrahahmed/Desktop/Nozy/resources/views/user/user.blade.php ENDPATH**/ ?>