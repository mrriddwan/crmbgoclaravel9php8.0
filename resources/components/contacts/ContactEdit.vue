<!-- <template>
    <div class="row" onchange="debug">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Category</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="contact.name">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Industry</label>
                                    <input type="text" class="form-control" v-model="contact.industry">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>                        
                    </form>

            
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"update-contact",
    data(){
        return {
            contact:{
                name:"",
                category:"",
            }
        }
    },
    mounted(){
        this.showContact()
        this.debug()
    },
    methods:{
        async showContact(){
            await axios.get(`/api/contacts/show/${this.$route.params.id}`).then(response=>{
                const { name, category } = response.data
                this.contact.name = name
                this.contact.category = category
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            await this.axios.post(`api/contacts/update/${this.$route.params.id}`,this.contact).then(response=>{
                this.$router.push({name:"contact_index"})
            }).catch(error=>{
                console.log(error)
            })
        },

        debug() {
            console.log(this.contact.data)
        }
    }
}
</script> -->






<template>
    <div>
        <h1 class="text-center font-bold text-lg">Edit Contact</h1>
        <GoBack />
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateContact()" >
                    <div class="form-group mb-4">
                        <label class="font-bold">User</label>
                        <p>Selected User: {{ contact.user_id }}</p>
                        <select
                            class="block m-1 w-max rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="contact.user_id" @change="getUser">
                            <option disabled value="">Please select user</option>

                            <option v-for="user in users" :key="user.id" :value="user.id" >
                                {{ user.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label class="font-bold">Status</label>
                        <select
                            class="block mt-1 w-max rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="contact.status_id" @change="getStatus">
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
                            v-model="contact.type_id" @change="getType">
                            <option value="">Please select one</option>

                            <option v-for="type in types" :key="type.id" :value="type.id">
                                {{ type.name }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-bold">Industry</label>
                        <input type="text" name="industry" id="industry"
                            class="block mt-4 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="contact.industry" />
                    </div>

                    <div class="mt-1">
                        <label class="font-bold">Name</label>
                        <input type="text" name="name" id="name"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="contact.name"/>
                    </div>
                    <div class="form-group mb-4">
                        <label class="font-bold">Category</label>
                        <select
                            class="block m-1 w-max rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="contact.category_id" @change="getCategory">
                            <option value="">Please select one</option>

                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label class="font-bold">Address</label>
                        <input type="text" name="address" id="address"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="contact.address" />
                    </div>
                    <div class="form-group mb-4">
                        <label class="font-bold">Remark</label>
                        <input type="text" name="address" id="remark"
                            class="h-20 w-40 block m- rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="contact.remark" />
                    </div>

                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import GoBack from '../utils/GoBack.vue';


export default {
    data() {
        return {
            contact: {
                user_id: '',
                status_id: '',
                type_id: '',
                category_id: '',
                industry: "",
                name: "",
                address: "",
                remark: "",
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
        this.getCategory();
        this.getUser();
        this.getType();
        // this.debug();
        // this.getFormSelections();
    },
    methods: {

        // debug(){
        //     console.log(this.contact.user_id)
        // },

        showContact() {
            axios
                .get("/api/contacts/show/" + this.$route.params.id)
                .then((res) => {
                    this.contact = res.data;
                }).catch((error) => {
                    console.log(error);
                });
        },

        updateContact() {
            axios
                .put("/api/contacts/update/" + this.$route.params.id, {
                    user_id: this.contact.user_id,
                    address: this.contact.address,
                    type_id: this.contact.type_id,
                    status_id: this.contact.status_id,
                    industry: this.contact.industry,
                    name: this.contact.name,
                    category_id: this.contact.category_id,
                    address: this.contact.address,
                    remark: this.contact.remark
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

        getUser() {
            axios
                .get("/api/user/index")
                .then((res) => {
                    this.users = res.data.data;
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

    components: {
        GoBack,
    }
};
</script>


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
