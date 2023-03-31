@extends('layouts.web.app')

@section('content')
    <section class="container pt-4 mb-4" style="height: 500px; overflow: hidden;">
        <div class="row mt-4 h-100 ">
            <div class="col-md-8 h-100 d-flex align-items-center">
                <form class="w-100">
                    <div class="form-group w-100 d-flex justify-content-between">
                        <input style="width: 45%;" type="text" v-model="firstName" class="form-control"
                            placeholder="Enter Your First Name">
                        <input style="width: 45%;" type="text" v-model="lastName" class="form-control"
                            placeholder="Enter Your Last Name">
                    </div>
                    <div class="form-group w-100 d-flex justify-content-between">
                        <input style="width: 45%;" type="email" v-model="email" class="form-control"
                            placeholder="Enter Your Email">
                        <input style="width: 45%;" type="text" v-model="mobile" class="form-control"
                            placeholder="Enter Your Mobile">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="" id="">
                            <option value=""> General</option>
                            <option value=""> Delivery</option>
                            <option value="">Food Quality</option>
                            <option value="">Speed Of Services</option>
                            <option value="">Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="" id="" placeholder="Please enter your comments and feedback here" cols="30"
                            rows="3"></textarea>
                    </div>
                    <div>
                        <button class="btn btn-success btn-sm"> SEND NOW</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 d-flex align-items-center">
                <div class="w-100">
                    <div class="d-flex justify-content-center w-100">
                        <strong>OTHER WAYS TO CONTACT US</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-center w-100">
                        <strong>FOR VOICE AND WHATSAPP SUPPORT</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-center w-100">
                        <strong>+0201279783447</strong>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
