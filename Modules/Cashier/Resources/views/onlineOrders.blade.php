@extends('cashier::layouts.master')

@section('content')
    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-md-8 table-responsive-sm" style="height: 600px">
                <div style="height: 45% ; overflow-y: scroll">
                    <table class="table">
                        <thead style="position: sticky ; top: 0px ;" class="bg-info">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"><input placeholder="number" type="text"
                                        @change="searchNullableNumberMethod($event)"
                                        style="margin: 0px; max-width: 72px; min-width: 65px" class="form-group"></th>
                                <th scope="col">name</th>
                                <th scope="col">mobile</th>
                                <th scope="col">address</th>
                                <th scope="col">status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="data">
                            <tr v-for=" (order,index) in nullableorders">
                                <th scope="row">@{{ index }}</th>
                                <td>@{{ order.number }}</td>
                                <td>@{{ order.name }}</td>
                                <td>@{{ order.mobile }}</td>
                                <td>@{{ order.address }}</td>
                                <td>@{{ order.status }}</td>
                                <td>
                                    <button @click="showsingilorder(order)" type="button" class="btn btn-primary">
                                        show
                                    </button>
                                </td>

                            </tr>
                            <tr v-for=" (order,index) in eventOrder ">
                                <th scope="row">@{{ index }}</th>
                                <td>@{{ order.number }}</td>
                                <td>@{{ order.name }}</td>
                                <td>@{{ order.mobile }}</td>
                                <td>@{{ order.address }}</td>
                                <td>@{{ order.status }}</td>
                                <td>
                                    <button @click="showsingilorder(order)" type="button" class="btn btn-primary">
                                        show
                                    </button>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
                <div style="height: 45% ; overflow-y: scroll">
                    <table class="table">
                        <thead style="position: sticky ; top: 0px ;" class="bg-info">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"><input placeholder="number" type="text"
                                        @change="searchOrderNumberMethod($event)"
                                        style="margin: 0px; max-width: 72px; min-width: 65px" class="form-group"
                                        name="" id=""></th>
                                <th scope="col">name</th>
                                <th scope="col">mobile</th>
                                <th scope="col">address</th>
                                <th scope="col">status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="data">
                            <tr v-for=" (order,index) in orders">
                                <th scope="row">@{{ index }}</th>
                                <td>@{{ order.number }}</td>
                                <td>@{{ order.name }}</td>
                                <td>@{{ order.mobile }}</td>
                                <td>@{{ order.address }}</td>
                                <td class="text-center" v-if="order.status=='accepted'"><i
                                        class="fas fa-check-square text-success"></i></td>
                                <td class="text-center" v-if="order.status=='declined'"><i
                                        class="fas fa-times-circle text-danger"></i></td>
                                <td>
                                    <button @click="showsingilorder(order)" type="button" class="btn btn-primary">
                                        show
                                    </button>
                                </td>

                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="card text-center">
                    <div class="card-header" style="text-align: left">
                        <div>
                            <label for=""> name : <strong>@{{ singleOrder.name }}</strong> </label>
                        </div>
                        <div>
                            <label for=""> mobile : <strong> @{{ singleOrder.mobile }}</strong> </label>
                        </div>
                        <div>
                            <label for=""> address : <strong>@{{ singleOrder.address }}</strong> </label>
                        </div>
                        <div>
                            <label for=""> offer : <strong> new year</strong> </label>
                        </div>
                    </div>
                    <div class="card-body" style="overflow-y:scroll; height:270px; ">
                        <table class="table">
                            <thead class="bg-info" style="position: sticky ; top: -21px ;">
                                <tr>
                                    <th scope="col">name</th>
                                    <th scope="col">type</th>
                                    <th scope="col">mount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for=" categories in singleOrder.delivery_order_categories">
                                    <td>@{{ categories.category.name }}</td>
                                    <td>@{{ categories.category_type }}</td>
                                    <td>@{{ categories.mount }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="alert-danger" @disabled(selecteDeliveryBoyValidation)> you should select deleivery boy </div>
                            <select @change="selecteDeliveryBoy" class="custom-select">
                                <option value="">Select Delivery Boy</option>
                                <option v-for="deliveryBoy in deliveryBoys" :value='deliveryBoy.id'
                                    :selected="singleOrder.delivery_boy_id == deliveryBoy.id ? true : false">
                                    @{{ deliveryBoy.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-muted ">
                        <div class="row">
                            <div class="col-md-6">
                                <button :disabled='isOrderReady' value="accepted" class="btn btn-success btn-lg w-100 h-100"
                                    @click="updateorder(singleOrder,$event)">Accept</button>
                            </div>
                            <div class="col-md-6">
                                <button @click="updateorder(singleOrder,$event)" value="declined"
                                    class="btn btn-danger btn-lg w-100 h-100">Decline</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="{{ mix('js/app.js') }}"></script>

    <script>
        // window.Echo.channel('EventOrder')
        //     .listen('OrderEvent', (e) => {
        //         $('#data').append("<tr><th>3</th><td>" + e.message['number'] + "</td><td>" + e.message[
        //                 'name'] + "</td> <td>" + e.message['mobile'] + "</td><td>" + e.message['address'] +
        //             "</td> <td></td> <td><button onclick='showsingilorder("+e.message +")' type='button' class='btn btn-primary'>show</button></td> </tr>"
        //         );
        //     })
    </script>
@endsection
@section('vue')
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src="{{ asset('cashier_files/js/OnlineOrders.js') }}"></script>
@endsection
