<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <div class="profile-image">
                        <img src="{{$user->profileImage()}}" class="rounded-circle circle-border m-b-md" alt="profile">
                    </div>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{$user->name}}</span>
                        <span class="text-muted text-xs block">Menu <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{route('force.logout')}}"><i class="fa fa-sign-out"></i> Log out</a></li>
                        <li><a class="dropdown-item" href="{{route('profile.index')}}">Profile</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="{{isActiveRoute('dashboard')}}">
                <a href="{{route('dashboard')}}"><i class="fa fa-th-large"></i> <span
                        class="nav-label">{{__('menu.dashboard')}}</span></a>
            </li>
            @can('user-view')
                <li class="{{isActiveRoute('users*')}}">
                    <a href="{{route('users.index')}}"><i class="fa fa-th-large"></i> <span
                            class="nav-label">{{__('menu.users')}}</span></a>
                </li>
            @endcan
            @can('role-view')
                <li class="{{isActiveRoute('roles*')}}">
                    <a href="{{route('roles.index')}}"><i class="fa fa-th-large"></i> <span
                            class="nav-label">{{__('menu.roles')}}</span></a>
                </li>
            @endcan
            @can('permission-view')
                <li class="{{isActiveRoute('permissions*')}}">
                    <a href="{{route('permissions.index')}}"><i class="fa fa-th-large"></i> <span
                            class="nav-label">{{__('menu.permissions')}}</span></a>
                </li>
            @endcan
            <li class="{{isActiveRoute('bootstrap*')}}">
                <a href="{{route('bootstrap.modalbox')}}"><i class="fa fa-th-large"></i> <span
                        class="nav-label">{{__('Modal Example')}}</span></a>
            </li>
        </ul>

    </div>
</nav>
