<div class="modal-header">
	<h5 class="modal-title" id="exampleModalLabel">Log In</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
</div>
<?php if(count($errors)>0): ?>
	<div class="alert alert-danger">
		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<p><font color = "red"><?php echo e($error); ?></font></p>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
<?php endif; ?>
<form action=<?php echo e(route('user.postLogin')); ?> method="post">
  <div class="modal-body form-group">
	  <div class="row">
		<div class="col">
			<label for="inputName">Name</label>
			<input type="name" class="form-control" name="name" id="name" placeholder="Enter Name">
		</div>
	  </div>
	  <div class="row"> 
		<div class="col">
			<label for="inputPassword">Password</label>
			<input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
		</div>
	  </div>
	  <button style="margin-top: 5px;" class="btn btn-primary" type="submit">Log In</button>
	  <?php echo e(csrf_field()); ?>

  </div>
</form>

<?php /**PATH /Users/afrahahmed/Desktop/Nozy/resources/views/user/login.blade.php ENDPATH**/ ?>