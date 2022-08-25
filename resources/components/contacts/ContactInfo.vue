<template>
    <div>
        <table>
            <thead>
                <tr>
                    <th>
                        Company Information
                    </th>
                </tr>
            </thead>
            <tbody v-for="info in contact" :key="contact.id">
                <tr>
                    <td>Name</td>
                    <td>{{ info.name }}</td>
                </tr>
                <tr>
                    <td>Industry</td>
                    <td>{{ info.industry }}</td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>{{ info.category.name }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ info.address }}</td>
                </tr>
                <tr>
                    <td>CS</td>
                    <td>{{ info.user.name }}</td>
                </tr>
                <tr>
                    <td>Contact History</td>
                    <td>History of To Do
                        <!-- <router-link :to="{
                                    name: 'contact_history',
                                    params: { id: info.id },
                                }"
                                    class="mr-2 mb-2 inline-flex items-center px-1 py-1 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Contact History</router-link> -->
                    </td>
                </tr>

                <tr>
                    <td>PIC</td>
                    <td v-if="info.incharge === null">
                        <router-link :to="{
                                    name: 'incharge_create',
                                    params: { id: info.id },
                                }"
                                    class="inline-flex items-left ml-5 mr-5 px-4 py-2 bg-blue-800 border border-black rounded-md font-bold text-xs text-black uppercase ">
                                    Add PIC</router-link>
                    </td>

                    <td v-else>
                        <InchargeInfo/>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <InchargeInfo />
    

    <div>
        <p>FORECAST TABLE HERE</p>
    </div>

</template>

<script>
import axios from 'axios';
import GoBack from '../utils/GoBack.vue';
import InchargeInfo from './InchargeInfo.vue';


export default {

    components: {
        GoBack,
        InchargeInfo
    },

    data() {
        return {
            data: {
                info: ''
            },
            contact: []
        };
    },

    created() {
        this.showContact();
    },

    methods: {
        showContact() {
            axios
                .get("/api/contacts/info/" + this.$route.params.id)
                .then((res) => {
                    this.contact = res.data.data;
                }).catch((error) => {
                    console.log(error);
                });
        }
    }

    //     mounted: function () {
    //     this.loadData();
    // },
}
</script>
