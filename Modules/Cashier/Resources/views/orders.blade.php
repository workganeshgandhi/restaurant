@extends('cashier::layouts.master')

@section('content')
    <div class="container-fluid mt-4">
        <div id="app" class="row">
            <div class="col-md-8">
                <div class="orders_section">
                    <table class="table">
                        <thead>
                            <tr class="orders_table_head">
                                <th scope="col">#</th>
                                <th scope="col"> <input placeholder="number" @change="searchnumber($event)" type="text"
                                        class="form-group search_number" name="" id="">
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
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a @click="prevPageMethod" class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li v-for="n in pages" class="page-item"><a @click="paginatePage" v-bind:id="n" class="page-link"
                                href="#">@{{ n }}</a></li>
                        <li class="page-item">
                            <a @click="nextPageMethod" class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
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
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody class="h-100-px">
                            <tr v-for="(categories , index ) in singleOrdercategories" :id="categories.id">
                                <td> @{{ categories.category.name }} </td>
                                <td> <input @change=" changeMount($event,index)" class="w-45-px" type="number"
                                        :value="categories.mount"> </td>
                                <td>
                                    <select @change=" changeType($event,index)" name="type">
                                        <option v-if="categories.category_type=='classic' " selected value="classic">
                                            classic
                                        </option>
                                        <option v-else-if="categories.category_type=='spicy' " value="classic"> classic
                                        </option>
                                        <option v-if="categories.category_type=='spicy' " selected value="spicy"> spicy
                                        </option>
                                        <option v-else-if="categories.category_type=='classic' " value="spicy"> spicy
                                        </option>
                                    </select>

                                </td>
                                <td><strong> @{{ categories.subtotal }}</strong></td>
                                <td>
                                    <button type="button" class="btn btn-tool">
                                        <i @click="removeFromOrderCategories(index)" class="fas fa-times text-danger"></i>
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
            </div>
        </div>
    @endsection

    @section('vue')
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="{{ asset('cashier_files/js/OrdersVue.js') }}"></script>
    @endsection
