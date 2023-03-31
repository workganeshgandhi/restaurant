
new Vue({
    el: '#app',
    data: {
        searchNumber: null,
        orders: [],
        selectedOrder: '',
        singleOrder: '',
        singleOrdercategories: '',
        singleOrderOffer: '',
    },
    methods: {
        getOrders: function () {
            axios.post('getorders', { 'number': this.searchNumber })
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
            axios.get('getsingleorder/' + id)
                .then(res => (this.singleOrder = res.data, this.singleOrdercategories = res.data.ordercategories,
                    this.singleOrderOffer = this.singleOrder.offer))
                .catch(error => {
                    this.errorMessage = error.message;
                    console.error("There was error ( get single order ) !", error);
                });
        }
    },
    mounted() {
        this.getOrders()
    },
    watch: {
        searchNumber: function () {
            this.getOrders(this.searchNumber)
        }
    },
    computed: {

    }
})
