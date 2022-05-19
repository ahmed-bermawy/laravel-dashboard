<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
    <!-- You can dynamically generate breadcrumbs here -->
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{url('/dashboard/home')}}" class="nav-link">Dashboard</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button" title="search">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form action="" method="get" class="form-inline">
                    <div class="input-group input-group-sm w-100">
                        <input class="form-control form-control-navbar" value="{!! $_GET['search'] ?? '' !!}"
                               name="search" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        {{--        Custom Search --}}
        @if(empty(request()->segment(3)))
        <li class="nav-item">
            <a class="nav-link" type="button" data-toggle="modal" data-target="#exampleModal" title="Advance Search">
                <i class="fas fa-search-plus"></i>
            </a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard/logout') }}" role="button" title="logout">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>

    </ul>
</nav>
<!-- /.navbar -->
