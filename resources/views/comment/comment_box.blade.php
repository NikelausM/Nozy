<div class="row" style="padding: 10px"><!--row-->
  <div class="col-sm-6 col-md-4"><!--column-->
    <div class="thumbnail shadow">
      <div class="caption">
        <?php $user_posting_comment = \App\User::where('id', $comment->user_id)->first(); ?>
        <h3>{{$user_posting_comment->profile->name}}: </h3>
        <p>{{$comment->body}}</p>
        <?php //Check if logged in user is author of this comment ?>
        @if(\App\User::where('profile_id', Auth::guard('profile')->user()->id)->first()->id == $comment->user_id)
        @include('comment.edit_comment_form')
        @include('comment.delete_comment_button')
        @endif
      </div>
    </div>
  </div>
</div>
