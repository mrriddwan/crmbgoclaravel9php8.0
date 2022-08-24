<template>
    <div>
        <h3 class="text-center">Create Contact</h3>
        <GoBack />
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="createContact">
                    <div class="form-group">
                        <label>Status</label>
                        <select
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.status" @change="getStatus">
                            <option disabled value="">Please select one</option>
                            <option v-for="status in statuses" :key="status.id" :value="status.id">
                                {{ status.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.type" @change="getType">
                            <option disabled value="">Please select one</option>
                            <option v-for="type in types" :key="type.id" :value="type.id">
                                {{ type.name }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Industry</label>
                        <input type="text"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.industry" />
                    </div>

                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.company_name" />
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.category" @change="getCategory">
                            <option disabled value="">Please select one</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.address" />
                    </div>
                    <div class="form-group">
                        <label>Remark</label>
                        <input type="text"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
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
import GoBack from '../utils/GoBack.vue';
import axios from 'axios';

export default {
    data() {
        return {
            form: {
                status: '',
                type: '',
                industry: '',
                company_name: '',
                category: '',
                address: '',
                remark: '',
            },
            types: [],
            categories: [],
            statuses: []
        };
    },

    created () {
        this.getStatus();
        this.getCategory();
        this.getType();
    },

    // created() {
    //     this.getStatus();
    //     this.getCategory;
    //     this.getType();
    // },

    methods: {
        createContact() {
            axios
                .post("/api/contacts/store", {
                    address: this.form.address,
                    type: this.form.type,
                    industry: this.form.industry,
                    status: this.form.status,
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
                .get("/api/contactstatus/index")
                .then((res) => {
                    this.statuses = res.data.data;
                }).catch((error) => {
                    console.log(error);
                })
        },

        getCategory() {
            axios
                .get("/api/contactcategory/index")
                .then((res) => {
                    this.categories = res.data.data;
                }).catch((error) => {
                    console.log(error);
                })
        },

        getType() {
            axios
                .get("/api/contacttype/index")
                .then((res) => {
                    this.types = res.data.data;
                }).catch((error) => {
                    console.log(error);
                })
        },


    },
    components: { GoBack }
};
</script>