<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/dashboard/home') }}" class="brand-link">
        <img src="{{ asset('img/dashboard/brand.png') }}" alt="Incubator" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ 'Incubator' }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (!empty(Auth::user()->image))
                    <img src="{{ url('uploads/admin/' . auth()->user()->image) }}" class="img-circle elevation-2"
                         alt="User Image"/>
                @else
                    <img src="{{ asset('img/dashboard/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->first_name . Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">DASHBOARD</li>
                <li
                    class="nav-item {{ Request::segment(2) == 'admins' || Request::segment(2) == 'roles' || Request::segment(2) == 'permissions' ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Administrator
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"></span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('admin-view')
                            <li class="nav-item">
                                <a href="{{ url('/dashboard/admins') }}"
                                   class="nav-link {{ Request::segment(2) == 'admins' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Admins </p>
                                </a>
                            </li>
                        @endcan
                        @can('role-view')
                            <li class="nav-item">
                                <a href="{{ url('/dashboard/roles') }}"
                                   class="nav-link {{ Request::segment(2) == 'roles' ? 'active' : '' }}">
                                    <i class="fab fa-critical-role"></i>
                                    <p> Roles </p>
                                </a>
                            </li>
                        @endcan
                        @can('permission-view')
                            <li class="nav-item">
                                <a href="{{ url('/dashboard/permissions') }}"
                                   class="nav-link {{ Request::segment(2) == 'permissions' ? 'active' : '' }}">
                                    <i class="fab fa-critical-role"></i>
                                    <p> Permissions </p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <li
                    class="nav-item {{ Request::segment(2) == 'backendproducts' ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Products
                            <i class="fas fa-angle-left right"></i>
{{--                            <i class="fas fa-store right"></i>--}}


                            <span class="badge badge-info right"></span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('backendproduct-view')
                            <li class="nav-item">
                                <a href="{{ url('/dashboard/backendproducts') }}"
                                   class="nav-link {{ Request::segment(2) == 'backendproducts' ? 'active' : '' }}">
                                    <i class="fab fa-product-hunt"></i>
                                    <p> Products </p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
