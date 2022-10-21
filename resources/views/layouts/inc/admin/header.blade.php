<header class="main-header" id="header">
    <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
        </button>
        <span class="page-title">@yield( "title" )</span>
        <div class="navbar-right ">
            <!-- search form -->
            <div class="search-form">
                <form action="{{ asset('index.html') }}" method="get">
                    <div class="input-group input-group-sm" id="input-group-search">
                        <input type="text" autocomplete="off" name="query" id="search-input" class="form-control"
                            placeholder="Search..." />
                        <div class="input-group-append">
                            <button class="px-2" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </form>
            </div>

            <ul class="nav navbar-nav">
                <!-- User Account -->
                <li class="dropdown user-menu">
                    <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="{{ url_image( Auth::user()->avata ) }}" class="user-image rounded-circle mx-auto object-cover rounded-full h-[40px] bg-white w-[40px]"
                            alt="User Image" />
                        <span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a class="dropdown-link-item" href="user-profile.html">
                                <i class="mdi mdi-account-outline"></i>
                                <span class="nav-text">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-link-item" href="email-inbox.html">
                                <i class="mdi mdi-email-outline"></i>
                                <span class="nav-text">Message</span>
                                <span class="badge badge-pill badge-primary">24</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-link-item" href="user-activities.html">
                                <i class="mdi mdi-diamond-stone"></i>
                                <span class="nav-text">Activitise</span></a>
                        </li>
                        <li>
                            <a class="dropdown-link-item" href="user-account-settings.html">
                                <i class="mdi mdi-settings"></i>
                                <span class="nav-text">Account Setting</span>
                            </a>
                        </li>
                        <li class="dropdown-footer py-1">
                            <a class="" href="#" onclick="$('#logout-form').submit();"> <i class="mdi mdi-logout"></i> Log
                                Out </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
