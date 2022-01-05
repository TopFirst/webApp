  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ url('admin/dist/img/logo.png') }}" alt="Lam Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Aplikasi Kurir') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset(Auth::user()->foto) }}" class="img-circle elevation-2" alt="User">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('posts.create') }}" class="nav-link {{ Request::is('posts/create')?'active':'' }}">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Artikel Baru
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('posts.createvideo') }}" class="nav-link {{ Request::is('posts/createvideo')?'active':'' }}">
              <i class="nav-icon fas fa-video"></i>
              <p>
                Video Baru
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('posts.createfoto') }}" class="nav-link {{ Request::is('posts/createfoto')?'active':'' }}">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Foto Baru
              </p>
            </a>
          </li>
          <li class="nav-header">Data</li>
          <li class="nav-item">
                <a href="{{ route('posts.index') }}" class="nav-link {{ Request::is('posts')?'active':'' }}">
                  <i class="nav-icon fas fa-newspaper"></i>
                  <p>
                    Artikel
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pages.index') }}" class="nav-link {{ Request::is('pages*')?'active':'' }}">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Halaman
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('masters.index') }}" class="nav-link {{ Request::is('masters*')?'active':'' }}">
                  <i class="nav-icon fas fa-database"></i>
                  <p>
                    Master
                  </p>
                </a>
              </li>
              <li class="nav-header">Pengaturan</li>
              <li class="nav-item">
                <a href="{{ route('home.web_config') }}" class="nav-link {{ Request::is('home/web_config')?'active':'' }}">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                    Pengaturan Web
                  </p>
                </a>
              </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>