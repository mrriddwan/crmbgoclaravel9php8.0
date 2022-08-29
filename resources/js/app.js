import './bootstrap';
import Alpine from 'alpinejs';

import { createApp } from 'vue';
import router from './routes'

import ContactIndex from '../components/contacts/ContactIndex.vue'

import '../css/app.css'
import 'vue-good-table-next/dist/vue-good-table-next.css'
import VueGoodTablePlugin from 'vue-good-table-next';



window.Alpine = Alpine;

Alpine.start();

const app = createApp({})

app.use(router)
app.use(VueGoodTablePlugin)
app.component('contact-index', ContactIndex)
app.mount("#app")
