<!-- make community box to do -->
<body>

<h2>Create a community?</h2>
<div class="container form-group">
  <form action=<?php echo e(route('community.store')); ?> method = "post">
  <div class="row-1">
    <div class="col-75">
      <label for="name">Name</label>
      <input class="form-control" name="name" id="name" placeholder="Enter Name">
    </div>
  </div>
  <div class="row-1">
    <div class="col-75">
      <label for="inputPassword">Password</label>
      <input class="form-control" name="password" id="password" placeholder="Enter password">
    </div>
  </div>
  <div class="row-1">
    <div class="col-75">
      <label for="description">Community Description</label>
      <input class="form-control" name="description" id="description" placeholder="Enter community description">
    </div>
  </div>
  <div class="col-75" style="display: none;">
    <input type="number" class="form-control" id="manager_user_id" name="manager_user_id" value=<?php echo e(\App\User::where('profile_id', Auth::guard('profile')->user()->id)->first()->id); ?>>
  </div>
  <div class="row-1">
    <input type="submit" value="Create community">
    <?php echo e(csrf_field()); ?>

  </div>
  </form>
</div>

</body>
<?php /**PATH /home/nwd/Desktop/Nozy/resources/views/layouts/makeCommunity_button.blade.php ENDPATH**/ ?>