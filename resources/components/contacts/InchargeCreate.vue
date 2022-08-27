<template>

    <span v-if="incharge_infos.length === 0">
        <div>
            <h3>No PIC data</h3>
        </div>
    </span>

    <span class="inline-block mb-10">
        <h1 class="text-center text-xl">PIC Information</h1>
        <table class="">
            <tbody v-for="info in incharge_infos" class="items-left justify-between p-2 pr-4 sm:flex-row sm:items-left">
                <tr>
                    <td>PIC</td>
                    <td class="px-2 py-4 text-m leading-5 font-bold text-gray-900 whitespace-no-wrap">{{ info.name }}
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td class="px-2 py-4 text-m leading-5 font-bold text-gray-900 whitespace-no-wrap">{{ info.email }}
                    </td>
                </tr>
                <tr>
                    <td>Phone No. (Mobile)</td>
                    <td class="px-2 py-4 text-m leading-5 font-bold text-gray-900 whitespace-no-wrap">{{
                            info.phone_mobile
                    }}</td>
                </tr>
                <tr>
                    <td>Phone No. (Office)</td>
                    <td class="px-2 py-4 text-m leading-5 font-bold text-gray-900 whitespace-no-wrap">{{
                            info.phone_office
                    }}</td>
                </tr>
                <tr class="items-center">
                    <router-link :to="{
                        name: 'incharge_edit',
                        params: { id: info.id },
                    }"
                        class="mr-2 mb-2 inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Edit</router-link>
                    <button
                        class="mr-2 mb-2 inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                        @click="deleteIncharge(info.id)">
                        Delete
                    </button>
                </tr>
            </tbody>
        </table>
    </span>

    <div class="row">
        <div class="w-max-20">
            <h1 class="inline-block items-left text-center font-extrabold bg-slate-600 px-2 py-2 rounded-md">Create PIC
            </h1>
            <form @submit.prevent="createPIC" class="grid grid-cols-4">
                <p class="m-5">contact id here:{{ }}</p>
                <div class="form-group">
                    <label class="m-10 w-30">Name</label>
                    <input type="text"
                        class="items-left mt-1 rounded-md border-gray-500 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        v-model="form.name" />
                </div>
                <div class="form-group">
                    <label class="m-10 w-30">Email</label>
                    <input type="email"
                        class="items-left mt-1 rounded-md border-gray-500 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        v-model="form.email" />
                </div>

                <div class="form-group">
                    <label class="m-10 w-30">Phone No.(Mobile)</label>
                    <input type="text"
                        class="items-left mt-1 rounded-md border-gray-500 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        v-model="form.phone_mobile" />
                </div>

                <div class="form-group">
                    <label class="m-10 w-10">Phone No.(Office)</label>
                    <input type="text"
                        class="items-left mt-1 rounded-md border-gray-500 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        v-model="form.phone_office" />
                </div>


                <button type="submit"
                    class="mt-4 px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Save
                </button>
            </form>
        </div>
    </div>
</template>

<script>


export default {

    data() {
        return {
            incharge_infos: [],
            form: {
                contact_id: '',
                name: '',
                email: '',
                phone_mobile: '',
                phone_office: '',
            },


        }
    },
    mounted() {
        this.showIncharge()
        this.debug()
    },
    methods: {

        debug() {
            console.log(this.incharge_infos)
        },

        showIncharge() {
            axios
                .get("/api/incharges/info/" + this.$route.params.id)
                .then((res) => {
                    this.incharge_infos = res.data.data;
                }).catch((error) => {
                    console.log(error);
                });
        },

        createPIC() {
            axios
                .post("/api/incharges/store", {
                    contact_id: this.contact_id,
                    name: this.form.name,
                    email: this.form.email,
                    phone_mobile: this.form.phone_mobile,
                    phone_office: this.form.phone_office,
                })
                .then(console.log(this.info.contact_id))
                .then((res) => {
                    this.$router.push({
                        name: 'incharge_create',
                        params: { id: this.$route.params.id },
                    });
                });
        },
    },
    components: {}
}

</script>
        
        