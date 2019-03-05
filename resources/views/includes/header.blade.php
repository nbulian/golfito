<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" id="menu">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/" id="golf">Golfito</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="#" id="create">New Tournament</a></li>
          <li><a href="#" id="h2h-step1">H2H</a></li>
          <li><a href="#" id="players">Players</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{ route('logout') }}"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
    </div>
  </div>
</nav>