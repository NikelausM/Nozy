<?php Session::put('unique_id', Session::get('unique_id') + 1);?>
<?php Log::info("errors update_profile_error_id: ".Session::get('unique_id')); ?>
@if(Session::has("update_profile_error_".Session::get('unique_id')))
<?php $update_profile_error_id = Session::get("update_profile_error_".Session::get('unique_id')) ?>
<div class="alert alert-danger"><font color = "red"><?php echo nl2br($update_profile_error_id);?></font></div>
<?php Session::forget($update_profile_error_id); ?>

@if(count($errors->updateProfileErrors)>0)
<div class="alert alert-danger">
    @foreach($errors->updateProfileErrors->all() as $error)
      <p><font color = "red">{{$error}}</font></p>
    @endforeach
  </div>
@endif
@endif
