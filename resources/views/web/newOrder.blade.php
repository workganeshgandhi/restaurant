@extends('layouts.web.app')
@section('content')
    <section class="container mb-4" id="app" >
        <div class="new-order-title d-flex justify-content-center">
            Make An Order
        </div>
        <form-wizard @on-complete="onComplete">
            <tab-content title="Choose Your Items" icon="ti-target">
                <div class="row select-item" >
                    <div class="col-md-2 h-100">
                        <div class="card h-100">
                            <div class="card-header">
                                <h6 style="font-size: 20px !important;" class="card-title">Main</h6>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow-y: scroll;">
                                <ul class="products-list product-list-in-card pt-4 pl-2 pr-2">

                                    <!-- /.item -->
                                    <li v-for=" MainCategory in MainCategoris" class="item">
                                        <div>
                                            <a :href="'#maincategory' + MainCategory.id" class="uppercase">
                                                <strong>@{{ MainCategory.name }}</strong></a>
                                        </div>
                                        <hr>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-center">
                                <a href="javascript:void(0)" class="uppercase">Select Main</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                    </div>
                    <div class="col-md-5 h-100">
                        <div class="card h-100">
                            <div class="card-header border-transparent">
                                <span style="font-size: 20px !important;" class="card-title">Meals &
                                    Items</span>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0 " style="overflow-y: scroll;">
                                <div class="table-responsive" v-for=" mainCategory in MainCategoris">
                                    <table class="table m-0" :id="'maincategory' + mainCategory.id">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Info.</th>
                                                <th>Select</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for=" (category,index) in mainCategory.categories">
                                                <td> <strong>@{{ category.name }}</strong> </td>
                                                <td><strong>@{{ category.price }}</strong></td>
                                                <td><button type="button" data-toggle="modal"
                                                        :data-target="'#' + category.name.replace(' ', '_')"
                                                        class="btn btn-tool">
                                                        <i class="fas fa-info text-info"></i>
                                                    </button>
                                                    <div class="modal fade" :id="category.name.replace(' ', '_')"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        @{{ category.name }}</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @{{ category.name }}@{{ category.name }}@{{ category.name }}@{{ category.name }}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <button
                                                        @click="SelectCategory(category.price,category.name,category.id , index)"
                                                        v-on:click="AddToReceiptArray" type="button" class="btn btn-tool">
                                                        <i style="font-size: 20px;" class="fas fa-plus text-danger"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 h-100">
                        <div class="card h-100">
                            <div class="card-header">
                                <h6 style="font-size: 20px !important;" class="card-title">Selected Items</h6>
                                <input type="text" class="form-control" v-model="code" placeholder="Offer Code"
                                    style="height: 25px;" name="" id="">
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0 w-100" style="overflow-y: scroll;">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Mount</th>
                                                <th>type</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for=" ( item , index  ) in ReceiptArray">
                                                <td>@{{ item.name }}</td>
                                                <td>
                                                    <input @change="change( $event ,index)" style="width: 30px;"
                                                        value="1" min="1" type="number" name=""
                                                        id="">
                                                </td>
                                                <td>
                                                    <select @change=" changeType($event,index)" name="type"
                                                        id="@item.name">
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
                            <div class="card-footer text-center">
                                <a href="javascript:void(0)" class="uppercase">Items You Selected</a>
                            </div>
                        </div>
                    </div>
                </div>

            </tab-content>
            <tab-content title="Personal Information" icon="ti-user">
                <div class="d-flex justify-content-center w-100">

                    <div>
                        <div class="d-flex justify-content-center mb-4 mb-4">
                            <i class="fas fa-user" style="font-size: 100px;color: orange;"></i>
                        </div>
                        <form style="width: 400px;">
                            <div class="form-group ">
                                <input type="text" v-model="name" class="personal-input w-100"
                                    placeholder="Enter Your Name">
                                <small class="m-4 text-danger">@{{ nameValidation }}</small>
                            </div>
                            <div class="form-group ">
                                <input type="number" v-model="mobile" class=" personal-input w-100"
                                    placeholder="Enter Your Phone Number">
                                <small class="m-4 text-danger">@{{ mobileValidation }}</small>
                            </div>
                            <div class="form-group ">
                                <input type="text" v-model="address" class=" personal-input w-100"
                                    placeholder="Enter Your Address">
                                <small class="m-4 text-danger">@{{ addressValidation }}</small>
                            </div>
                        </form>
                    </div>

                </div>
            </tab-content>
            <tab-content title="Verifying Order" icon="ti-check">
                <div class="row mt-4 mt-4 d-flex justify-content-center ">
                    <div class="col-md-5 final-reset  w-100 d-flex align-content-around flex-wrap">

                        <div class="w-100">
                            <div class="sub-title text-dark w-100 text-center"> @lang('trans.app name')
                            </div>
                            <div class="mt-4 mb-4 d-flex justify-content-center">
                                <span> WELCOME</span>
                            </div>
                            <div class="mt-4 mb-4 d-flex justify-content-center">
                                <span> <strong>CAIRO , NASR CITY , MAKRAM ST.</strong></span>
                            </div>

                            <div class="mt-4 mb-4 d-flex justify-content-center">
                                <span> @lang('trans.name') : </span> <span> <strong> @{{ name }} </strong></span>
                            </div>
                            <div class="mt-4 mb-4 d-flex justify-content-center">
                                <span> @lang('trans.mobile') : </span> <span> <strong>@{{ mobile }}</strong></span>
                            </div>
                            <div class="mt-4 mb-4 d-flex justify-content-around">
                                <span> 12/12/2021 </span> <span> <strong> 22:15:21 </strong></span>
                            </div>
                            <div class="w-100">
                                <table class="table m-0">
                                    <thead>
                                        <tr>

                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in ReceiptArray">
                                            <td>
                                                @{{ item.mount }}
                                            </td>
                                            <td>@{{ item.name }}</td>
                                            <td>@{{ item.price }}</td>
                                            <td>@{{ item.subtotal }}</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="w-100 mt-4 mb-4">
                            <div class="d-flex justify-content-between">
                                <span>Delivery Fees</span><span>@{{ deliveryFees }} L.E</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span> subtotal </span><span>@{{ subtotalvalue }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>discount</span><span>@{{ offerPrecentageValue }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <strong>TOTAL</strong><strong>@{{ totalOrder }}</strong>
                            </div>
                        </div>

                    </div>

                </div>
            </tab-content>
            <template slot="footer" slot-scope="props">
                <div class=wizard-footer-left>
                    <wizard-button @click.native="props.prevTab()" v-if="props.activeTabIndex > 0"
                        :style="props.fillButtonStyle">Previous</wizard-button>
                </div>
                <div class="wizard-footer-right">
                    <wizard-button :disabled="!orderEmpty" v-if="props.activeTabIndex == 0 "
                        @click.native="props.nextTab()" class="wizard-footer-right" :style="props.fillButtonStyle">
                        @{{ props.isLastStep ? 'Submit' : 'Next' }}</wizard-button>
                    <wizard-button :disabled="!infoValidation" v-if="props.activeTabIndex == 1 "
                        @click.native="props.nextTab()" class="wizard-footer-right" :style="props.fillButtonStyle">
                        @{{ props.isLastStep ? 'Submit' : 'Next' }}</wizard-button>
                    <wizard-button :disabled="!orderEmpty" :diabled="!infoValidation" v-if="props.activeTabIndex == 2 "
                        @click.native="props.nextTab()" class="wizard-footer-right" :style="props.fillButtonStyle">
                        @{{ props.isLastStep ? 'Submit' : 'Next' }}</wizard-button>
                </div>
            </template>
        </form-wizard>

    </section>
@endsection
@section('vue')
    <!-- vue.js -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    <script src="{{ asset('web_files/assets/js/vueFormWizard.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src="{{ asset('web_files/assets/js/NewOrderVue.js') }}"></script>
@endsection
