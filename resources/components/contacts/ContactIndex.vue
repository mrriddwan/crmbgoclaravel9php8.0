<template>
    <h1
        class="items-center text-center text-6xl text-white font-extrabold bg-slate-400 px-2 py-2 rounded-md"
    >
        Contact Index
    </h1>

    <router-link
        to="/contacts/create"
        class="m-2 inline-block items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-m text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
    >
        Create to do</router-link
    >

    <router-link
        to="/todo/index"
        class="m-3 inline-block items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-m text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
    >
        To Do Index</router-link
    >

    <div class="">
        <div class="grid grid-cols-2 items-center">
            <div class="grid grid-cols-2 items-left m-2">
                <label for="paginate" class="">Per Page</label>
                <select v-model="paginate" class="form-control">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>
            </div>

            <div>
                <input
                    v-model.lazy="search"
                    type="search"
                    class="form-control"
                    placeholder="Search by any..."
                />
            </div>
        </div>

        <Pagination
            :data="contacts"
            @pagination-change-page="getContacts"
            :size="'small'"
            :align="'center'"
            class="pagination"
        />

        <div>
            <table class="table table-hover table-bordered" id="example">
                <thead>
                    <tr>
                        <th>
                            <a
                                href="#"
                                @click.prevent="change_sort('created_at')"
                            >
                                Date Created
                            </a>
                            <span
                                v-if="
                                    sort_direction == 'desc' &&
                                    sort_field == 'created_at'
                                "
                                >&uarr;</span
                            >
                            <span
                                v-if="
                                    sort_direction == 'asc' &&
                                    sort_field == 'created_at'
                                "
                                >&darr;</span
                            >
                        </th>
                        <th>
                            <a
                                href="#"
                                @click.prevent="change_sort('user_name')"
                            >
                                CS
                            </a>
                            <span
                                v-if="
                                    sort_direction == 'desc' &&
                                    sort_field == 'user_name'
                                "
                                >&uarr;</span
                            >
                            <span
                                v-if="
                                    sort_direction == 'asc' &&
                                    sort_field == 'user_name'
                                "
                                >&darr;</span
                            >
                        </th>
                        <th>
                            <a
                                href="#"
                                @click.prevent="change_sort('status_name')"
                            >
                                Status
                            </a>
                            <span
                                v-if="
                                    sort_direction == 'desc' &&
                                    sort_field == 'status_name'
                                "
                                >&uarr;</span
                            >
                            <span
                                v-if="
                                    sort_direction == 'asc' &&
                                    sort_field == 'status_name'
                                "
                                >&darr;</span
                            >
                            <select
                                v-model="selectedStatus"
                                class="form-control form-control-sm"
                            >
                                <option value="">All</option>
                                <option
                                    v-for="status in statuses.data"
                                    :key="status.id"
                                    :value="status.id"
                                >
                                    {{ status.name }}
                                </option>
                            </select>
                        </th>
                        <th>
                            <a
                                href="#"
                                @click.prevent="change_sort('type_name')"
                            >
                                Type
                            </a>
                            <span
                                v-if="
                                    sort_direction == 'desc' &&
                                    sort_field == 'type_name'
                                "
                                >&uarr;</span
                            >
                            <span
                                v-if="
                                    sort_direction == 'asc' &&
                                    sort_field == 'type_name'
                                "
                                >&darr;</span
                            >
                        </th>
                        <th>
                            <a
                                href="#"
                                @click.prevent="change_sort('industry')"
                            >
                                Industry
                            </a>
                            <span
                                v-if="
                                    sort_direction == 'desc' &&
                                    sort_field == 'industry'
                                "
                                >&uarr;</span
                            >
                            <span
                                v-if="
                                    sort_direction == 'asc' &&
                                    sort_field == 'industry'
                                "
                                >&darr;</span
                            >
                        </th>
                        <th>
                            <a
                                href="#"
                                @click.prevent="change_sort('name')"
                            >
                                Contact
                            </a>
                            <span
                                v-if="
                                    sort_direction == 'desc' &&
                                    sort_field == 'name'
                                "
                                >&uarr;</span
                            >
                            <span
                                v-if="
                                    sort_direction == 'asc' &&
                                    sort_field == 'name'
                                "
                                >&darr;</span
                            >
                        </th>
                        <th>
                            <a
                                href="#"
                                @click.prevent="change_sort('category_name')"
                            >
                                Category
                            </a>
                            <span
                                v-if="
                                    sort_direction == 'desc' &&
                                    sort_field == 'category_name'
                                "
                                >&uarr;</span
                            >
                            <span
                                v-if="
                                    sort_direction == 'asc' &&
                                    sort_field == 'category_name'
                                "
                                >&darr;</span
                            >
                        </th>
                        <th>
                            <a
                                href="#"
                                @click.prevent="change_sort('address')"
                            >
                                Address
                            </a>
                            <span
                                v-if="
                                    sort_direction == 'desc' &&
                                    sort_field == 'address'
                                "
                                >&uarr;</span
                            >
                            <span
                                v-if="
                                    sort_direction == 'asc' &&
                                    sort_field == 'address'
                                "
                                >&darr;</span
                            >
                        </th>
                        <th>
                            <a href="#" @click.prevent="change_sort('remark')">
                                Remark
                            </a>
                            <span
                                v-if="
                                    sort_direction == 'desc' &&
                                    sort_field == 'remark'
                                "
                                >&uarr;</span
                            >
                            <span
                                v-if="
                                    sort_direction == 'asc' &&
                                    sort_field == 'remark'
                                "
                                >&darr;</span
                            >
                        </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="contact in contacts.data" :key="contact.id">
                        <td>{{ contact.created_at }}</td>
                        <td>{{ contact.user.name }}</td>
                        <td>{{ contact.status.name }}</td>
                        <td>{{ contact.type.name }}</td>
                        <td>{{ contact.industry }}</td>
                        <td>
                            <router-link
                                :to="`/contacts/${contact.id}/info`"
                                custom
                                v-slot="{ navigate, href }"
                            >
                                <a :href="href" @click.stop="navigate">{{
                                    contact.name
                                }}</a>
                            </router-link>
                        </td>
                        <td>{{ contact.category.name }}</td>
                        <td>{{ contact.address }}</td>
                        <td>{{ contact.remark }}</td>
                        <td>
                            <router-link
                                :to="{
                                    name: 'todo_insert',
                                    params: { id: contact.id },
                                }"
                                class="mr-2 mb-2 inline-flex items-center px-2 py-1 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                            >
                                Add To Do</router-link
                            >
                            <router-link
                                :to="{
                                    name: 'contacts_edit',
                                    params: { id: contact.id },
                                }"
                                class="mr-2 mb-2 inline-flex items-center px-2 py-1 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                            >
                                Edit</router-link
                            >
                            <button
                                class="mr-2 mb-2 inline-flex items-center px-2 py-1 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                @click="deletecontact(contact.id)"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import LaravelVuePagination from "laravel-vue-pagination";
import axios from "axios";
// import "bootstrap/dist/css/bootstrap.min.css";

export default {
    components: {
        Pagination: LaravelVuePagination,
    },

    mounted() {
        this.getContacts();
        this.getStatus();
    },
    data() {
        return {
            contacts: [],
            paginate: 10,

            search: "",
            selectedStatus: "",

            sort_direction: "desc",
            sort_field: "created_at",
            statuses: "",
        };
    },
    watch: {
        paginate: function (value) {
            this.getContacts();
        },
        search: function (value) {
            this.getContacts();
        },
        selectedStatus: function (value) {
            this.getContacts();
        },
    },

    methods: {
        getContacts(page = 1) {
            if (typeof page === "undefined") {
                page = 1;
            }
            axios
                .get(
                    "/api/contacts/index?" +
                        "q=" +
                        this.search +
                        "&selectedStatus=" +
                        this.selectedStatus +
                        "&paginate=" +
                        this.paginate +
                        "&page=" +
                        page +
                        "&sort_direction=" +
                        this.sort_direction +
                        "&sort_field=" +
                        this.sort_field
                )
                .then((res) => {
                    this.contacts = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getStatus() {
            axios
                .get("/api/contactstatus/index")
                .then((res) => {
                    this.statuses = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        change_sort(field) {
            if (this.sort_field == field) {
                this.sort_direction =
                    this.sort_direction == "asc" ? "desc" : "asc";
            } else {
                this.sort_field = field;
            }
            this.getContacts();
        },

        searchType() {},

        deletecontact(id) {
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
    @import "bootstrap/dist/css/bootstrap.min.css";
</style>