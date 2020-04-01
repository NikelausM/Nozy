@if(Session::has("show_comments_error"))
<div class="alert alert-danger"><?php echo nl2br(Session::get("show_comments_error"));?></div>
@elseif(Session::has("no_comments_message"))
<div class="alert alert-info"><?php echo nl2br(Session::get("no_comments_message"));?></div>
@else
<?php $postComments = $comments->where('parent_id',0); ?>
@foreach($postComments as $comment)
@include('comment.comment_box')
@endforeach
@endif
