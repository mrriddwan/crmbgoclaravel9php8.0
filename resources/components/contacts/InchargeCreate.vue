<template>

<InchargeInfo/>

<div class="row">
            <div class="col-md-6">
                <form @submit.prevent="createContact">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.name" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.type" />
                    </div>

                    <div class="form-group">
                        <label>Phone No.(Mobile)</label>
                        <input type="phone"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.tel_no1" />
                    </div>

                    <div class="form-group">
                        <label>Phone No.(Office)</label>
                        <input type="phone"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="form.tel_no2" />
                    </div>


                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Save
                    </button>
                </form>
            </div>
        </div>
</template>

<script>
import InchargeInfo from './InchargeInfo.vue';

export default {
    methods: {
        createPIC() {
            axios
                .post("/api/contacts/inchargeCreate", {
                name: this.form.name,
                email: this.form.email,
                phone_no1: this.form.phone_no1,
                phone_no2: this.form.phone_no2,
            })
                .then((res) => {
                this.$router.push({ name: "incharge_create" });
            });
        },
    },
    components: { InchargeInfo }
}

</script>
        
        