        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <span style="font-size: 20px; color: #3d3f41; font-weight: bold;">EPM System</span>
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="{{Request::is('admin') ? 'active':''}}">
                            <a href="{{ route('admin.home') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li class="has-sub {{Request::is('admin/employee*') ? 'active':''}}">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-users"></i>Employees
                                <span class="arrow {{Request::is('admin/employee*') ? 'up':''}}">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list" @if(Request::is('admin/employee*')) style="display: block;" @endif>
                                <li class="{{Request::is('admin/employee/list') ? 'active':''}}">
                                    <a href="{{ route('admin.employee.list') }}">
                                        <i class="fas fa-tasks"></i>All Employees</a>
                                </li>
                                <li class="{{Request::is('admin/employee/add') ? 'active':''}}">
                                    <a href="{{ route('admin.employee.add') }}">
                                        <i class="fas fa-plus"></i>Add New</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub {{Request::is('admin/project*') ? 'active':''}}">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Projects
                                <span class="arrow {{Request::is('admin/project*') ? 'up':''}}">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list" @if(Request::is('admin/project*')) style="display: block;" @endif>
                                <li class="{{Request::is('admin/project/list') ? 'active':''}}">
                                    <a href="{{ route('admin.project.list') }}">
                                        <i class="fas fa-tasks"></i>All Projects</a>
                                </li>
                                <li class="{{Request::is('admin/project/add') ? 'active':''}}">
                                    <a href="{{ route('admin.project.add') }}">
                                        <i class="fas fa-plus"></i>Add New</a>
                                </li>
                            </ul>
                        </li>
                        <li class="{{Request::is('admin/assignment*') ? 'active':''}}">
                            <a href="{{ route('admin.assignment.list') }}">
                                <i class="fas fa-copy"></i>Assign Projects
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>