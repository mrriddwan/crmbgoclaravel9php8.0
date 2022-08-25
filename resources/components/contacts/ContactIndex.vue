<template>
    <div>
        <div>
            <div class="text-center border-black rounded-md font-bold text-xl text-black uppercase">
                <h2 class="text-center">Contact List</h2>
            </div>

            <div
                class="flex flex-col items-left justify-between p-2 pr-4 bg-white border-b border-gray-200 dark:border-gray-700 dark:bg-grey-800 sm:flex-row sm:items-left">
                <div for="status-filter" class="flex items-left space-x-2 sm:space-x-3 w-max">
                    <div class="inline-row">
                        <div>
                            <label class="px-20 item-left">Status</label>
                        </div>
                        <select
                            class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            @change="getStatus" v-model="selectedStatus">
                            <option value="">All</option>
                            <option v-for="status in statuses" :key="status.id" :value="status.id">
                                {{ status.name }}
                            </option>
                        </select>
                    </div>

                    <div class="inline-row items-center">
                        <div>
                            <label>Filter By</label>
                        </div>
                        <select
                            class="w-max rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            >
                            <option disabled value="">Please select one</option>
                            <option value="name">Company Name</option>
                            <option value="user">CS</option>
                            <option value="type">Type</option>
                            <option value="industry">Industry</option>
                            <option value="category">Category</option>
                            <option value="color">Color</option>
                        </select>
                        <input type="text"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="company" @change="searchCompany" />
                    </div>

                    <div class="inline-row items-center">
                        <div>
                            <div>
                                <label>Sort By</label>
                            </div>

                            <select
                                class="w-max rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                >
                                <option value="date">Date</option>
                                <option value="name">Company Name</option>
                                <option value="color">Color</option>
                            </select>
                        </div>

                        <div>
                            <select
                                class="w-max rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                >
                                <option value="Asc">Ascending</option>
                                <option value="Desc">Descending</option>
                                <option value="color">Color</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            <div class="flex items-left space-x-2 sm:space-x-3 w-max m-5 align-bottom">
                Showing
                <form>
                    <input type="number" placeholder="100"
                        class=" m-2 align-top h-8 block mt-1 w-20 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        v-model="totalEntry" />
                </form>
                of 100 Entries
            </div>

            <router-link to="/contacts_create"
                class="mr-10 mb-10 inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Create contact</router-link>

            <div class="overflow-scroll max-h-80 content-center">
                <table class="container max-h-60 w-full">
                    <thead class=" text-white border max-h-10 ">
                        <tr>
                            <th class="px-2 py-1 bg-gray-50">
                                <span
                                    class="text-xs font-small tracking-wider leading-4 text-left text-gray-500 uppercase">Date</span>
                                    <!-- <img id="sort-arrow" @click="" src="../icons/icons8-drop-down-32.png" class=""/> -->
                                <!-- <img src="../resources/icons/icons8-drop-down-32.png" alt=""> -->
                            </th>
                            <th class="px-2 py-3 bg-gray-50">
                                <span
                                    class="text-xs font-small tracking-wider leading-4 text-left text-gray-500 uppercase">CS</span>
                            </th>
                            <th class="px-2 py-3 bg-gray-50">
                                <span
                                    class="text-xs font-small tracking-wider leading-4 text-left text-gray-500 uppercase">Status</span>
                            </th>
                            <th class="px-2 py-3 bg-gray-50">
                                <span
                                    class="text-xs font-small tracking-wider leading-4 text-left text-gray-500 uppercase">Type</span>
                            </th>
                            <th class="px-2 py-3 bg-gray-50">
                                <span
                                    class="text-xs font-small tracking-wider leading-4 text-left text-gray-500 uppercase">Industry</span>
                            </th>
                            <th class="px-2 py-3 bg-gray-50">
                                <span
                                    class="text-xs font-small tracking-wider leading-4 text-left text-gray-500 uppercase">Company</span>
                            </th>
                            <th class="px-2 py-3 bg-gray-50">
                                <span
                                    class="text-xs font-small tracking-wider leading-4 text-left text-gray-500 uppercase">Category</span>
                            </th>

                            <th class="px-2 py-3 bg-gray-50">
                                <span
                                    class="text-xs font-small tracking-wider leading-4 text-left text-gray-500 uppercase">Address</span>
                            </th>

                            <th class="px-2 py-3 bg-gray-50">
                                <span
                                    class="text-xs font-small tracking-wider leading-4 text-left text-gray-500 uppercase">Remark</span>
                            </th>
                            <th class="px-2 py-3 bg-gray-50">
                                <span
                                    class="text-xs font-small tracking-wider leading-4 text-left text-gray-500 uppercase">Action</span>
                            </th>
                        </tr>
                    </thead>


                    <tbody class="overflow-y-scroll">
                        <tr v-for="contact in contacts.data" :key="contact.id">
                            <td class="px-2 py-4 text-xs leading-5 text-gray-900 whitespace-no-wrap">
                                {{ contact.created_at }}
                            </td>
                            <td class="px-2 py-4 text-xs leading-5 text-gray-900 whitespace-no-wrap">
                                {{ contact.user.name }}
                            </td>
                            <td class="px-2 py-4 text-xs leading-5 text-gray-900 whitespace-no-wrap">
                                {{ contact.status.name }}
                            </td>
                            <td class="px-2 py-4 text-xs leading-5 text-gray-900 whitespace-no-wrap">
                                {{ contact.type.name }}
                            </td>
                            <td class="px-2 py-4 text-xs leading-5 text-gray-900 whitespace-no-wrap">
                                {{ contact.industry }}
                            </td>
                            <td @click="showContactInfo"
                                class="px-2 py-4 text-xs leading-5 text-gray-900 whitespace-no-wrap">
                                {{ contact.name }}
                                <router-link :to="{
                                    name: 'contacts_info',
                                    params: { id: contact.id },
                                }"
                                    class="inline-flex items-left m-2 px-2 py-1 bg-yellow-800 border border-black rounded-md font-bold text-xs text-black uppercase">
                                    ?
                                </router-link>
                            </td>
                            <td class="px-2 py-4 text-xs leading-5 text-gray-900 whitespace-no-wrap">
                                {{ contact.category.name }}
                            </td>
                            <td class="px-2 py-4 text-xs leading-5 text-gray-900 whitespace-no-wrap">
                                {{ contact.address }}
                            </td>
                            <td class="px-2 py-4 text-xs leading-5 text-gray-900 whitespace-no-wrap">
                                {{ contact.remark }}
                            </td>

                            <td>
                                <div class="btn-group" role="group">
                                    <router-link :to="{
                                        name: 'contacts_edit',
                                        params: { id: contact.id },
                                    }"
                                        class="mr-2 mb-2 inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        Edit</router-link>
                                    <button
                                        class="mr-2 mb-2 inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
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
            statuses: [],

            selectedStatus: [],

            entry: "",
            company: "",

            selectedColumn: 'none',
            sortDirection: 'unchanged',

        };
    },

    watch() {
        totalEntry();
        searchCompany();
    },

    mounted() {
        this.getStatus();
        this.getContacts()
    },

    methods: {
        searchCompany() {

        },

        totalEntry() {

        },

        getContacts(page = 1) {
            if (typeof page === "undefined") {
                page = 1;
            }
            axios
                .get("/api/contacts/index?page=" + page)
                .then((res) => {
                    this.contacts = res.data;
                    console.log(res.data.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        showContactInfo() {
            this.$router.push('/contacts/{:id}/info' + this.contact.id);
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

<!-- <template>
    <table id="fifthTable">
        <thead>
            <tr>
                <th v-for="col in columns" v-on:click="sortTable(col)">{{ col }}
                    <div class="arrow" v-if="col == sortColumn" v-bind:class="ascending ? 'arrow_up' : 'arrow_down'">
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="row in rows">
                <td v-for="col in columns">{{ row[col] }}</td>
            </tr>
        </tbody>
    </table>
</template>
<script>
// var fifthTable = new Vue({
export default {

    data() {
        return {
            ascending: false,
            sortColumn: '',
            rows: [
                { id: 1, name: "Chandler Bing", phone: '305-917-1301', profession: 'IT Manager' },
                { id: 2, name: "Ross Geller", phone: '210-684-8953', profession: 'Paleontologist' },
                { id: 3, name: "Rachel Green", phone: '765-338-0312', profession: 'Waitress' },
                { id: 4, name: "Monica Geller", phone: '714-541-3336', profession: 'Head Chef' },
                { id: 5, name: "Joey Tribbiani", phone: '972-297-6037', profession: 'Actor' },
                { id: 6, name: "Phoebe Buffay", phone: '760-318-8376', profession: 'Masseuse' }
            ]
        }

    },
    methods: {
        "sortTable": function sortTable(col) {
            if (this.sortColumn === col) {
                this.ascending = !this.ascending;
            } else {
                this.ascending = true;
                this.sortColumn = col;
            }

            var ascending = this.ascending;

            this.rows.sort(function (a, b) {
                if (a[col] > b[col]) {
                    return ascending ? 1 : -1
                } else if (a[col] < b[col]) {
                    return ascending ? -1 : 1
                }
                return 0;
            })
        }
    },
    computed: {
        "columns": function columns() {
            if (this.rows.length == 0) {
                return [];
            }
            return Object.keys(this.rows[0])
        }
    }

}


</script> -->



<!-- <style scoped>
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
</style> -->