import './bootstrap';
import Alpine from 'alpinejs';

import { createApp } from 'vue';
import router from './routes'

import ContactIndex from '../components/contacts/ContactIndex.vue'

import '../css/app.css'
import 'vue-good-table-next/dist/vue-good-table-next.css'
import VueGoodTablePlugin from 'vue-good-table-next';
//Bootstrap and jQuery libraries
import "bootstrap/dist/css/bootstrap.min.css";
import "jquery/dist/jquery.min.js";
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import jQuery from 'jquery';
window.$ = jQuery;



window.Alpine = Alpine;

Alpine.start();

const app = createApp({})

app.use(router)
app.use(VueGoodTablePlugin)
app.component('contact-index', ContactIndex)
app.mount("#app")
