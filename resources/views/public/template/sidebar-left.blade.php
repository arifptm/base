<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="/assets/profiles/{{ Auth::user()->userProfile->image }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>Alexander Pierce</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <!-- search form -->
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
    </div>
  </form>
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li>
      <a href="/products">
        <i class="fa fa-th"></i> <span>Products</span>
      </a>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
        <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-files-o"></i>
        <span>Layout Options</span>
        <span class="pull-right-container">
          <span class="label label-primary pull-right">4</span>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
        <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
        <li class="active"><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
        <li><a href="collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
      </ul>
    </li>
    <li>
      <a href="../widgets.html">
        <i class="fa fa-th"></i> <span>Widgets</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-green">new</small>
        </span>
      </a>
    </li>
    <li class="header">USER</li>
    <li>
      <a href="/users">
        <i class="fa fa-th"></i> <span>Users</span>
      </a>
    </li>    
    
  </ul>
</section>