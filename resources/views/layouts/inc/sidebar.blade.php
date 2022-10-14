  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url( '/' ) }}" class="brand-link bg-blue-700">
        <img src="{{ asset( 'images/logo/huyhieudoan.png' ) }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text text-lg">{{ "Đoàn viên thanh niên"}}</span>
    </a>

    <a id="navbarDropdown" class="px-4 nav-link dropdown-toggle brand-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre >
        <img src="{{ url_image( Auth::user()->avata ) }}" alt="AdminLTE Logo" class="w-[30px] h-[30px] float-left img-circle elevation-3" style="opacity: .8">
        <span class="pl-3">{{ Auth::user()->name }}</span>
    </a>

    <div class="mx-5 dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>


    <!-- Sidebar -->
    <div class="sidebar mt-2">
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url( "admin" ) }}" class="nav-link">
                        <i class="fa-solid fa-list"></i>
                        <p>Bảng điều chỉnh</p>
                    </a>
                </li>
                @forelse ( config( "sidebar" ) as $menu )
                    <li class="nav-item">
                        <a href="{{ route( $menu['route'] ) }}" class="nav-link">
                            {!! $menu[ 'icon' ] !!}
                            <p>{{ $menu[ 'name' ] }}</p>
                        </a>
                    </li>
                @empty
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        Hiện tại chưa có danh mục
                    </a>
                </li>
                @endforelse
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
