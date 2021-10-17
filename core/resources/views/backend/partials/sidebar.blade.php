
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link" style="border-bottom:none">
        <span class=""></span>
        <span class="brand-text font-weight-light" style="color: black; font-family: roboto; font-weight:bold; color: green; font-style:italic; margin-left: 55px">
            <i class="fas fa-cogs fa-sm fa-fw rotate" style="font-size: 16px; color:green"></i>
            Admin <i class="fas fa-cogs fa-sm fa-fw mr-2 rotate" style="font-size: 16px; color:green"></i>
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
        <nav class="mt-2" style="min-height: 130vh;">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                     <li class="nav-item has-treeview
                        {{ ((Request::is('admin/add/question/category')) ? 'menu-open' : '') }}
                        {{ ((Request::is('admin/manage/question/category')) ? 'menu-open' : '') }}
                        {{ ((Request::is('admin/edit/question/category/*')) ? 'menu-open' : '') }}
                    ">
                    <a href="#" class="nav-link hover-color">
                        <i class="nav-icon fas fa-question" style="color: green"></i>
                        <p>
                            Question Category
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('add.question.category') }}" class="nav-link hover-color @if(request()->path() == 'admin/add/question/category') bg-success @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manage.question.category') }}" class="nav-link hover-color @if(request()->path() == 'admin/manage/question/category') bg-success @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview
                        {{ ((Request::is('admin/add/question')) ? 'menu-open' : '') }}
                        {{ ((Request::is('admin/question/category/list')) ? 'menu-open' : '') }}
                        {{ ((Request::is('admin/manage/question')) ? 'menu-open' : '') }}
                        {{ ((Request::is('admin/edit/question/*')) ? 'menu-open' : '') }}
                    ">
                    <a href="#" class="nav-link hover-color">
                        <i class="nav-icon fas fa-question" style="color: green"></i>
                        <p>
                            Questions
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('add.question') }}" class="nav-link hover-color @if(request()->path() == 'admin/add/question') bg-success @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Question</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('question.category.list') }}" class="nav-link hover-color @if(request()->path() == 'admin/question/category/list') bg-success @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Question</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="{{ route('show.survey') }}" class="nav-link hover-color @if(request()->path() == 'admin/show/survey') bg-success @endif">
                        <i class="nav-icon fas fa-box icon-color" style="color: green"></i><p>Collected Data</p>
                    </a>
                </li>
                <li class="nav-item has-treeview
                        {{ ((Request::is('admin/add/user')) ? 'menu-open' : '') }}
                        {{ ((Request::is('admin/manage/user')) ? 'menu-open' : '') }}
                        {{ ((Request::is('admin/edit/user/*')) ? 'menu-open' : '') }}
                    ">
                    <a href="#" class="nav-link hover-color">
                        <i class="nav-icon fas fa-user-astronaut" style="color: green"></i>
                        <p>
                            User / Volunteer
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('add.user') }}" class="nav-link hover-color @if(request()->path() == 'admin/add/user') bg-success @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manage.user') }}" class="nav-link hover-color @if(request()->path() == 'admin/manage/user') bg-success @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="{{ route('admin.user.track') }}" class="nav-link hover-color @if(request()->path() == 'admin/user/track') bg-success @endif">
                        <i class="nav-icon fas fa-users icon-color" style="color: green"></i><p>User Track</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Main Sidebar Container -->

