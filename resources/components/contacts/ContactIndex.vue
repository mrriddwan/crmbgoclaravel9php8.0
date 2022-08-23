<template>
    <div>
        <div >
            <!-- <div class="text-center border-black rounded-md font-bold text-xl text-black uppercase">
                <h2 class="text-center">Contact List</h2>
            </div> -->

            <router-link to="/contacts_create"
                class="mr-10 mb-10 inline-flex items-center px-1 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Create contact</router-link>

            <router-link to="/contacts_edit"
                class="inline-flex items-center px-1 py-1 m-5 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Edit contact (test)</router-link>

            <router-link to="/contacts_info"
                class="inline-flex items-center px-1 py-1 m-5 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Contact Info Page (test)</router-link>
                
            <router-link to="/contacts_history"
                class="inline-flex items-center px-1 py-1 m-5 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Contact History (test))</router-link>

            <router-link to="/incharge_createinfo"
                class="inline-flex items-center px-1 py-1 m-5 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Contact PIC (test))</router-link>

            


            <table class="table">
                <thead>
                    <tr>
                        <th class="px-1 py-1 bg-gray-50">
                            <span
                                class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Date</span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50">
                            <span
                                class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">CS</span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50">
                            <span
                                class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Status</span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50">
                            <span
                                class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Type</span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50">
                            <span
                                class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Industry</span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50">
                            <span
                                class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Company</span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50">
                            <span
                                class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Category</span>
                        </th>

                        <th class="px-6 py-3 bg-gray-50">
                            <span
                                class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Address</span>
                        </th>

                        <th class="px-6 py-3 bg-gray-50">
                            <span
                                class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Remark</span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50">
                            <span
                                class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Action</span>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="contact in contacts.data" :key="contact.id" class="align-content-center;">
                        <td class="px-3 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ contact.created_at }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ contact.user.name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ contact.status.name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ contact.type.name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ contact.industry }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ contact.name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ contact.category.name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ contact.address }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ contact.remark }}
                        </td>

                        <!-- <td v-if="contact.department_id === null"
                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            <span id="no-department-bubble">
                                No department
                            </span>
                        </td>
                        <td v-else class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            <span id="department-bubble">
                                {{ contact.department.name }}
                            </span>
                        </td> -->

                        <!-- <td v-if="contact.roles.length === 0"
                            class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            <span id="no-role-bubble"> No role(s) </span>
                        </td>
                        <td v-else class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            <span v-for="role in contact.roles" :key="role.id" id="role-bubble">
                                {{ role.name }}
                            </span>
                        </td> -->

                        <td>
                            <div class="btn-group" role="group">
                                <router-link :to="{
                                    name: 'contacts_edit',
                                    params: { id: contact.id },
                                }"
                                    class="mr-2 mb-2 inline-flex items-center px-1 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Edit</router-link>
                                <button
                                    class="mr-2 mb-2 inline-flex items-center px-1 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                    @click="deleteContact(contact.id)">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

export default {
    components: {

    },

    data() {
        return {
            contacts: [],
            departments: [],
        };
    },

    created() {
        this.getContacts()
    },

    methods: {
        // getContacts(page = 1) {
        // if (typeof page === "undefined") {
        //     page = 1;
        // }
        // axios
        //     .get("/api/contacts/index?page=" + page)

        getContacts() {
            axios
                .get("/api/contacts/index?page=")
                .then((res) => {
                    this.contacts = res.data;
                    console.log(res.data.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        deleteContact(id) {
            if (!window.confirm("Are you sure?")) {
                return;
            }
            axios.delete("/api/contacts/delete/" + id);
            this.getContacts();
        },
    },
};
</script>

<style scoped>
#role-bubble {
    border-radius: 6px;
    background-color: rgb(45 212 191);
    border-color: rgb(45 212 191);
    border-width: 6px;
    margin: 3px;
}

#no-role-bubble {
    border-radius: 6px;
    background-color: rgb(253 230 138);
    border-color: rgb(253 230 138);
    border-width: 6px;
    margin: 3px;
}

#department-bubble {
    border-radius: 6px;
    background-color: rgb(103 232 249);
    border-color: rgb(103 232 249);
    border-width: 6px;
    margin: 3px;
}

#no-department-bubble {
    border-radius: 6px;
    background-color: rgb(253 230 138);
    border-color: rgb(253 230 138);
    border-width: 6px;
    margin: 3px;
}
</style>