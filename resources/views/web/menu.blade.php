@extends('layouts.web.app')

@section('content')
    <section>
        <div class="new-order-title d-flex justify-content-center">
            Menu
        </div>
        <div class=" container main-categories d-flex justify-content-around ">
            @foreach ($main_cat as $main)
                <a href="#{{ str_replace(' ', '', $main->name) }}-section">{{ $main->name }}</a>
            @endforeach
        </div>
        <div class="container" id="menu">
            <div class="row ">
                @foreach ($main_cat as $main)
                    <div class="col-md-6 d-flex justify-content-center" id="{{ str_replace(' ', '', $main->name) }}-sectoin"
                        style="padding: 35px;">
                        <ul>
                            <div style="margin-bottom: 30px;" class="d-flex justify-content-center"> <button
                                    class="btn btn-lg btn-info w-100">{{ $main->name }}</button> </div>
                            @foreach ($main->categories as $cat)
                                <li class="mb-4 d-flex align-items-center">
                                    <div class="item-img-div">
                                        {!! $cat->images !!}
                                    </div>
                                    <div style="display: inline-block;">
                                        <h4 class="item-title"> {{ $cat->name }} </h4>
                                        <strong class="item-price">{{ $cat->price }}$</strong>
                                    </div>
                                </li>
                            @endforeach



                        </ul>
                    </div>
                @endforeach


            </div>

        </div>
    </section>
@endsection
