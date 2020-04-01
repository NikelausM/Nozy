<?php $user_posting_comment = \App\User::where('id', $comment->user_id)->first(); ?>
<div class="row" style="padding: 25px">
		<div class="thumbnail shadow">
			<h3><font color="black">Comment by {{$user_posting_comment->profile->name}}</font></h3>
			<div class="caption">
				<p><font color="black">{{$comment->body}}</font></p>
				<div>
          <?php //Check if logged in user is author of this comment ?>
          @if(\App\User::where('profile_id', Auth::guard('profile')->user()->id)->first()->id == $comment->user_id)
          @include('comment.edit_comment_form')
          @include('comment.delete_comment_button')
          @endif
          <?php $parent_id = $comment->id; // Parent is current comment?>
          @foreach($comments->where('parent_id',$comment->id) as $comment)
          @include('comment.comment_box')
          @endforeach
          @include('comment.make_comment_reply_button')
				</div>
			</div>
		</div>
</div>
