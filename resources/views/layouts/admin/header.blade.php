 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" title="logout" href="{{route('logout')}}" role="button">
          <i class="fas fa-power-off"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" title="home" href="{{URL::to('/')}}" target="" role="button">
          <i class="fas fa-home"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" title="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->