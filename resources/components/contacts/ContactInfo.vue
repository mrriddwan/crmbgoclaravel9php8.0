<template>

    <GoBack />

    <div class="container max-w-50">
        <table class="table border-black">
            <thead class="bg-grey">
                <tr class="text-center w-max">
                    <th class="px-2 py-3 bg-black-50 col-span-2">
                        Company Information
                    </th>
                </tr>
            </thead>
            <tbody v-for="info in contact_infos" :key="contact_infos.id">
                <tr>
                    <td>Name</td>
                    <td class="px-2 py-4 text-m leading-5 font-bold text-gray-900 whitespace-no-wrap">{{ info.name }}
                    </td>
                </tr>
                <tr>
                    <td>Industry</td>
                    <td class="px-2 py-4 text-m leading-5 font-bold text-gray-900 whitespace-no-wrap">{{ info.industry
                    }}</td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td class="px-2 py-4 text-m leading-5 font-bold text-gray-900 whitespace-no-wrap">{{
                            info.category.name
                    }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td class="px-2 py-4 text-m leading-5 font-bold text-gray-900 whitespace-no-wrap">{{ info.address }}
                    </td>
                </tr>
                <tr>
                    <td>CS</td>
                    <td class="px-2 py-4 text-m leading-5 font-bold text-gray-900 whitespace-no-wrap">{{ info.user.name
                    }}</td>
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
                <tr class="col-span-2">
                    <td>PIC</td>
                    <td>
                        <router-link :to="{
                            name: 'incharge_create',
                            params: { id: info.id },
                        }"
                            class="inline-flex text-center px-1 py-1 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Create/Edit Incharge</router-link>
                    </td>
                </tr>

                <span v-if="info.incharge.length !== 0">
                    <span v-for="pic in info.incharge" :key="info.incharge.id" class="block">
                        <tr>
                            <td class="px-2 py-4 text-m leading-5 text-gray-900 whitespace-no-wrap">Name</td>
                            <td class="px-2 py-4 text-m leading-5 font-bold text-gray-900 whitespace-no-wrap">{{
                                    pic.name
                            }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-4 text-m leading-5 text-gray-900 whitespace-no-wrap">Email</td>
                            <td class="px-2 py-4 text-m leading-5 font-bold text-gray-900 whitespace-no-wrap">{{
                                    pic.email
                            }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-4 text-m leading-5 text-gray-900 whitespace-no-wrap">Phone No. (Mobile)
                            </td>
                            <td class="px-2 py-4 text-m leading-5 font-bold text-gray-900 whitespace-no-wrap">{{
                                    pic.phone_mobile
                            }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-4 text-m leading-5 text-gray-900 whitespace-no-wrap">Phone No. (Office)
                            </td>
                            <td class="px-2 py-4 text-m leading-5 font-bold text-gray-900 whitespace-no-wrap">{{
                                    pic.phone_office
                            }}</td>
                        </tr>
                    </span>
                </span>

                <span v-else>
                    <td class="px-2 py-4 text-m leading-5 font-bold text-gray-900 whitespace-no-wrap">
                        No PIC Data
                    </td>
                </span>

                

            </tbody>
        </table>
    </div>


    <div>
        <p>FORECAST TABLE HERE</p>
    </div>

</template>

<script>
import axios from 'axios';
import GoBack from '../utils/GoBack.vue';


export default {

    components: {
        GoBack,
    },

    data() {
        return {
            data: {
                info: ''
            },
            contact_infos: []
        };
    },

    mounted() {
        this.showContact();
    },

    methods: {
        showContact() {
            axios
                .get("/api/contacts/info/" + this.$route.params.id)
                .then((res) => {
                    this.contact_infos = res.data.data;
                }).catch((error) => {
                    console.log(error);
                });
        }
    }

}
</script>
