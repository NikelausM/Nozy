<h2>Create a community?</h2>

<?php // Errors ?>
@include('profile.profile_store_errors')

<?php Session::put('unique_id', Session::get('unique_id') + 1)?>
@if(Session::has("store_community_error_".Session::get('unique_id')))
<?php $store_community_error_id = Session::get("store_community_error_".Session::get('unique_id')) ?>
<div class="alert alert-danger"><font color = "red"><?php echo nl2br($store_community_error_id);?></font></div>
<?php Session::forget($store_community_error_id) ?>

@if(count($errors->storeCommunityErrors)>0)
<div class="alert alert-danger">
    @foreach($errors->storeCommunityErrors->all() as $error)
      <p><font color = "red">{{$error}}</font></p>
    @endforeach
  </div>
@endif
@endif

<div class="container form-group">
  <form action={{route('community.store')}} method = "post">
    <div class="row-1">
      <div class="col-75" style="display: none;">
        <input type="number" id="unique_id" name="unique_id" value={{Session::get('unique_id')}}>
      </div>
    </div>
    <div class="row-1">
      <div class="col-75">
        <label for="name">Name</label>
        <input class="form-control" name="name" id="name" placeholder="Enter Name" required>
      </div>
    </div>
    <div class="row-1">
      <div class="col-75">
        <label for="inputPassword">Password</label>
        <input class="form-control" type="password" name="password" id="password" placeholder="Enter password" required>
      </div>
    </div>
    <div class="row-1">
      <div class="col-75">
        <label for="description">Community Description</label>
        <input class="form-control" name="description" id="description" placeholder="Enter community description" required>
      </div>
    </div>
    <div class="col-75" style="display: none;">
      <input type="number" class="form-control" id="manager_user_id" name="manager_user_id" value={{\App\User::where('profile_id', Auth::guard('profile')->user()->id)->first()->id}}>
    </div>
    <div class="row-1">
      <input type="submit" value="Create community">
      {{csrf_field()}}
    </div>
  </form>
</div>
