<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <span style="font-size: 25px; color: #3d3f41; font-weight: bold;">CIT Admin</span>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                @if (has_menu('dashboard'))
                    <li class="{{ Request::is('admin') ? 'active' : '' }}">
                        <a href="{{ route('admin.home') }}">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                        </a>
                    </li>
                @endif
                @if (has_menu('c_sales'))
                    <li class="has-sub {{ Request::is('admin/sales*') ? 'active' : '' }}">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-shopping-cart"></i>Sales
                            <span class="arrow {{ Request::is('admin/sales*') ? 'up' : '' }}">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list"
                            @if (Request::is('admin/sales*')) style="display: block;" @endif>
                            @if (has_access('sales'))
                                <li class="{{ Request::is('admin/sales/list') ? 'active' : '' }}">
                                    <a href="{{ route('admin.sales.list') }}">
                                        <i class="fas fa-tasks"></i>All Sales</a>
                                </li>
                            @endif
                            @if (has_access('products'))
                                <li class="{{ Request::is('admin/sales/product/add') ? 'active' : '' }}">
                                    <a href="{{ route('admin.sales.product.list') }}">
                                        <i class="fas fa-plus"></i>Products</a>
                                </li>
                            @endif
                            @if (has_access('product_plans'))
                                <li class="{{ Request::is('admin/sales/product-plan/add') ? 'active' : '' }}">
                                    <a href="{{ route('admin.sales.productplan.list') }}">
                                        <i class="fas fa-plus"></i>Product Plans</a>
                                </li>
                            @endif
                            @if (has_access('categories'))
                                <li class="{{ Request::is('admin/sales/category/add') ? 'active' : '' }}">
                                    <a href="{{ route('admin.sales.category.list') }}">
                                        <i class="fas fa-plus"></i>Categories</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (has_menu('user_roles'))
                    <li class="has-sub {{ Request::is('admin/role*') ? 'active' : '' }}">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-puzzle-piece"></i>User Roles
                            <span class="arrow {{ Request::is('admin/role*') ? 'up' : '' }}">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list"
                            @if (Request::is('admin/role*')) style="display: block;" @endif>
                            @if (has_access('user_list_view'))
                                <li class="{{ Request::is('admin/role/user-list') ? 'active' : '' }}">
                                    <a href="{{ route('admin.role.userList') }}">
                                        <i class="fas fa-tasks"></i>Users</a>
                                </li>
                            @endif
                            @if (has_access('role_list_view'))
                                <li
                                    class="{{ Request::is('admin/role/list') ? 'active' : '' }}{{ Request::is('admin/role/edit-role-access/*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.role.list') }}">
                                        <i class="fas fa-tasks"></i>Roles & Permissions</a>
                                </li>
                            @endif
                            @if (has_access('menu_head_list_view'))
                                <li
                                    class="{{ Request::is('admin/role/menu-head-list') ? 'active' : '' }}{{ Request::is('admin/role/menu-head-edit/*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.role.menuHeadList') }}">
                                        <i class="fas fa-tasks"></i>Menu Heads</a>
                                </li>
                            @endif
                            @if (has_access('menu_list_view'))
                                <li
                                    class="{{ Request::is('admin/role/menu-list') ? 'active' : '' }}{{ Request::is('admin/role/menu-edit/*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.role.menuList') }}">
                                        <i class="fas fa-tasks"></i>Menus</a>
                                </li>
                            @endif
                            @if (has_access('create_role'))
                                <li class="{{ Request::is('admin/role/add') ? 'active' : '' }}">
                                    <a href="{{ route('admin.role.add') }}">
                                        <i class="fas fa-plus"></i>Add New Role</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (has_menu('employees'))
                    <li class="has-sub {{ Request::is('admin/employee*') ? 'active' : '' }}">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-users"></i>Employees
                            <span class="arrow {{ Request::is('admin/employee*') ? 'up' : '' }}">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list"
                            @if (Request::is('admin/employee*')) style="display: block;" @endif>
                            @if (has_access('employee_list_view'))
                                <li class="{{ Request::is('admin/employee/list') ? 'active' : '' }}">
                                    <a href="{{ route('admin.employee.list') }}">
                                        <i class="fas fa-tasks"></i>All Employees</a>
                                </li>
                            @endif
                            @if (has_access('create_employee'))
                                <li class="{{ Request::is('admin/employee/add') ? 'active' : '' }}">
                                    <a href="{{ route('admin.employee.add') }}">
                                        <i class="fas fa-plus"></i>Add New</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (has_menu('branches'))
                    <li class="has-sub {{ Request::is('admin/branch*') ? 'active' : '' }}">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-users"></i>Braches
                            <span class="arrow {{ Request::is('admin/branch*') ? 'up' : '' }}">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list"
                            @if (Request::is('admin/branch*')) style="display: block;" @endif>
                            @if (has_access('branch_list_view'))
                                <li class="{{ Request::is('admin/branch/list') ? 'active' : '' }}">
                                    <a href="{{ route('admin.branch.list') }}">
                                        <i class="fas fa-tasks"></i>All Branches</a>
                                </li>
                            @endif
                            @if (has_access('create_branch'))
                                <li class="{{ Request::is('admin/branch/add') ? 'active' : '' }}">
                                    <a href="{{ route('admin.branch.add') }}">
                                        <i class="fas fa-plus"></i>Add New</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (has_menu('projects'))
                    <li class="has-sub {{ Request::is('admin/project*') ? 'active' : '' }}">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-copy"></i>Projects
                            <span class="arrow {{ Request::is('admin/project*') ? 'up' : '' }}">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list"
                            @if (Request::is('admin/project*')) style="display: block;" @endif>
                            @if (has_access('project_list_view'))
                                <li class="{{ Request::is('admin/project/list') ? 'active' : '' }}">
                                    <a href="{{ route('admin.project.list') }}">
                                        <i class="fas fa-tasks"></i>All Projects</a>
                                </li>
                            @endif
                            @if (has_access('create_project'))
                                <li class="{{ Request::is('admin/project/add') ? 'active' : '' }}">
                                    <a href="{{ route('admin.project.add') }}">
                                        <i class="fas fa-plus"></i>Add New</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (has_menu('project_assignment'))
                    <li class="has-sub {{ Request::is('admin/assignment*') ? 'active' : '' }}">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-download"></i>Assign Project
                            <span class="arrow {{ Request::is('admin/assignment*') ? 'up' : '' }}">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list"
                            @if (Request::is('admin/assignment*')) style="display: block;" @endif>
                            @if (has_access('assigned_tasks_list_view'))
                                <li class="{{ Request::is('admin/assignment/list') ? 'active' : '' }}">
                                    <a href="{{ route('admin.assignment.list') }}">
                                        <i class="fas fa-tasks"></i>Assign Project</a>
                                </li>
                            @endif
                            @if (has_access('employee_problem_list'))
                                <li class="{{ Request::is('admin/assignment/problem-list') ? 'active' : '' }}">
                                    <a href="{{ route('admin.assignment.problemIndex') }}">
                                        <i class="fas fa-exclamation-circle"></i>Problem list</a>
                                </li>
                            @endif



                            @if (has_access('view_solution'))
                                <li class="{{ Request::is('admin/assignment/solution-list') ? 'active' : '' }}">
                                    <a href="{{ route('admin.assignment.soluitonIndex') }}">
                                        <i class="fas fa-exclamation-circle"></i>User Solution list</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                {{-- @if (has_menu('project_assignment'))
                <li class="{{Request::is('admin/assignment*') ? 'active':''}}">
                    <a href="{{ route('admin.assignment.list') }}">
                        <i class="fas fa-download"></i>Assign Projects
                    </a>
                </li>
                @endif --}}

                @if (has_menu('customer'))
                    <li class="has-sub {{ Request::is('admin/customer*') ? 'active' : '' }}">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-download"></i>Customers
                            <span class="arrow {{ Request::is('admin/customer*') ? 'up' : '' }}">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list"
                            @if (Request::is('admin/customer*')) style="display: block;" @endif>
                            @if (has_access('customer'))
                                <li class="{{ Request::is('admin/customer/list') ? 'active' : '' }}">
                                    <a href="{{ route('admin.customer.index') }}">
                                        <i class="fas fa-tasks"></i>All Customer</a>
                                </li>
                            @endif
                            @if (has_access('customer'))
                                <li class="{{ Request::is('admin/customer/customer-query-list') ? 'active' : '' }}">
                                    <a href="{{ route('admin.customer.customerQueryList') }}">
                                        <i class="fas fa-tasks"></i>All Customer Queries</a>
                                </li>
                            @endif


                        </ul>
                    </li>
                @endif
                {{-- @if (has_access('view_customer')) --}}
                {{-- <li class="{{ Request::is('admin/site-info/index') ? 'active' : '' }}">
                    <a href="{{ route('admin.site-info.index') }}">
                        <i class="fas fa-tasks"></i>Site Infos</a>
                </li>

                <li class="{{ Request::is('admin/service/index') ? 'active' : '' }}">
                    <a href="{{ route('admin.service.index') }}">
                        <i class="fas fa-tasks"></i>Our Service</a>
                </li>
                <li class="{{ Request::is('admin/social-link/index') ? 'active' : '' }}">
                    <a href="{{ route('admin.social-link.index') }}">
                        <i class="fas fa-tasks"></i>Social Link</a>
                </li>
                <li class="{{ Request::is('admin/testimonial/list') ? 'active' : '' }}">
                    <a href="{{ route('admin.testimonial.index') }}">
                        <i class="fas fa-tasks"></i>Testimonial</a>
                </li>
                <li class="{{ Request::is('admin/industry-serve/index') ? 'active' : '' }}">
                    <a href="{{ route('admin.industry-serve.index') }}">
                        <i class="fas fa-tasks"></i>Industry We Serve</a>
                </li> --}}

                {{-- @endif --}}

                <li
                    class="has-sub
                {{ Request::is('admin/site-info/index') ||
                Request::is('admin/service/index') ||
                Request::is('admin/social-link/index') ||
                Request::is('admin/testimonial/list') ||
                Request::is('admin/industry-serve/index') ||
                Request::is('admin/our-achive/form') ||
                Request::is('admin/terms-and-condition/index') ||
                Request::is('admin/cookie-policy/index') ||
                Request::is('admin/privacy-policy/index') ||
                Request::is('admin/about/index') ||
                Request::is('admin/our-client/index') ||
                Request::is('admin/career/index') ||
                Request::is('admin/our-team/index') ||
                Request::is('admin/banner/index') ||
                Request::is('admin/blog/index') ||
                Request::is('admin/technology/index') ||
                Request::is('admin/why-choose-us/index')
                    ? 'active'
                    : '' }}">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-download"></i>Website Settings
                        <span
                            class="arrow {{ Request::is('admin/site-info/index') ||
                            Request::is('admin/service/index') ||
                            Request::is('admin/social-link/index') ||
                            Request::is('admin/testimonial/list') ||
                            Request::is('admin/industry-serve/index') ||
                            Request::is('admin/our-achive/form') ||
                            Request::is('admin/terms-and-condition/index') ||
                            Request::is('admin/cookie-policy/index') ||
                            Request::is('admin/privacy-policy/index') ||
                            Request::is('admin/about/index') ||
                            Request::is('admin/our-client/index') ||
                            Request::is('admin/career/index') ||
                            Request::is('admin/our-team/index') ||
                            Request::is('admin/banner/index') ||
                            Request::is('admin/blog/index') ||
                            Request::is('admin/technology/index') ||
                            Request::is('admin/why-choose-us/index')
                                ? 'up'
                                : '' }}">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list"
                        @if (Request::is('admin/site-info/index') ||
                                Request::is('admin/service/index') ||
                                Request::is('admin/social-link/index') ||
                                Request::is('admin/testimonial/list') ||
                                Request::is('admin/industry-serve/index') ||
                                Request::is('admin/terms-and-condition/index') ||
                                Request::is('admin/cookie-policy/index') ||
                                Request::is('admin/privacy-policy/index') ||
                                Request::is('admin/our-achive/form') ||
                                Request::is('admin/about/index') ||
                                Request::is('admin/our-client/index') ||
                                Request::is('admin/career/index') ||
                                Request::is('admin/our-team/index') ||
                                Request::is('admin/banner/index') ||
                                Request::is('admin/blog/index') ||
                                Request::is('admin/technology/index') ||
                                Request::is('admin/why-choose-us/index')) style="display: block;" @endif>

                        <li class="{{ Request::is('admin/banner/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.banner.index') }}">
                                <i class="fas fa-tasks"></i>Banner</a>
                        </li>
                        <li class="{{ Request::is('admin/about/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.about.index') }}">
                                <i class="fas fa-tasks"></i>About</a>
                        </li>
                        <li class="{{ Request::is('admin/about/who-we-are') ? 'active' : '' }}">
                            <a href="{{ route('admin.about.whoWeAre') }}">
                                <i class="fas fa-tasks"></i>About Who We Are</a>
                        </li>
                        <li class="{{ Request::is('admin/about/our-vision') ? 'active' : '' }}">
                            <a href="{{ route('admin.about.ourVision') }}">
                                <i class="fas fa-tasks"></i>About Our Vision</a>
                        </li>
                        <li class="{{ Request::is('admin/about/our-mision') ? 'active' : '' }}">
                            <a href="{{ route('admin.about.ourMision') }}">
                                <i class="fas fa-tasks"></i>About Our Mision</a>
                        </li>
                        {{-- <li class="{{ Request::is('admin/about/ourVisionItem') ? 'active' : '' }}">
                            <a href="{{ route('admin.about.ourVisionItem') }}">
                                <i class="fas fa-tasks"></i>Our Vision Item</a>
                        </li>
                        <li class="{{ Request::is('admin/about/ourMisionItem') ? 'active' : '' }}">
                            <a href="{{ route('admin.about.ourMisionItem') }}">
                                <i class="fas fa-tasks"></i>Our Mision Item</a>
                        </li> --}}
                        <li class="{{ Request::is('admin/site-info/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.site-info.index') }}">
                                <i class="fas fa-tasks"></i>Site Infos</a>
                        </li>


                        <li class="{{ Request::is('admin/service/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.service.index') }}">
                                <i class="fas fa-tasks"></i>Our Service</a>
                        </li>
                        <li class="{{ Request::is('admin/social-link/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.social-link.index') }}">
                                <i class="fas fa-tasks"></i>Social Link</a>
                        </li>
                        <li class="{{ Request::is('admin/testimonial/list') ? 'active' : '' }}">
                            <a href="{{ route('admin.testimonial.index') }}">
                                <i class="fas fa-tasks"></i>Testimonial</a>
                        </li>
                        <li class="{{ Request::is('admin/industry-serve/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.industry-serve.index') }}">
                                <i class="fas fa-tasks"></i>Industry We Serve</a>
                        </li>
                        <li class="{{ Request::is('admin/technology/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.technology.index') }}">
                                <i class="fas fa-tasks"></i>technology</a>
                        </li>
                        <li class="{{ Request::is('admin/our-achive/form') ? 'active' : '' }}">
                            <a href="{{ route('admin.our-achive.form') }}">
                                <i class="fas fa-edit"></i>Our Achive
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/terms-and-condition/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.terms-and-condition.index') }}">
                                <i class="fas fa-edit"></i>Terms And Conditions
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/cookie-policy/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.cookie-policy.index') }}">
                                <i class="fas fa-edit"></i>Cookie Policy
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/privacy-policy/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.privacy-policy.index') }}">
                                <i class="fas fa-edit"></i>Privacy Policy
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/our-client/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.our-client.index') }}">
                                <i class="fas fa-edit"></i>Our Client
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/career/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.career.index') }}">
                                <i class="fas fa-edit"></i>career
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/why-choose-us/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.why-choose-us.index') }}">
                                <i class="fas fa-edit"></i>Why Choose Us
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/blog/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.blog.index') }}">
                                <i class="fas fa-edit"></i>Blogs
                            </a>
                        </li>
                        <li
                            class="{{ Request::is('admin/our-team/index') || Request::is('admin/our-team/create') ? 'active' : '' }}">
                            <a href="{{ route('admin.our-team.index') }}">
                                <i class="fas fa-edit"></i>Our Team
                            </a>
                        </li>



                    </ul>
                </li>





                @if (has_menu('project_reports'))
                    <li class="{{ Request::is('admin/report*') ? 'active' : '' }}">
                        <a href="{{ route('admin.report.list') }}">
                            <i class="fas fa-edit"></i>Project Reports
                        </a>
                    </li>
                @endif


            </ul>
        </nav>
    </div>
</aside>
