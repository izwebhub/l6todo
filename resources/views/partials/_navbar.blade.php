<div id="navigation">
    <!-- Navigation Menu-->
    <ul class="navigation-menu">

        <li class="has-submenu">
            <a href="{{route('app.dashboard')}}">
                <i class="remixicon-dashboard-line"></i>Dashboard
            </a>
        </li>

        <li class="has-submenu">
            <a href="#">
                <i class="remixicon-stack-line"></i>Todos <div class="arrow-down"></div>
            </a>
            <ul class="submenu">
                <li>
                    <a href="apps-kanbanboard.html"><i class="fa fa-plus"></i> Create New</a>
                </li>
                <li>
                    <a href="apps-companies.html"><i class="fa fa-list"></i> Manage Todos</a>
                </li>
            </ul>
        </li>

        <li class="has-submenu">
            <a href="#">
                <i class="fa fa-users"></i>Users <div class="arrow-down"></div>
            </a>
            <ul class="submenu">
                <li>
                    <a href="apps-kanbanboard.html"><i class="fa fa-plus"></i> Create New</a>
                </li>
                <li>
                    <a href="apps-companies.html"><i class="fa fa-users"></i> Manage Users</a>
                </li>
            </ul>
        </li>

        <li class="has-submenu">
            <a href="#"> <i class="fe-settings noti-icon"></i>Settings <div class="arrow-down"></div></a>
            <ul class="submenu">
                <li>
                    <a href="{{route('app.categories.index')}}"><i class="fa fa-th"></i> Categories</a>
                </li>
            </ul>
        </li>



    </ul>
    <!-- End navigation menu -->

    <div class="clearfix"></div>
</div>