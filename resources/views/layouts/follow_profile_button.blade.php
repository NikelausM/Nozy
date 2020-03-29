<?php //Check if already following ?>
@if(Session::has("following_error"))
<?php $following_error = Session::get("following_error") ?>
<div class="alert alert-danger"><font color = "red"><?php echo nl2br($following_error);?></font></div>
{{Session::forget($following_error)}}
@endif
<?php //Follow followingable class ?>
<div class="container form-group">
  <form action={{route('following.store')}} method = "post">
    <div class="row-1">
      <div class="col-75" style="display: none;">
        <input type="number" id="followingable_id" name="followingable_id" value={{$profile->id}}>
      </div>
    </div>
    <div class="row-1">
      <div class="col-75" style="display: none;">
        <input type="text" id="followingable_type" name="followingable_type" value={{get_class($profile)}}>
      </div>
    </div>
    <div class="row-1">
      <div class="col-75" style="display: none;">
        <input type="number" id="follower_id" name="follower_id" value={{Auth::guard('profile')->user()->id}}>
      </div>
    </div>
    <div class="row-1">
      <input type="submit" value="Follow Profile">
      {{csrf_field()}}
    </div>
  </form>
</div>
