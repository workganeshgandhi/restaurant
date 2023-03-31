@extends('layouts.web.landingApp')

@section('content')

    <section class="landing-page" id="app">
        {{-- nav --}}
        @include('layouts.web.nav')
        <div class="h-100">
            <h1 class=" text-postion  landding-text text-uppercase animate__animated animate__backInLeft"> @lang('trans.app name')
            </h1>
        </div>
    </section>

    <section class="new-order-section">
        <!-- start of our services section -->
        <div class="new-order-title d-flex justify-content-center">
            @lang('trans.our services')
        </div>
        <div class="new-order-sub-title d-flex justify-content-center">
            @lang('trans.our services line')
        </div>
        <div class="container">
            <div class="row ">
                <div class="col-md-6 d-flex justify-content-center" style="padding: 35px;">
                    <div class="menu-card card-body">
                        <div class="d-flex justify-content-center">
                            <p class="card-title">@lang('trans.menu')</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <span class="card-desc">@lang('trans.menu line')</span>
                        </div>
                        <div class="d-flex justify-content-center d-flex align-items-end">
                            <a href="#menu" class="btn cards-btn hvr-push">@lang('trans.view menu')</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center" style="padding: 35px;">
                    <div class="menu-card card-body">
                        <div class="d-flex justify-content-center">
                            <p class="card-title">@lang('trans.new order')</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <span class="card-desc">@lang('trans.make an order')</span>
                        </div>
                        <div class="d-flex justify-content-center d-flex align-items-end">
                            <a href="{{ route('newOrder') }}" class="btn cards-btn hvr-push">@lang('trans.make an order')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of our services section -->
        <!-- start of menu section -->
        <div class="new-order-title d-flex justify-content-center">
            @lang('trans.menu')
        </div>
        <div class="new-order-sub-title d-flex justify-content-center">
            @lang('trans.menu line')
        </div>
        <div class="container" id="menu">
            <div class="row ">
                <div class="col-md-6 d-flex justify-content-center" style="padding: 35px;">
                    <ul>
                        @foreach ($menu as $index=>$item)
                        @if ($index < 4 )
                        <li class="mb-4 d-flex align-items-center">
                            <div class="item-img-div">
                               {!!$item->images!!}
                            </div>
                            <div style="display: inline-block;">
                                <h4 class="item-title"> {{$item->name}} </h4>
                                <strong class="item-price">{{$item->price}} LE</strong>
                            </div>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6 d-flex justify-content-center" style="padding: 35px;">
                    <ul>
                        @foreach ($menu as $index=>$item)
                        @if ( $index > 3 && $index < 8  )
                        <li class="mb-4 d-flex align-items-center">
                            <div class="item-img-div">
                               {!!$item->images!!}
                            </div>
                            <div style="display: inline-block;">
                                <h4 class="item-title"> {{$item->name}} </h4>
                                <strong class="item-price">{{$item->price}} LE</strong>
                            </div>
                        </li>
                        @endif
                        @endforeach

                    </ul>
                </div>
            </div>

            <div class=" d-flex justify-content-center">
                <div class="">
                    <a href="{{ route('menu') }}" class="btn full-menu-btn btn-lg hvr-push">@lang('trans.full menu')</a>
                </div>
            </div>
        </div>
        <!-- end of menu section -->
    </section>
    <!-- start of about Us  -->
    <section class="about-us-sec">
        <div class="new-order-title d-flex justify-content-center">
            @lang('trans.about us')
        </div>
        <div class="new-order-sub-title  d-flex justify-content-center">
            @lang('trans.about us line')

        </div>
        <div class="container">
            <div class="row d-flex justify-content-around">
                <div class="col-md-6 d-flex justify-content-center" style="padding: 35px;">
                    <div class="contact-card card-body">
                        <div class="d-flex justify-content-center">
                            <p class="card-title">@lang('trans.contact')</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <span class="card-desc">@lang('trans.contact line')</span>
                        </div>
                        <div class="d-flex justify-content-center d-flex align-items-end">
                            <a href="{{ route('contact') }}"
                                style=" {{ app()->getLocale() == 'ar' ? 'font-weight: bold' : '' }}"
                                class="btn cards-btn hvr-push">@lang('trans.contact')</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center" style="padding: 35px;">
                    <div class="find-resturant-card card-body">
                        <div class="d-flex justify-content-center">
                            <p class="card-title">@lang('trans.find restaurant')</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <span class="card-desc"> @lang('trans.find restaurant line ') </span>
                        </div>
                        <div class="d-flex justify-content-center d-flex align-items-end">
                            <a href="{{ route('about') }}"
                                style=" {{ app()->getLocale() == 'ar' ? 'font-weight: bold' : '' }}"
                                class="btn cards-btn hvr-push">@lang('trans.find restaurant')</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center" style="padding: 35px;">
                    <div class="rate-card card-body">
                        <div class="d-flex justify-content-center">
                            <p class="card-title">@lang('trans.rate now')</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <span class="card-desc">@lang('trans.rate now line') </span>
                        </div>
                        <div class="d-flex justify-content-center d-flex align-items-end">
                            <a href="{{ route('contact') }}"
                                style=" {{ app()->getLocale() == 'ar' ? 'font-weight: bold' : '' }}"
                                class="btn cards-btn hvr-push">@lang('trans.rate now')</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center" style="padding: 35px;">
                    <div class="team-card card-body">
                        <div class="d-flex justify-content-center">
                            <p class="card-title">@lang('trans.restaurant team')</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <span class="card-desc">@lang('trans.team line')</span>
                        </div>
                        <div class="d-flex justify-content-center d-flex align-items-end">
                            <a href="{{ route('menu') }}"
                                style=" {{ app()->getLocale() == 'ar' ? 'font-weight: bold' : '' }}"
                                class="btn cards-btn hvr-push">
                                @lang('trans.view menu')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of about us  -->


@endsection
