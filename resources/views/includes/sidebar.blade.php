<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 bg-1">
      
  <a href="#" class="brand-link header-logo">
    <img src="{{ asset('assets/img/logo-2.png') }}" alt="">
  </a>
  
  <!-- Sidebar -->
  <div class="sidebar">
    
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets/img/mele-user.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">
          @if (session('name'))
            {{ session('name') }}
          @endif
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2 nav-legacy my-sidebar">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-item" id="dashboard-menu">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item has-treeview" id="product-menu">

          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-box-open"></i>
            <p>
              Produk
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item" id="add-product-menu">
              <a href="{{ route('add-product') }}" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Tambah Produk</p>
              </a>
            </li>

            <li class="nav-item" id="product-data-menu">
              <a href="{{ route('product-data') }}" class="nav-link">
                <i class="fas fa-th-list nav-icon"></i>
                <p>Data Produk</p>
              </a>
            </li>

            <li class="nav-item" id="product-gallery-menu">
              <a href="{{ route('gallery-data') }}" class="nav-link">
                <i class="fas fa-images nav-icon"></i>
                <p>Galeri Produk</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item has-treeview" id="transaction-menu">

          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cart-arrow-down"></i>
            <p>
              Transaksi
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item" id="transaction-data-menu">
              <a href="{{ route('transaction-data') }}" class="nav-link">
                <i class="fas fa-th-list nav-icon"></i>
                <p>Data Transaksi</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item has-treeview" id="category-menu">

          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
              Kategori Produk
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item" id="add-category-menu">
              <a href="{{ route('add-category') }}" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Tambah Kategori</p>
              </a>
            </li>

            <li class="nav-item" id="category-data-menu">
              <a href="{{ route('category-data') }}" class="nav-link">
                <i class="fas fa-th-list nav-icon"></i>
                <p>Data Kategori</p>
              </a>
            </li>

          </ul>
        </li>
        
      </ul>
    </nav>
    <!-- /Sidebar-menu -->
  </div>
  <!-- /Sidebar -->

</aside>
<!-- Main Sidebar Container -->
