<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset("")}}dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset("")}}dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Console Kasir
            </p>
          </a>
        </li>
        
        <li class="nav-header">Menu</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-folder nav-icon"></i>
            <p>
              Produk
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.product.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Produk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.category.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Kategori Produk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.stock.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manajemen Stok</p>
              </a>
            </li>
            
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-folder nav-icon"></i>
            <p>
              Transaksi
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('orderview') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pemesanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('incomeview') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pemasukan</p>
              </a>
            </li><li class="nav-item">
              <a href="{{ route('outcomeview') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pengeluaran</p>
              </a>
            </li>
          </ul>
        </li>
        
        <li class="nav-item">
          <a href="{{route('admin.report.index')}}" class="nav-link">
            <i class="fas fa-folder nav-icon"></i>
            <p>Laporan</p>
          </a>
        </li>
        <li class="nav-item">
          @role('admin')
            <a href="{{ route('admin.user.index') }}" class="nav-link">
              <i class="fas fa-folder nav-icon"></i>
              <p>User</p>
            </a>
          @endrole
        </li>
        {{-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Menu 1</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              Menu 2
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>submenu 1</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  submenu 2
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>sub submenu 1</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>sub submenu 2</p>
                  </a>
                </li>
              </ul>
            </li>
            
          </ul>
        </li> --}}
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>