<header class="site-navbar js-sticky-header site-navbar-target " role="banner">
    <div class="top-bar cashier_header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <span class=" d-md-inline-block"> {{ Auth::guard('cashier')->user()->name }} </span>
                    <span class="mx-md-2 d-inline-block"></span>
                    <div class="float-right mr-2" style="background-color: #05758c74;">
                        <form id="logout-form" action="{{ route('cashier.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                        <a class="btn btn-sm btn-danger text-light" href="{{ route('cashier.logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </div>
                    <div class="float-right mr-2" style="background-color: #05758c74;">
                        <a class="btn btn-sm btn-info text-light" href={{ route('cashier.shwoonlineorders') }}>
                            Online
                        </a>
                    </div>




                </div>
            </div>
        </div>
    </div>
</header>
