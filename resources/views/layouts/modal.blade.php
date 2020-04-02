<!----Sign up/Log in Popup---->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		@include('user.register')
    </div>
  </div>
</div>


<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		@include('user.login')
    </div>
  </div>
</div>


@if(session('code')) )
<script>
  $(function() {
    $('#registerModal').modal('show');
  });
</script>
@endif
