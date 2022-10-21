<aside class="left-sidebar sidebar-dark" id="left-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo/huyhieudoan.png') }}" width="40" alt="HuyHieuDoan">
                <span class="brand-name">Trang chủ</span>
            </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-left" data-simplebar style="height: 100%;">
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <li>
                    <a class="sidenav-item-link" href="{{ url( "admin" ) }}">
                        <i class="mdi mdi-briefcase-account-outline"></i>
                        <span class="nav-text">Bảng điều khiển</span>
                    </a>
                </li>
                @foreach ( config('sidebar') as $menu )
                    @if ( !empty( $menu['parent'] ) )
                        <li class="has-sub expand">
                            <a class="sidenav-item-link" href="#" data-toggle="collapse" data-target="#{{ $menu[ 'id' ] }}"
                                aria-expanded="true" aria-controls="email">
                                <i class="mdi mdi-email"></i>
                                <span class="nav-text">{{ $menu['name'] }}</span> <b class="caret"></b>
                            </a>
                        </li>
                        <ul class="collapse" id="{{ $menu[ 'id' ] }}">
                            <div class="sub-menu">
                                @foreach ( $menu['parent'] as $menuParent )
                                <li>
                                    <a class="sidenav-item-link collapse" href="{{ route( $menuParent['route'] ) }}">
                                        <span class="nav-text">{{ $menuParent['name'] }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </div>
                        </ul>
                    @else
                        <li>
                            <a class="sidenav-item-link" href="{{ route($menu['route']) }}">
                                <i class="mdi mdi-briefcase-account-outline"></i>
                                <span class="nav-text">{{ $menu['name'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div class="sidebar-footer">
            <div class="sidebar-footer-content">
                <ul class="d-flex">
                    <li>
                        <a href="user-account-settings.html" data-toggle="tooltip" title="Profile settings"><i
                                class="mdi mdi-settings"></i></a>
                    </li>
                    <li>
                        <a href="#" data-toggle="tooltip" title="No chat messages"><i
                                class="mdi mdi-chat-processing"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
