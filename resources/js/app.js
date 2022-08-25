import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from 'vue';
import router from './routes'
import ContactIndex from '../components/contacts/ContactIndex.vue'
// import VueGoodTablePlugin from 'vue-good-table';
// import "vue-good-table/dist/vue-good-table.css "
import '../css/app.css'


window.Alpine = Alpine;

Alpine.start();

// createApp({
//         ContactIndex,
// })
// .use(router)
// .mount("#app")


const app = createApp({})


app.use(router)
// app.use('VueGoodTable',VueGoodTablePlugin)
app.component('contact-index', ContactIndex)
app.mount("#app")
