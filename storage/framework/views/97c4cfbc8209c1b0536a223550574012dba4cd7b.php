<div class="modal-header">
	<h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>
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
<form action=<?php echo e(route('user.store')); ?> method="post">
  <div class="modal-body form-group">
	  <div class="row">
		<div class="col">
			<label for="name">Name</label>
			<input class="form-control" name="name" id="name" placeholder="Enter Name">
		</div>
	  </div>
	  <div class="row">
		<div class="col">
			<label for="inputPassword">Password</label>
			<input class="form-control" name="password" id="password" placeholder="Enter password">
		</div>
	  </div>
	  <div class="row">
		<div class="col">
			<label for="description">Personal Description</label>
			<input class="form-control" name="description" id="description" placeholder="Enter Personal Description">
		</div>
	  </div>
	  <div class="row">
		<div class="col">
			<label for="inputEmail">Email address</label>
			<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
		</div>
	  </div>
	  <div class="row">
		<div class="col">
			<label for="age">Age</label>
			<input class="form-control" name="age" id="age" placeholder="Enter Age">
		</div>
	  </div>
	  <button style="margin-top: 5px;" class="btn btn-primary" type="submit">Register</button>
	  <?php echo e(csrf_field()); ?>

  </div>
</form>
<?php /**PATH /home/nwd/Desktop/Nozy/resources/views/user/register.blade.php ENDPATH**/ ?>