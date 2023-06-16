// import axios from 'axios'

Vue.use(VueFormWizard)
// Vue.use(axios)
new Vue({
    el: '#app',
    data: function () {
        return {
            name: '',
            mobile: '',
            address: '',
            MainCategoris: '',
            ItemArray: {
            },
            ReceiptArray: [
            ],
            deliveryFees: 30,
            code: '',
            offerCode: {
                id: null,
                name: 'No Offer',
                code: 'NoOffer',
                percentage: 0,
                discount: 0,
            },
            subtotalvalue: 0,
            TotalOrderValue: 0,
            detailsPrice: 0,
            category_type: 'classic',

        }
    },
    methods: {
        onComplete: function () {
            order = [{ 'orderCategores': this.ReceiptArray }, { 'subTotal': this.subtotalvalue },
            { 'totalPrice': this.TotalOrderValue }, { 'deliveryFees': this.deliveryFees }, { 'offerId': this.offerCode.id }, { 'code': this.code }, { 'name': this.name }, { 'mobile': this.mobile }, { 'address': this.address }];
            axios.post("/sendordertocashier", order)
                .then(res => {
                    //console.log(res);
                    alert('you will redirect to payment page now')
                    window.location.href = 'https://portal.weaccept.co/api/acceptance/iframes/' + res.data['iframe'] + '?payment_token=' + res.data['token'];
                })
                .catch(error => {
                    this.errorMessage = error.message;
                    console.error("There was a send order error !", error);
                });
        },
        getMainCategories: function () {
            axios
                .get("/maincategories")
                // .then(res => (console.log(res.data)))
                .then(res => (this.MainCategoris = res.data))
                .catch(err => console.log(err));
        },
        SelectCategory(price, name, id, index) {
            this.ItemArray = {
                price: price,
                category_id: id,
                name: name,
                category_type: this.category_type,
                mount: 1,
                subtotal: price * 1,
            }
        },
        AddToReceiptArray() {
            this.ReceiptArray.push(this.ItemArray)
            this.ItemArray = {}
        },
        deleteFromReceiptArray(index) {
            this.ReceiptArray.splice(index, 1);
        },
        change(event, index) {
            this.ReceiptArray[index].mount = event.target.value;
            this.ReceiptArray[index].subtotal = this.ReceiptArray[index].price * event.target.value;
        },
        changeType(event, index) {
            this.ReceiptArray[index].category_type = event.target.value;
        },
        cancelOrder: function () {
            this.ReceiptArray.splice(0);
            this.subtotalvalue = 0;
            this.TotalOrderValue = 0;
            this.detailsPrice = 0;
        },

    },
    mounted() {
        this.getMainCategories();
    }
    ,
    watch: {
        code: function () {
            if (this.code != '') {
                axios
                    .get("/order/code/" + this.code)
                    .then(res => (
                        console.log(res.data),
                        this.offerCode = {
                            id: res.data[0].id,
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
    },
    computed: {
        nameValidation: function () {
            if (!this.name) {
                return '*';
            } else if (!isNaN(this.name)) {
                return 'name cant be only numbers';
            } else if (this.name.length < 8) {
                return 'name cant be less than 8 char';
            }
        },
        mobileValidation: function () {
            if (!this.mobile) {
                return '*';
            } else if (this.mobile.length < 11) {
                return "mobile can't be less than 11 numbers";
            }
        },
        addressValidation: function () {
            if (!this.address) {
                return '*';
            }
        },
        infoValidation: function () {
            if (!this.name || !isNaN(this.name) || this.name.length < 8 || !this.mobile || this.mobile.length < 11 || !this.address) {
                return false;
            } else {
                return true;
            }
        },
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
            return (this.offerCode.percentage * this.subtotal) / 100;
        },
        totalOrder: function () {
            return this.TotalOrderValue = this.subtotalvalue - this.offerCode.discount - this.offerPrecentageValue + this.deliveryFees
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
