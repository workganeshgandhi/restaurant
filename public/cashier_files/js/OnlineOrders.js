
new Vue({
    el: '#app',
    data: {
        searchNullableNumber: null,
        searchOrderNumber: null,
        nullableorders: [],
        orders: [],
        isOrderReady: true,
        singleOrder: '',
        deliveryBoys: '',
        selectedDeliveryBoy: '',
        selecteDeliveryBoyValidation: true,
        eventOrder: [],
    },
    methods: {
        getOrders: function () {
            axios.post('/cashier/onlineorders', { 'searchNullableNumber': this.searchNullableNumber, 'searchOrderNumber': this.searchOrderNumber })
                .then(res => (this.nullableorders = res.data[0], this.orders = res.data[1]))
                .catch(error => {
                    this.errorMessage = error.message;
                    console.error("There was error ( get online orders ) !", error);
                });
        },
        getBranchDeliveryBoys: function () {
            axios.get('/cashier/getBranchDeliveryBoys')
                .then(res => (this.deliveryBoys = res.data))
                .catch(error => {
                    this.errorMessage = error.message;
                    console.error("There was error ( get cashiers ) !", error);
                });
        },
        searchNullableNumberMethod: function (event) {
            this.searchNullableNumber = event.target.value;
        },
        searchOrderNumberMethod: function (event) {
            this.searchOrderNumber = event.target.value;
        },
        showsingilorder: function (order) {
            this.singleOrder = order;
        },
        selecteDeliveryBoy: function (event) {
            this.selectedDeliveryBoy = event.target.value;
        },
        updateorder: function (order, event) {
            if (this.selectedDeliveryBoy == '') {
                this.isOrderReady = true;
            }

            axios.post('/cashier/updateDeliveryOrder', [order, event.target.value, this.selectedDeliveryBoy])
                .then(this.singleOrder = '', this.selectedDeliveryBoy = '', this.isOrderReady = true, this.selecteDeliveryBoyValidation = true)
                .catch(error => {
                    this.errorMessage = error.message;
                    console.error("There was error ( update delivery order ) !", error);
                });
            this.getOrders();
            this.selectedDeliveryBoy = '';
        },

    },
    mounted() {
        this.getOrders(),
            this.getBranchDeliveryBoys()
    },
    watch: {
        searchNullableNumber: function () {
            this.getOrders()
        },
        searchOrderNumber: function () {
            this.getOrders(this.searchNullableNumber, this.searchOrderNumber)
        },
        selectedDeliveryBoy: function () {
            if (this.singleOrder != '') {
                this.isOrderReady = false;
            }
        },
        singleOrder: function () {
            if (this.selectedDeliveryBoy != '') {
                this.isOrderReady = false;
            }
        }
    },
    created() {
        window.Echo.channel('EventOrder')
        .listen('OrderEvent', (e) => {
            this.eventOrder.push(e.message);
        })
    },
})
