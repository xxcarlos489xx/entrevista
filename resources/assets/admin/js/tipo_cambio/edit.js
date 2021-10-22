import Vue from 'vue';
import Vuelidate from 'vuelidate'
import {ApiFactory} from '../api/ApiFactory';
import { BootstrapVue } from 'bootstrap-vue'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import EditCambio from './components/EditCambio';

Vue.use(Vuelidate)
Vue.use(VueSweetalert2);
Vue.use(BootstrapVue)

const TCAPI = ApiFactory.get('TipoCambio');
Vue.prototype.$TcApi = TCAPI;


new Vue({
    el:'#app',
    components:{
        EditCambio
    }
})