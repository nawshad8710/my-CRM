        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <span style="font-size: 20px; color: #3d3f41; font-weight: bold;">EPM System</span>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li class="{{Request::is('admin') ? 'active':''}}">
                            <a href="{{ route('employee.home') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li class="{{Request::is('employee/assignment*') ? 'active':''}}">
                            <a href="{{ route('employee.assignment.list') }}">
                                <i class="fas fa-copy"></i>Assigned Projects
                            </a>
                        </li>
                        <li class="{{Request::is('employee/report*') ? 'active':''}}">
                            <a href="{{ route('employee.report.list') }}">
                                <i class="fas fa-edit"></i>Project Reports
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>