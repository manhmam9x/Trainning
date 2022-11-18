<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Mam</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Manh</b>Mam</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset(Auth::user()->avatar) }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset(Auth::user()->avatar)}}" class="img-circle" alt="User Image">
                            <p>
                                {{ Auth::user()->name }}
                                <small>{{Auth::user()->created_at->format('d-m-Y') }}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('admin.user.edit', ['user' => Auth::user()->id]) }}" class="btn btn-default btn-flat">Thông Tin</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">Đăng Xuất</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
