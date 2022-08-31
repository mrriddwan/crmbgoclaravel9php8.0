import './bootstrap';
import Alpine from 'alpinejs';
import router from './routes'
import { createApp } from 'vue';
// import '../css/app.css'
// import * as bootstrap from "bootstrap";
// import DataTable from "datatables.net-bs5";
// import jQuery from "jquery";

//Bootstrap and jQuery libraries

// import "jquery/dist/jquery.min.js";

//Datatable Modules
// import "datatables.net-dt/js/dataTables.dataTables";
// import "datatables.net-dt/css/jquery.dataTables.min.css";
// import _ from 'lodash';
// window._ = _;

// import $ from 'jquery';
// window.jQuery = window.$ = $

// window.$ = jQuery;
// DataTable(window, window.$);

//Vue Good Table plugin
import "bootstrap/dist/css/bootstrap.min.css";
import 'vue-good-table-next/dist/vue-good-table-next.css'
import '../css///bootstrapGlobal.css'

import VueGoodTablePlugin from 'vue-good-table-next';
import LaravelVuePagination from 'laravel-vue-pagination';

window.Alpine = Alpine;
Alpine.start();

import ContactIndex from '../components/contacts/ContactIndex.vue'


const app = createApp({})

app.use(router)
app.use(VueGoodTablePlugin)
app.component('Pagination', LaravelVuePagination)
app.component('contact-index', ContactIndex)
app.mount("#app")

