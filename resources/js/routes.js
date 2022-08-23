import { createRouter, createWebHistory } from 'vue-router';
/**Contact Imports */
import ContactIndex from '../components/contacts/ContactIndex.vue';
import ContactCreate from '../components/contacts/ContactCreate.vue';
import ContactEdit from '../components/contacts/ContactEdit.vue';
import ContactHistory from '../components/contacts/ContactHistory.vue';
import ContactInfo from '../components/contacts/ContactInfo.vue';
import InchargeCreateInfo from '../components/contacts/InchargeCreateInfo.vue';
import InchargeEdit from '../components/contacts/InchargeEdit.vue';

/**Forecast Imports */
import ForecastIndex from '../components/forecasts/ForecastIndex.vue';
import ForecastEdit from '../components/forecasts/ForecastEdit.vue';
import ForecastCreateInfo from '../components/forecasts/ForecastCreateInfo.vue';

const routes = [

    /*                      
        Contact Routes                      
    */

    {
        path: '/dashboard',
        name: 'contact_index',
        component: ContactIndex
    },

    {
        path: '/contacts_create',
        name: 'contacts_create',
        component: ContactCreate
    },

    {
        path: '/contacts_edit/:id',
        name: 'contacts_edit',
        component: ContactEdit
    },

    {
        path: '/contacts_info',
        name: 'contacts_info',
        component: ContactInfo
    },

    {
        path: '/contacts_history',
        name: 'contacts_history',
        component: ContactHistory
    },

    {
        path: '/incharge_createinfo',
        name: 'incharge_createinfo',
        component: InchargeCreateInfo
    },

    {
        path: '/incharge_edit/:id',
        name: 'incharge_edit',
        component: InchargeEdit
    },

    /*                                                  
            Forecast Routes 
    */

    {
        path: '/forecast_index',
        name: 'forecast_index',
        component: ForecastIndex
    },

    {
        path: '/forecast_createinfo',
        name: 'forecast_createinfo',
        component: ForecastCreateInfo
    },

    {
        path: '/forecast_edit/:id',
        name: 'forecast_edit',
        component: ForecastEdit
    },

];

export default createRouter({
    history: createWebHistory(),
    routes
})