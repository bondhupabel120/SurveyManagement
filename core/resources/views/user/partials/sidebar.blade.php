
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('user.dashboard') }}" class="brand-link" style="border-bottom:none">
        <span class=""></span>
        <span class="brand-text font-weight-light" style="color: black; font-family: roboto; font-weight:bold; color: green; font-style:italic; margin-left: 55px">
            <i class="fas fa-cogs fa-sm fa-fw rotate" style="font-size: 16px; color:green"></i>
            User <i class="fas fa-cogs fa-sm fa-fw mr-2 rotate" style="font-size: 16px; color:green"></i>
        </span>
    </a>

    <style>
        .hover-color:hover{
            background-color: green!important;
            color: white!important;
        }
        .hover-color:hover i,
        .hover-color:hover p{
            color: white!important;
        }
    </style>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border: none">
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview ">
                    <a href="{{ route('start.survey') }}" class="nav-link hover-color @if(request()->path() == 'user/start/survey') bg-success @endif">
                        <i class="nav-icon fas fa-box icon-color" style="color: green"></i><p>Start Survey</p>
                    </a>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="{{ route('user.collected.data') }}" class="nav-link hover-color @if(request()->path() == 'user/collected/data') bg-success @endif">
                        <i class="nav-icon fas fa-box icon-color" style="color: green"></i><p>Collected Data</p>
                    </a>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="{{ route('user.profile') }}" class="nav-link hover-color @if(request()->path() == 'user/profile') bg-success @endif">
                        <i class="nav-icon fas fa-user icon-color" style="color: green"></i><p>Profile</p>
                    </a>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="{{ route('user.logout') }}" class="nav-link hover-color">
                        <i class="nav-icon fas fa-lock icon-color" style="color: green"></i><p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Main Sidebar Container -->

