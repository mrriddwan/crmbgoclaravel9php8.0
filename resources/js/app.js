
import Alpine from "alpinejs";
import router from "./routes";
import { createApp } from "vue";

//bootstrap
import "./bootstrap";
import "../css///bootstrapGlobal.css";
import "bootstrap/dist/css/bootstrap.min.css";

import LaravelVuePagination from "laravel-vue-pagination";

window.Alpine = Alpine;
Alpine.start();

import ContactIndex from "../components/contacts/ContactIndex.vue";

const app = createApp({});

app.use(router);
app.component("Pagination", LaravelVuePagination);
app.component("contact-index", ContactIndex);
app.mount("#app");
