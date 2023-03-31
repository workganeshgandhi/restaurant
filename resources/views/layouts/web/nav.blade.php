    <nav id="nav" class="container mt-4 navbar navbar-expand-lg navbar-light bg-light custome-navbar" style="position: sticky !important; top: 10px ; z-index: 10;">
        <a class="nav-link text-warning" href="{{ route('index') }}"> <span class="step size-96">
            </span>@lang('trans.app name')</a>
        <!-- for responsive button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- left content -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                </li>
            </ul>
            <!-- right content -->
            <ul class="navbar-nav">

                <li class="nav-item ">
                    <a class="nav-link hvr-bounce-in" href="{{ route('menu') }}">@lang('trans.menu')</a>
                </li>
                <li class="nav-item active-navbar-link">
                    <a class="nav-link hvr-shrink" href="{{ route('newOrder') }}">@lang('trans.new order')</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link hvr-pulse" href="{{ route('about') }}">@lang('trans.about us')</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link hvr-pop" href="{{ route('contact') }}">@lang('trans.contact')</a>
                </li>

            </ul>
        </div>
    </nav>
