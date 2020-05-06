<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-dark bg-2">
      
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button" id="btn-collapse"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <!-- /Left navbar links -->

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <i class="fa fa-power-off mr-1"></i> Log Out
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </li>
  </ul>
  <!-- /Right navbar links -->

</nav>
<!-- /Navbar -->