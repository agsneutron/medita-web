window.axios = require('axios');
window.Vue = require('vue').default;

import Vue from 'vue';
import vuetify from "../vuetify/vuetify";
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.js';

import Login from './Login';

Vue.use(VueSweetalert2);

const admin_login = new Vue({
    el: '#admin_login',
    vuetify,
    render: h => h(Login)
})
