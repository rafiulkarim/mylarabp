<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <!-- Dashboard -->
                <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                    <a href="{{ url('home') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- User -->
                <li class="nav-item {{ Request::is('user*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#user" class="{{ Request::is('user*') ? '' : 'collapsed' }}"
                        aria-expanded="{{ Request::is('user*') ? 'true' : 'false' }}">
                        <i class="fas fa-users"></i>
                        <p>User</p>
                        <span class="caret {{ Request::is('user*') ? 'caret-down' : 'caret-right' }}"></span>
                    </a>
                    <div class="collapse {{ Request::is('user*') ? 'show' : '' }}" id="user">
                        <ul class="nav nav-collapse" style="padding-left: 20px; line-height: 1">
                            <li class="{{ Request::is('user/create') ? 'active' : '' }}">
                                <a href="{{ url('user/create') }}">
                                    <span class="sub-item">Create User</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('user') ? 'active' : '' }}">
                                <a href="{{ url('user') }}">
                                    <span class="sub-item">Manage User</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Permission -->
                <li class="nav-item {{ Request::is('permission*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#permission"
                        class="{{ Request::is('permission*') ? '' : 'collapsed' }}"
                        aria-expanded="{{ Request::is('permission*') ? 'true' : 'false' }}">
                        <i class="fas fa-lock"></i>
                        <p>Permission</p>
                        <span class="caret {{ Request::is('permission*') ? 'caret-down' : 'caret-right' }}"></span>
                    </a>
                    <div class="collapse {{ Request::is('permission*') ? 'show' : '' }}" id="permission">
                        <ul class="nav nav-collapse" style="padding-left: 20px; line-height: 1">
                            <li class="{{ Request::is('permission/create') ? 'active' : '' }}">
                                <a href="{{ url('permission/create') }}">
                                    <span class="sub-item">Create Permission</span>
                                </a>
                            </li>
                            <li
                                class="{{ Request::is('permission') || Request::is('permission/*/edit') ? 'active' : '' }}">
                                <a href="{{ url('permission') }}">
                                    <span class="sub-item">Manage Permission</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Role -->
                <li class="nav-item {{ Request::is('role*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#role" class="{{ Request::is('role*') ? '' : 'collapsed' }}"
                        aria-expanded="{{ Request::is('role*') ? 'true' : 'false' }}">
                        <i class="fas fa-key"></i>
                        <p>Role</p>
                        <span class="caret {{ Request::is('role*') ? 'caret-down' : 'caret-right' }}"></span>
                    </a>
                    <div class="collapse {{ Request::is('role*') ? 'show' : '' }}" id="role">
                        <ul class="nav nav-collapse" style="padding-left: 20px; line-height: 1">
                            <li class="{{ Request::is('role/create') ? 'active' : '' }}">
                                <a href="{{ url('role/create') }}">
                                    <span class="sub-item">Create Role</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('role') || Request::is('role/*/edit') ? 'active' : '' }}">
                                <a href="{{ url('role') }}">
                                    <span class="sub-item">Manage Role</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>