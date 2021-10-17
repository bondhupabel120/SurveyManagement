<nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <button type="button" class="navbar-toggle collapsed" style="border:none; margin-top: 7px;">
                <a class="nav-link" data-widget="pushmenu" href="javascript:void(0);" role="button">

                    <!-- <i class="fas fa-bars"></i> -->
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-bar"></span>
                    <span class="icon-bar middle-bar"></span>
                    <span class="icon-bar bottom-bar"></span>
                </a>
            </button>
        </li>
        <li class="nav-item">
            <div class="headerLogo">
                <a class="navbar-brand" href="{{ route('user.dashboard') }}">
                    <img src="{{ asset('assets/backend/img/pharmacy_logo.png') }}" alt="Pharmacy" style="height: 50px;max-width: 100px">
                </a>
                <form action="javascript:void(0);">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" style="display: flex;align-items: center;"
               aria-haspopup="true" aria-expanded="false">

                <span class="ml-2 d-none d-lg-inline text-black-50 small pr-2" style="font-size: 18px">{{ Auth::guard('web')->user()->first_name }}</span>
                @if (Auth::guard('web')->user()->image)
                    <img class="img-profile rounded-circle" style="height: 40px;width: 40px;border-radius: 50%" src="{{ asset(Auth::guard('web')->user()->image) }}" alt="Image">
                @else
                <img class="img-profile rounded-circle" style="height: 40px;width: 40px;border-radius: 50%" src="https://www.pngfind.com/pngs/m/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.png">
                @endif
                <b class="fa fa-angle-down pl-2"></b>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('user.profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="{{ route('user.change.password') }}">
                    <i class="fas fa-passport fa-sm fa-fw mr-2 text-gray-400"></i>
                    Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelLogout">Logout!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to logout?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                <a href="{{ route('user.logout') }}" class="btn btn-primary">
                    {{ __('Logout') }}
                </a>
            </div>
        </div>
    </div>
</div>
