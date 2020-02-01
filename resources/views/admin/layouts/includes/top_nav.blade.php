<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('admin_home')}}" class="nav-link">Home</a>
        </li>

    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">

            <form id="frm-logout" action="{{ route('logout') }}" method="POST" class="nav-item d-none d-sm-inline-block">
                {{ csrf_field() }}
                <button class="btn btn-info">
                    Logout
                </button>
            </form>

        </li>
    </ul>
</nav>
<!-- /.navbar -->
