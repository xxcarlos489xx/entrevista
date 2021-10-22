import Vue from 'vue';
import ListaCambio from './components/ListaCambio';
import {ApiFactory} from '../api/ApiFactory';
import { BootstrapVue } from 'bootstrap-vue'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
  
Vue.use(VueSweetalert2);

let moment = require("moment");

Vue.use(BootstrapVue)

Vue.filter('dateFormat', function (value) {
    if (!value) return ''
    value = value.toString()
    return moment(value).format('DD/MM/YYYY H:m');
})

const TCAPI = ApiFactory.get('TipoCambio');
Vue.prototype.$TcApi = TCAPI;

Vue.component('pagination', require('laravel-vue-pagination'));

new Vue({
    el:'#app',
    components:{
        ListaCambio
    }
})