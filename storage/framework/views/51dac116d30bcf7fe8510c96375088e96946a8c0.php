<div class="row" style="padding: 10px">
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail shadow">
			<h3><font color="black"><?php echo e($post->title); ?></font></h3>
			<div class="caption">
				<p><font color="black"><?php echo e($post->description); ?></font></p>
				<div>
					<form method="GET" action=<?php echo e(route('community.showUserCommunity', [$user, $community])); ?> accept-charset="UTF-8">
						<button type="submit" class="btn btn-primary">Go to post</button>
						<!--<?php echo e(csrf_field()); ?>-->
					</form>
				</div>
			</div>
		</div>
	</div>
</div><?php /**PATH /Users/afrahahmed/Desktop/Nozy/resources/views/layouts/post_box.blade.php ENDPATH**/ ?>