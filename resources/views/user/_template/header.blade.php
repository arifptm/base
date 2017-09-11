<!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>MA</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>My</b> Application</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{ Auth::user()->unreadNotifications->count() }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda mempunyai {{ Auth::user()->notifications->count() }} notification</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  @foreach(Auth::user()->unreadNotifications as $notification)
                    <li><a href="/manage/users/{{ $notification->data['id'] }}?id={{ $notification->id }}">Registrasi user baru : <b>{{ $notification->data['name'] }}</b></a></li>
                  @endforeach
                </ul>
              </li>
              <li class="footer"><a href="/notification">Lihat semua notifikasi</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/assets/profiles/{{ Auth::user()->userProfile->image }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/assets/profiles/{{ Auth::user()->userProfile->image }}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->name }} - @foreach(Auth::user()->roles as $role) {{ $role->name }}  @endforeach
                  <small>Member since : {{ Auth::user()->created_at->format('M. Y') }}</small>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a class='btn btn-default btn-flat' href="{{ route('logout') }}" onclick="
                    event.preventDefault();
                    document.getElementById('logout-form').submit();">
                      Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>