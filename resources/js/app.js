import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from 'vue';
import router from './routes'
import ContactIndex from '../components/contacts/ContactIndex.vue'


window.Alpine = Alpine;

Alpine.start();

// createApp(
//         ContactIndex,
// )
// .use(router)
// .mount("#app")

const app = createApp({})


app.use(router)
app.component('contact-index', ContactIndex)
app.mount("#app")