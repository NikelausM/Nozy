<?php $__env->startSection('content'); ?>
<div class="masthead">
	<div class="container h-100">
		<br></br>
		<div class="row h-75 align-items-center">
			<div style="top: 20%;" class="col-12">
				<h1 class="font-weight-bold">Welcome to <?php echo e($community->profile->name); ?></h1>
				<h2 class="font-weight-bold">Description: <?php echo e($community->profile->description); ?></h2>
				<?php if(Auth::guard('profile')->user()->id == $community->profile->id): ?>
				<?php echo $__env->make('community.edit_community_profile_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
				<?php $profile = $community -> profile;?>
				<?php echo $__env->make('layouts.makePost_button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php $__currentLoopData = $community->profile->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php echo $__env->make('layouts.post_box', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.welcome_loggedin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/afrahahmed/Desktop/Nozy/resources/views/community/community.blade.php ENDPATH**/ ?>