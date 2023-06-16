
new Vue({
    el: '#app',
    data: {
        searchNumber: null,
        orders: [],
        singleOrder: '',
        singleOrdercategories: '',
        singleOrderOffer: '',
        pages: 1,
        currentPage: 1,
    },
    methods: {
        getOrders: function () {
            axios.post('getorders?page=' + this.currentPage, { 'number': this.searchNumber })
                .then(res => (
                    // console.log(res.data),
                    this.pages = res.data['last_page'],
                    this.currentPage = res.data['current_page'],
                    this.orders = res.data['data']
                ))
                // .then(res => (console.log(res.data)))
                .catch(error => {
                    this.errorMessage = error.message;
                    console.error("There was error ( get orders ) !", error);
                });
        },
        nextPageMethod: function () {
            if (this.currentPage == this.pages) {
                this.currentPage = 1
            } else {
                this.currentPage = this.currentPage + 1
            }
        },
        prevPageMethod: function () {
            if (this.currentPage == 1) {
                this.currentPage = this.pages
            } else {
                this.currentPage = this.currentPage - 1
            }
        },
        paginatePage: function (event) {
            this.currentPage = event.target.id;
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
        },
        removeFromOrderCategories: function (index) {
            console.log(index);
            this.singleOrder.ordercategories.splice(0,index)
        },
        changeMount: function (event, index) {
            this.singleOrder.ordercategories[index].mount = event.target.value
        },
        changeType: function (event, index) {
            this.singleOrder.ordercategories[index].category_type = event.target.value
            console.log(index);
        },
    },
    mounted() {
        this.getOrders()
    },
    watch: {
        searchNumber: function () {
            this.getOrders(this.searchNumber)
        },
        currentPage: function () {
            this.getOrders()
        }
    },
    computed: {

    }
})
