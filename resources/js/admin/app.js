require('../bootstrap');

import Vue from 'vue';
import router from './router/router';
import vuetify from "./vuetify/vuetify";
import App from './pages/App';
import VueSweetalert2 from 'vue-sweetalert2';
import JoditVue from 'jodit-vue';
import 'jodit/build/jodit.min.css';
import 'sweetalert2/dist/sweetalert2.min.css';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.js';
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import VueEllipseProgress from 'vue-ellipse-progress';

Vue.use(VueSweetalert2);
Vue.use(JoditVue);
Vue.use(VueEllipseProgress);

export const bus = new Vue();

const admin = new Vue({
    el: '#admin',
    router,
    vuetify,
    render: h => h(App)
})
