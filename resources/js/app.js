const { default: Axios } = require('axios');

require('./bootstrap');

window.Vue = require('vue');

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const app = new Vue({
    el: '#app',

    data: {
        activeSection: 'productList',
        products: [],
    },

    mounted() {
        this.allProducts();
    },

    methods: {
        allProducts() {
            Axios.get('/product').then(response => {
                this.activeSection = 'productList';
                this.products = response.data;
            });
        },

        myProducts() {
            Axios.get('/user').then(response => {
                this.activeSection = 'productUserList';
                this.products = response.data;
            });
        },

        newProduct() {
            this.activeSection = 'newProduct';
        }
    }
});
