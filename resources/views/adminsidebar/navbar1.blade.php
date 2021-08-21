<nav class="navbar col-lg-20 col-20 p-0 fixed-top d-flex flex-row ">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo " href=""><img src="{{asset('backend/images/batman.png')}}" class="mr-2"
        alt="logo" class="img-fluid img-thumbnail" /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">

    </button>
    <ul class="navbar-nav mr-lg-2">
      <li class="nav-item nav-search d-none d-lg-block">
        <div class="input-group">
        </div>
      </li>
    </ul>
    @guest
    @else
    {{ Auth::user()->name }}
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
          <img src="{{asset('backend/images/logo_2H_tech.png')}}" alt="profile" />
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
            >
            <i class="ti-power-off text-primary"></i>
            {{ __('Logout') }}
          </a>


          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </li>

    </ul>
    @endguest
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
      data-toggle="offcanvas">
      <span class="ti-layout-grid2"></span>
    </button>
  </div>
</nav>