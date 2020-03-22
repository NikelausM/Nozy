<div class="row" style="padding: 10px"><!--row-->
  <div class="col-sm-6 col-md-4"><!--column-->
    <div class="thumbnail shadow">
      <div class="caption">
        <?php $user_posting_comment = \App\User::where('id', $comment->user_id)->first();?>
        <h3>{{$user_posting_comment->profile->name}}: </h3>
        <p>{{$comment->body}}</p>
      </div>
    </div>
  </div>
</div>
