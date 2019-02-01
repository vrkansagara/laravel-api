<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">Example user</span>
                        <span class="text-muted text-xs block">menu <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="{{isActiveRoute('dashboard')}}">
                <a href="{{'dashboard'}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="{{isActiveRoute('users*')}}">
                <a href="{{route('users.index')}}"><i class="fa fa-th-large"></i> <span class="nav-label">User</span></a>
            </li>
            <li>
                <a href="minor.html"><i class="fa fa-th-large"></i> <span class="nav-label">Minor view</span> </a>
            </li>
        </ul>

    </div>
</nav>
