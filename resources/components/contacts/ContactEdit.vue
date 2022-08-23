<template>
    <div>
        <h1 class="text-center font-bold text-lg">Edit Contact</h1>
        <GoBack />
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateContact">
                    <div class="form-group mb-4">
                        <label class="font-bold">Status</label>
                        <select
                            class="block mt-1 w-max rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.status" @change="getStatus">
                            <option value="">Please select one</option>

                            <option v-for="status in statuses" :key="status.id" :value="status.id">
                                {{ status.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label class="font-bold">Type</label>
                        <select
                            class="block mt-1 w-max rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.type" @change="getType">
                            <option value="">Please select one</option>

                            <option v-for="type in types" :key="type.id" :value="type.id">
                                {{ type.name }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-bold">Industry</label>
                        <input type="text"
                            class="block mt-4 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.industry" />
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-bold">Company Name</label>
                        <input type="text"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.company_name" />
                    </div>
                    <div class="form-group mb-4">
                        <label class="font-bold">Category</label>
                        <select
                            class="block m-1 w-max rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.category" @change="getCategory">
                            <option value="">Please select one</option>

                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label class="font-bold">Address</label>
                        <input type="text"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.address" />
                    </div>
                    <div class="form-group mb-4">
                        <label class="font-bold">Remark</label>
                        <input type="text"
                            class="h-20 w-40 block m- rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.remark" />
                    </div>

                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Create
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import GoBack from '../utils/GoBack.vue';


const categoryAPI = "/api/contactCategory/index"
const typeAPI = "/api/contactType/index"
const statusAPI = "/api/contactStatus/index"
const userAPI = "/api/user/index"

export default {
    data() {
        return {
            form: {
                user: '',
                status: '',
                type: '',
                industry: '',
                company_name: '',
                category: '',
                address: '',
                remark: '',
            },
            users: [],
            statuses: [],
            types: [],
            categories: [],
        };
    },

    created() {
        this.showContact();
        this.getStatus();
        this.getCategory;
        this.getType();
        // this.getFormSelections();
    },
    methods: {

        showContact() {
            axios
                .get("/api/contacts/show/" + this.$route.params.id)
                .then((res) => {
                    this.form = res.data.data;
                }).catch((error) => {
                    console.log(error);
                });
        },

        updateContact() {
            axios
                .put("/api/contacts/update/" + this.$route.params.id, {
                    user: this.form.user,
                    address: this.form.address,
                    type: this.form.type,
                    industry: this.form.industry,
                    company_name: this.form.company_name,
                    category: this.form.category,
                    address: this.form.address,
                    remark: this.form.remark
                })
                .then((res) => {
                    this.$router.push({ name: "contact_index" });
                });
        },

        getStatus() {
            axios
                .get(statusAPI)
                .then((res) => {
                    this.statuses = res.data.data;
                }).catch((error) => {
                    console.log(error);
                })
        },

        getCategory(){
            axios
                .get(categoryAPI)
                .then((res) => {
                    this.categories = res.data.data;
                }).catch((error) => {
                    console.log(error);
        })
        },

        getType(){
            axios
                .get(typeAPI)
                .then((res) => {
                    this.types = res.data.data;
                }).catch((error) => {
                    console.log(error);
                })
        },

        getUser(){
            axios
                .get(userAPI)
                .then((res) => {
                    this.users = res.data.data;
                }).catch((error) => {
                    console.log(error);
                })
        }

        // getFormSelections() {
        //     const requestOne = axios.get(categoryAPI);
        //     const requestTwo = axios.get(typeAPI);
        //     const requestThree = axios.get(statusAPI);
        //     const requestFour = axios.get(userAPI);

        //     axios
        //         .all([requestOne, requestTwo, requestThree, requestFour])
        //         .then(axios
        //             .spread((...responses) => {
        //             const responseOne = responses[0]
        //             const responseTwo = responses[1]
        //             const responseThree = responses[2]
        //             const responseFour = responses[3]
        //         // use/access the results
        //         console.log(responseOne, responseTwo, responseThree, responseFour);
        //         }))
        //         .catch(errors => {
        //             console.error(errors);
        //         })
        // }
    },
components: {
    GoBack, 
    }
};
</script>



