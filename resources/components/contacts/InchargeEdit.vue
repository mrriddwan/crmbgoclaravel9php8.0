<template>
    <GoBack />

    <div class="container w-max border-4 align-center mx-auto" v-if="info.incharge.length !== 0">
        <div v-for="info in contact_infos" :key="contact_infos.id">
            <h1 class="items-center text-center text-white font-extrabold bg-slate-600 px-2 py-2 rounded-md">Create PIC
            </h1>
            <div class="text-left">
                <p class="m-5 font-extrabold text-xl text-center uppercase">{{ info.name }}</p>
                <form @submit.prevent="updatePIC" class="inline-block align-middle">
                    <div class="grid grid-cols-2 items-center">
                        <div class="grid grid-cols-2 w-auto items-center">
                            <div>
                                <label class="ml-7">Name</label>
                            </div>
                            <div>
                                <input type="text"
                                    class="items-left rounded-md border-gray-500 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    v-model="pic.name" />
                            </div>
                        </div>
                        <div class="grid grid-cols-2 w-auto items-center">
                            <label class="ml-7">Email</label>
                            <input type="email"
                                class="items-left mt-1 rounded-md border-gray-500 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                v-model="pic.email" />
                        </div>

                        <div class="grid grid-cols-2 w-auto items-center">
                            <label class="ml-7">Phone No.(Mobile)</label>
                            <input type="text"
                                class="items-left mt-1 rounded-md border-gray-500 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                v-model="pic.phone_mobile" />
                        </div>

                        <div class="grid grid-cols-2 items-center">
                            <label class="ml-7">Phone No.(Office)</label>
                            <input type="text"
                                class="items-left mt-1 rounded-md border-gray-500 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                v-model="pic.phone_office" />
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit"
                            class="mt-4 px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 item">
                            Save
                        </button>
                    </div>
                </form>
            </div>

            <div>
                <div>
                    <table class="grid grid-cols-2 border-2 m-4">
                        <tr class="grid grid-cols-2 ">
                            <td class="px-1 py-1 text-s leading-5 text-gray-900 whitespace-no-wrap">Name</td>
                            <td class="px-1 py-1 text-s leading-5 font-bold text-gray-900 whitespace-no-wrap">{{
                                    pic.name
                            }}</td>
                        </tr>

                        <tr class="grid grid-cols-2 ">
                            <td class="px-1 py-1 text-s leading-5 text-gray-900 whitespace-no-wrap">Email</td>
                            <td class="px-1 py-1 text-s leading-5 font-bold text-gray-900 whitespace-no-wrap">{{
                                    pic.email
                            }}</td>
                        </tr>
                        <tr class="grid grid-cols-2 ">
                            <td class="px-1 py-1 text-s leading-5 text-gray-900 whitespace-no-wrap">Phone No.
                                (Mobile)
                            </td>
                            <td class="px-1 py-1 text-s leading-5 font-bold text-gray-900 whitespace-no-wrap">{{
                                    pic.phone_mobile
                            }}</td>
                        </tr>
                        <tr class="grid grid-cols-2 ">
                            <td class="px-1 py-1 text-s leading-5 text-gray-900 whitespace-no-wrap">Phone No.
                                (Office)
                            </td>
                            <td class="px-1 py-1 text-s leading-5 font-bold text-gray-900 whitespace-no-wrap">{{
                                    pic.phone_office
                            }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div v-else>
        <div>
            <h3>No PIC data</h3>
        </div>
    </div>


</template>

<script>
import GoBack from '../utils/GoBack.vue';

export default {

    data() {
        return {
            info: '',
            contact_infos: [],
            form: {
                contact_id: '',
                name: '',
                email: '',
                phone_mobile: '',
                phone_office: '',
            },
            disabled: 0

        }
    },
    mounted() {
        this.showIncharge()
    },
    methods: {
        showIncharge() {
            axios
                .get("/api/incharge/info/" + this.$route.params.id)
                .then((res) => {
                    this.contact_infos = res.data.data;
                }).catch((error) => {
                    console.log(error);
                });
        },

        updatePIC() {
            axios
                .put("/api/incharges/update/" + this.$route.params.id, {
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
    components: { GoBack }
}

</script>