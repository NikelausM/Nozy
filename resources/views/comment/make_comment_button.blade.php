<!-- to be created -->
<head>
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 130%;
  padding-bottom: 12px;
  padding-left: 20px;
  padding-right: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: none;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.col-25 {
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row-1:after {
  content: "";
  display: table;
  clear: both;
}

</style>
</head>
<body>
<?php $user_posting_comment = \App\User::where('profile_id', Auth::guard('profile')->user()->id)->first();?>
  <h2>Post a comment?</h2>
  <div class="container">
    <?php // Give the form a unique id ?>
    @if(Session::has('unique_id'))
    {{Session::put('unique_id', Session::get('unique_id') + 1)}}
    @else
    {{Session::put('unique_id', 1)}}
    @endif
    @if(Illuminate\Support\Facades\Session::has("store_comment_error_".Session::get('unique_id')))
    {{$store_comment_error_id = Session::get("store_comment_error_".Session::get('unique_id'))}}
    <div class="alert alert-danger"><font color = "red"><?php echo nl2br($store_comment_error_id);?></font></div>
    {{Session::forget($store_comment_error_id)}}
    @if(count($errors->storeCommentErrors)>0)
    <div class="alert alert-danger">
    		@foreach($errors->storeCommentErrors->all() as $error)
    			<p><font color = "red">{{$error}}</font></p>
    		@endforeach
    	</div>
    @endif
    @endif
    <form action={{route('comment.store')}} method="post"><!-- fill this in later nick-->
      <div class="row-1">
        <div class="col-75" style="display: none;">
          <input type="number" id="unique_id" name="unique_id" value={{Session::get('unique_id')}}>
        </div>
      </div>
      <div class="row-1">
        <div class="col-75" style="display: none;">
          <input type="number" id="post_id" name="post_id" value={{$post->id}}>
        </div>
      </div>
      <div class="row-1">
        <div class="col-75" style="display: none;">
          <input type="number" id="user_id" name="user_id" value={{$user_posting_comment->id}}>
        </div>
      </div>
      <div class="row-1">
        <div class="col-75">
          <input type="text" id="body" name="body" placeholder="Enter comment...">
        </div>
      </div>
      <div class="row-1">
        <div class="col-75" style="display: none;">
          <input type="number" id="parent_id" name="parent_id" value={{$parent_id}}>
        </div>
      </div>
      <div class="row-1">
        <input type="submit" value="Post">
        {{csrf_field()}}
      </div>
    </form>
  </div>

</body>
