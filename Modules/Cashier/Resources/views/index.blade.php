@extends('cashier::layouts.master')

@section('content')
    <div class="container-fluid mt-4">
        <div id="app" class="row">
            <div class="col-md-8">
                <div class="main_and_categories_section">
                    <div class="head_main_category">
                        <a v-for=" mainCategory in MainCategoris" :href="'#' + mainCategory.name"
                            class="d-flex align-items-center head_main_category_button">
                            @{{ mainCategory.name }}</a>
                    </div>

                    <div class="card-body ov_y_scr">
                        <div v-for=" mainCategory in MainCategoris">
                            <div class="row" :id="mainCategory.name">
                                <div v-for=" (category,index) in mainCategory.categories">
                                    <button @click=" SelectCategory( category.price,category.name,category.id ,index)"
                                        v-on:click="AddToReceiptArray" class="item_button">
                                        <div class=" item_name_in_button">@{{ category.name }}</div>
                                        <div class=" item_name_in_button">@{{ category.price }} L</div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="orders_section">
                    <button class="btn btn-primary w-100" type="button" data-toggle="collapse"
                        data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        orders
                    </button>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <table class="table">
                                <thead>
                                    <tr class="orders_table_head">
                                        <th scope="col">#</th>
                                        <th scope="col"> <input placeholder="number" @change="searchnumber($event)"
                                                type="text" class="form-group search_number" name=""
                                                id="">
                                        </th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Cashier</th>
                                        <th scope="col">branch</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <label class="alert-danger" v-if=" orders == ''"> No Orders Avilable </label>
                                    <tr v-for="(order , index ) in orders">
                                        <th scope="row">@{{ ++index }}</th>
                                        <td>@{{ order.number }}</td>
                                        <td>@{{ order.total_price }}</td>
                                        <td>@{{ order.cashier.name }}</td>
                                        <td>@{{ order.branch.address }}</td>
                                        <td><button class="btn btn-sm btn-info" @click="showORdersDetails(order.id)">
                                                show</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 h-850">
                {{-- show order --}}
                <div v-if="singleOrdercategories">
                    <table class="table m-0 single-order-table">
                        <thead>
                            <tr class="single-order-table-head">
                                <th>Name</th>
                                <th>Mount</th>
                                <th>Type</th>
                                <th>Total</th>
                                <th> <button type="button" @click="clearSingleOrdercategories" class="btn btn-tool">
                                        <i class="fas fa-times text-danger"></i>
                                    </button> </th>
                            </tr>
                        </thead>
                        <tbody class="h-100-px">
                            <tr v-for="categories in singleOrdercategories">
                                <td> @{{ categories.category.name }} </td>
                                <td> <input class="w-45-px" type="number" :value="categories.mount"> </td>
                                <td>
                                    <select name="type">
                                        <option v-if="categories.category_type=='classic' " selected value="classic">
                                            classic
                                        </option>
                                        <option v-else-if="categories.category_type=='spicy' " value="classic"> classic
                                        </option>
                                        <option v-if="categories.category_type=='spicy' " selected value="classic"> spicy
                                        </option>
                                        <option v-else-if="categories.category_type=='classic' " value="classic"> spicy
                                        </option>
                                    </select>

                                </td>
                                <td><strong> @{{ categories.subtotal }}</strong></td>
                                <td>
                                    <button type="button" class="btn btn-tool">
                                        <i class="fas fa-times text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="card-header">
                        <div> Subtotal : @{{ singleOrder.total_price }} </div>
                        <div v-if="singleOrderOffer"> percentage : @{{ singleOrderOffer.percentage }}%</div>
                        <div v-if="singleOrderOffer"> discount : @{{ singleOrder.offer.discount }}</div>
                        <div> Total : @{{ singleOrder.total_price }} </div>
                    </div>
                    <div>
                        <input type="radio" v-if="singleOrder.order_type=='hall' " checked value="hall"
                            name="order_type">
                        <input type="radio" v-else-if="singleOrder.order_type=='take_away' " value="hall"
                            name="order_type">
                        <label for="">Hall</label>
                    </div>
                    <div>
                        <input type="radio" v-if="singleOrder.order_type=='take_away' " checked value="take away"
                            name="order_type">
                        <input type="radio" v-else-if="singleOrder.order_type=='hall' " value="take away"
                            name="order_type">
                        <label for="">Take Away</label>
                    </div>
                    <div class="print_receipt ">
                        <button
                            class="d-flex align-items-center justify-content-center btn text-uppercase print_receipt_button">print
                            receipt</button>
                    </div>
                </div>
                {{-- show recepit --}}
                <div v-else class="card h-100">
                    <div>
                        <div class="card-header">
                            <h6 class="card-title text-uppercase receipt-text">receipt</h6>
                            <input type="text" class="form-control h-25-px" v-model="code" placeholder="Offer Code"
                                name="" id="">
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0 w-100 ov_y_scr">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Mount</th>
                                            <th>Type</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for=" ( item , index  ) in ReceiptArray">
                                            <td>@{{ item.name }}</td>
                                            <td>
                                                <input @change=" changeMount($event,index)" class="w-40-px"
                                                    value="1" min="1" type="number" name=""
                                                    id="">
                                            </td>
                                            <td>
                                                <select @change=" changeType($event,index)" name="type"
                                                    v-bind:id="item.name">
                                                    <option value="classic" selected> classic</option>
                                                    <option value="spicy">spicy</option>
                                                </select>

                                            </td>
                                            <td><strong>@{{ item.subtotal }}</strong></td>
                                            <td>
                                                <button type="button" @click.stop="deleteFromReceiptArray(index)"
                                                    class="btn btn-tool">
                                                    <i class="fas fa-times text-danger"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="card-header">
                            <div> Subtotal :@{{ subtotal }} </div>
                            <div> percentage : @{{ offerCode.percentage }} %</div>
                            <div> Discount : @{{ offerCode.discount }} </div>
                            <div> Total : @{{ totalOrder }} </div>
                        </div>
                        <div>
                            <input type="radio" value="hall" @change="OrderTypeChange($event)" name="order_type">
                            <label for="">Hall</label>
                        </div>
                        <div><input type="radio" value="take_away" @change="OrderTypeChange($event)"
                                name="order_type"><label for="">Take Away</label>
                        </div>

                        <div class="print_receipt ">
                            <button :disabled="DisablePrintButton" @click="onComplete"
                                class="d-flex align-items-center justify-content-center btn text-uppercase print_receipt_button">print
                                receipt</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('vue')
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="{{ asset('cashier_files/js/NewOrderVue.js') }}"></script>
    @endsection
