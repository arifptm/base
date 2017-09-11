<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="/assets/profiles/{{ Auth::user()->userProfile->image }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{ Auth::user()->name }}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <!-- search form -->
<!--   <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
    </div>
  </form> -->
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>   
    <li @if(\Request::is('home')) class='active' @endif>
      <a href="/home">
        <i class="fa fa-cubes"></i> 
        @if ( Auth::user()->can('manage-users'))
          <span>Dashboard</span>@else<span>Barang</span>
        @endif
      </a>
    </li>

    @can ('manage-products')
    <li @if(\Request::is('orders/*','orders')) class='active' @endif>
      <a href="/manage/products-list">
        <i class="fa fa-cart-arrow-down"></i> <span>Barang</span>
      </a>
    </li>
    @endcan

    <li @if(\Request::is('products/*','products')) class='active' @endif>
      <a href="/products">
        <i class="fa fa-bullhorn"></i> <span>Usulan</span>
      </a>
    </li>

    <li @if(\Request::is('orders/*','orders')) class='active' @endif>
      <a href="/orders">
        <i class="fa fa-cart-arrow-down"></i> <span>Permintaan</span>
      </a>
    </li>


    @if (Auth::user()->isAn('admin','super'))
      <li class="header">ADMIN</li>
    @endif
    @can ('manage-products')
      <li>
        <a href="/manage/products">
          <i class="fa fa-cubes"></i> <span>Pengaturan Barang</span>
        </a>
      </li> 
    @endcan
    @can ('manage-orders')      
      <li>
        <a href="/manage/orders">
          <i class="fa fa-cart-arrow-down"></i> <span>Pengaturan Permintaan</span>
        </a>
      </li>      
    @endcan

    @can ('manage-users')
      <li>
        <a href="/manage/users">
          <i class="fa fa-users"></i> <span>Pengaturan User</span>
        </a>
      </li> 
    @endcan       

  </ul>
</section>