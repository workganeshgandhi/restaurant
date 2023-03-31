
new Vue({
    el: '#app',
    data: {
        MainCategoris: [],
        ItemArray: [
        ],
        ReceiptArray: [
        ],
        code: '',
        offerCode: {
            name: '',
            code: '',
            percentage: 0,
            discount: 0,
        },
        offerId: '',
        category_type: '',
        OrderType: 'hall',
        subtotalvalue: 0,
        TotalOrderValue: 0,
        detailsPrice: 0,
        DisablePrintButton: true,
        order: [],
        searchNumber: null,
        orders: [],
        selectedOrder: '',
        singleOrder: '',
        singleOrdercategories: '',
        singleOrderOffer: '',
    },
    methods: {
        onComplete: function () {
            this.order = [{ 'orderCategores': this.ReceiptArray }, { 'OrderType': this.OrderType }, { 'subTotal': this.subtotalvalue },
            { 'totalPrice': this.TotalOrderValue }, { 'detailsPrice': this.detailsPrice }, { 'offerId': this.offerId }, { 'code': this.code }, { 'percentage': this.code.percentage }]
            // console.log(this.order);
            axios.post("cashier/order/store", this.order)
                // .then(res => (console.log(res.data)))
                .then(res => (console.log(res.data), this.printOrder(res.data)))
                .catch(error => {
                    this.errorMessage = error.message;
                    console.error("There was an error in storing!", error);
                });
            this.ReceiptArray = [];
            this.OrderType = 'hall';
            this.subtotalvalue = 0;
            this.TotalOrderValue = 0;
            this.detailsPrice = 0;
            this.DisablePrintButton = true;
            this.order = [];
            this.category_type = '';
            this.code = '';
            this.getOrders();
        },
        printOrder: function ($id) {
            axios
                .get("cashier/order/" + $id + "/print")
                .then(res => (console.log(res.data)))
                .catch(
                    error => {
                        this.errorMessage = error.message;
                        console.error("There was an error in printing!", error);
                    }
                );
        },
        getCategories: function () {
            axios
                .get("cashier/order/categories")
                .then(res => (this.MainCategoris = res.data))
                .catch(
                    error => {
                        dispatch({ type: AUTH_FAILED });
                        dispatch({ type: ERROR, payload: error.data.error.message })
                    }
                );
        },
        SelectCategory(price, name, id, index) {
            this.ItemArray = {
                price: price,
                category_id: id,
                name: name,
                mount: 1,
                category_type: this.category_type,
                subtotal: price * 1,
            }
        },
        AddToReceiptArray() {
            this.ReceiptArray.push(this.ItemArray)
            this.ItemArray = []
        },
        deleteFromReceiptArray(index) {
            this.ReceiptArray.splice(index, 1);
        },
        changeMount(event, index) {
            this.ReceiptArray[index].mount = event.target.value;
            this.ReceiptArray[index].subtotal = this.ReceiptArray[index].price * event.target.value;
        },
        changeType(event, index) {
            this.ReceiptArray[index].category_type = event.target.value;
        },
        OrderTypeChange(event) {
            this.OrderType = event.target.value;
            console.log(this.OrderType);
        },
        cancelOrder: function () {
            this.ReceiptArray.splice(0);
            this.subtotalvalue = 0;
            this.TotalOrderValue = 0;
            this.detailsPrice = 0;
        },
        getOrders: function () {
            axios.post('cashier/getorders', { 'number': this.searchNumber })
                .then(res => (this.orders = res.data))
                // .then(res => (console.log(res.data)))
                .catch(error => {
                    this.errorMessage = error.message;
                    console.error("There was error ( get orders ) !", error);
                });
        },
        searchnumber: function (event) {
            this.searchNumber = event.target.value;
        },
        showORdersDetails: function (id) {
            axios.get('cashier/getsingleorder/' + id)
                .then(res => (this.singleOrder = res.data, this.singleOrdercategories = res.data.ordercategories,
                    this.singleOrderOffer = this.singleOrder.offer))
                .catch(error => {
                    this.errorMessage = error.message;
                    console.error("There was error ( get single order ) !", error);
                });
        },
        clearSingleOrdercategories: function () {
            this.selectedOrder = '';
            this.singleOrder = '';
            this.singleOrdercategories = '';
            this.singleOrderOffer = '';
        },

    },
    mounted() {
        this.getCategories()
        this.getOrders()
    },
    watch: {
        code: function () {
            if (this.code != '') {
                axios
                    .get("cashier/order/code/" + this.code)
                    .then(res => (
                        this.offerCode = {
                            name: res.data[0].name,
                            code: res.data[0].code,
                            percentage: res.data[0].percentage,
                            discount: res.data[0].discount,
                        },
                        this.offerId = res.data[0].id
                    ))
                    .catch(
                        error => {
                            this.offerCode = {
                                name: '',
                                code: '',
                                percentage: 0,
                                discount: 0,
                            }
                        }
                    );
            } else {
                this.offerCode = {
                    name: '',
                    code: '',
                    percentage: 0,
                    discount: 0,
                }
            }
        },
        ReceiptArray: function () {
            if (this.ReceiptArray != '') {
                this.DisablePrintButton = false;
            } else {
                this.DisablePrintButton = true;
            }
        },
        searchNumber: function () {
            this.getOrders(this.searchNumber)
        }
    },
    computed: {
        receipt: function () {
            return this.ReceiptArray
        },
        subtotal: function () {
            this.subtotalvalue = 0
            this.ReceiptArray.forEach((value) => {
                this.subtotalvalue = this.subtotalvalue + value.subtotal
            });
            return this.subtotalvalue = this.subtotalvalue + this.detailsPrice
        },
        offerPrecentageValue: function () {
            if (this.offerCode.percentage != 0) {
                return (this.offerCode.percentage * this.subtotal) / 100;
            } else if (this.offerCode.discount != 0) {
                return this.offerCode.discount
            } else {
                return 0;
            }
        },
        totalOrder: function () {
            return this.TotalOrderValue = this.subtotalvalue - this.offerPrecentageValue
        },
        orderEmpty() {
            if (this.ReceiptArray.length != 0) {
                return true;
            } else {
                return false
            }
        },

    }
})
