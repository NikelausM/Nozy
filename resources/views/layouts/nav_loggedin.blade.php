
<!------Navigation Bar------>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
    <div class="container">
      <p><a class="navbar-brand" href="#"><img src="https://content.mycutegraphics.com/graphics/health/cartoon-nose-mustache.png" style="width:50px;length:50px;"></a><big style="font-weight:bold;">Nozy</big></p>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('search.index') }}">Nozy Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('user/') }}">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('notifications.index') }}">Notifications</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('user/logout') }}">Logout</a>
          </li>
        </ul>
      </div>
    </div>
</nav>
