const { default: Axios } = require('axios');

require('./bootstrap');

window.Vue = require('vue');

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const app = new Vue({
    el: '#app',

    data: {
        message: 'Hello World!',
    },

    methods: {
        allProducts() {
            Axios.get('/products').then(response => {

            })
        }
    }
});
