<?php Session::put('unique_id', Session::get('unique_id') + 1);?>
<?php Log::info("errors store_profile_error_id: ".Session::get('unique_id')); ?>
@if(Session::has("store_profile_error_".Session::get('unique_id')))
<?php $store_profile_error_id = Session::get("store_profile_error_".Session::get('unique_id')) ?>
<div class="alert alert-danger"><font color = "red"><?php echo nl2br($store_profile_error_id);?></font></div>
<?php Session::forget($store_profile_error_id); ?>

@if(count($errors->storeProfileErrors)>0)
<div class="alert alert-danger">
    @foreach($errors->storeProfileErrors->all() as $error)
      <p><font color = "red">{{$error}}</font></p>
    @endforeach
  </div>
@endif
@endif
