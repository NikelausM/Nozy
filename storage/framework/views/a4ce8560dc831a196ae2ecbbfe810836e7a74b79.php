<div class="row" style="padding: 10px">
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail shadow">
			<h3><font id='community_profile_name' color="black"><?php echo e($community->profile->name); ?></font></h3>
			<div class="caption">
				<p><font id='community_profile_description' color="black"><?php echo e($community->profile->description); ?></font></p>
				<div>
					<?php if(Auth::guard('profile')->user()->id == $community->manager_user_id): ?>
					<?php echo $__env->make('community.edit_community_profile_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<?php echo $__env->make('community.delete_community_button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<?php endif; ?>
					<form method="GET" action=<?php echo e(route('community.show', $community)); ?> accept-charset="UTF-8">
					<button type="submit" class="btn btn-primary">Go to community</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php /**PATH /home/nwd/Desktop/Nozy/resources/views/layouts/community_box.blade.php ENDPATH**/ ?>