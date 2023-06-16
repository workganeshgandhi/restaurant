<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
        <img src="{{ asset('manager_files/dist/img/Manager.jpg') }}" width="50px" height="50px" alt="Manager Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Paradise</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('manager_files/dist/img/user2-160x160.jpg') }}" width="50px" height="50px"  class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('manager.home') }}" class="d-block">Dashboard Home
                </a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <!-- Supervisor -->
                <li class="nav-item ">
                    <a href="{{ route('supervisor.index') }}"
                        class="nav-link {{ Request::route()->getPrefix() === 'managerDashboard/supervisor' ? 'active' : '' }} ">
                        <img src="{{ asset('manager_files/dist/img/supervisor.png') }}" width="25px" height="25px"
                            alt="">
                        <p>
                            Supervisor
                        </p>
                    </a>
                </li>
                <!-- Cookr -->
                <li class="nav-item">
                    <a href="{{ route('chef.index') }}"
                        class="nav-link {{ Request::route()->getPrefix() === 'managerDashboard/chef' ? 'active' : '' }} ">
                        <img src="{{ asset('manager_files/dist/img/chef.png') }}" width="25px" height="25px"
                            alt="">
                        <p>
                            Chef
                        </p>
                    </a>
                </li>
                <!-- Assistant Cooks -->
                <li class="nav-item ">
                    <a href="{{ route('chefassistant.index') }}"
                        class="nav-link {{ Request::route()->getPrefix() === 'managerDashboard/chefassistant' ? 'active' : '' }} ">
                        <img src="{{ asset('manager_files/dist/img/chefasses.png') }}" width="25px" height="25px"
                            alt="">
                        <p>
                            Chef Assistants

                        </p>
                    </a>
                </li>
                <!-- cashier -->
                <li class="nav-item ">
                    <a href="{{ route('cashier.index') }}"
                        class="nav-link {{ Request::route()->getPrefix() === 'managerDashboard/cashier' ? 'active' : '' }} ">
                        <img src="{{ asset('manager_files/dist/img/cashier.png') }}" width="25px" height="25px"
                            alt="">
                        <p>
                            Cashier

                        </p>
                    </a>
                </li>
                <!-- waiter -->
                <li class="nav-item ">
                    <a href="{{ route('waiter.index') }}"
                        class="nav-link {{ Request::route()->getPrefix() === 'managerDashboard/waiter' ? 'active' : '' }} ">
                        <img src="{{ asset('manager_files/dist/img/waiter.png') }}" width="25px" height="25px"
                            alt="">
                        <p>
                            Waiter

                        </p>
                    </a>
                </li>
                <!-- delivery boy -->
                <li class="nav-item ">
                    <a href="{{ route('deliveryboy.index') }}"
                        class="nav-link {{ Request::route()->getPrefix() === 'managerDashboard/deliveryboy' ? 'active' : '' }} ">
                        <img src="{{ asset('manager_files/dist/img/delivery boy.png') }}" width="30px" height="30px"
                            alt="">
                        <p>
                            Delivery Boy
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
