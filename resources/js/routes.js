import { createRouter, createWebHistory } from "vue-router";

/**Contact Imports */
import ContactIndex from "../components/contacts/ContactIndex.vue";
import ContactCreate from "../components/contacts/ContactCreate.vue";
import ContactEdit from "../components/contacts/ContactEdit.vue";
import ContactHistory from "../components/contacts/ContactHistory.vue";
import ContactInfo from "../components/contacts/ContactInfo.vue";

import InchargeCreate from "../components/contacts/InchargeCreate.vue";
import InchargeEdit from "../components/contacts/InchargeEdit.vue";

/**Forecast Imports */
import ForecastIndex from "../components/forecasts/ForecastIndex.vue";
import ForecastEdit from "../components/forecasts/ForecastEdit.vue";
import ForecastCreateInfo from "../components/forecasts/ForecastCreateInfo.vue";

/**ToDo Imports */
import ToDoIndex from "../components/todo/ToDoIndex.vue";
import ToDoCreate from "../components/todo/ToDoCreate.vue";
import ToDoEdit from "../components/todo/ToDoEdit.vue";
import ToDoInsert from "../components/todo/ToDoInsert.vue";


const routes = [
    /*                      
        Contact Routes                      
    */

    {
        path: "/dashboard",
        name: "contact_index",
        component: ContactIndex,
    },

    {
        path: "/contacts/create",
        name: "contacts_create",
        component: ContactCreate,
    },

    {
        path: "/contacts/:id/edit",
        name: "contacts_edit",
        component: ContactEdit,
    },

    {
        path: "/contacts/:id/info",
        name: "contacts_info",

        component: ContactInfo,
    },

    {
        path: "/contacts/history",
        name: "contacts_history",
        component: ContactHistory,
    },

    {
        path: "/incharges/:id/create",
        name: "incharge_create",
        component: InchargeCreate,
    },

    {
        path: "/incharges/:id/edit",
        name: "incharge_edit",
        component: InchargeEdit,
    },

    /*                                                  
            Forecast Routes 
    */

    {
        path: "/forecasts/index",
        name: "forecast_index",
        component: ForecastIndex,
    },

    {
        path: "/forecasts/createinfo",
        name: "forecast_createinfo",
        component: ForecastCreateInfo,
    },

    {
        path: "/forecast_edit/:id",
        name: "forecast_edit",
        component: ForecastEdit,
    },
    /*                                                  
            Forecast Routes 
    */

    {
        path: "/todo/index",
        name: "todo_index",
        component: ToDoIndex,
    },

    {
        path: "/todo/insert/:id",
        name: "todo_insert",
        component: ToDoInsert,
    },

    // {
    //     path: "/todo/create/:id",
    //     name: "todo_create",
    //     component: ToDoCreate,
    // },

    {
        path: "/todo/create",
        name: "todo_create",
        component: ToDoCreate,
    },

    // {
    //     path: "/todo/:id/edit",
    //     name: "todo_Edit",
    //     component: ToDoEdit,
    // },

    {
        path: "/todo/edit",
        name: "todo_Edit",
        component: ToDoEdit,
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
