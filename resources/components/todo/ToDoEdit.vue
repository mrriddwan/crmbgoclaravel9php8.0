<template>
    <div
        class="container w-max-10 border-4 align-center mx-auto h-max px-5 py-5"
    >
        <div>
            <GoBack />
        </div>

        <div
            class="items-center text-center text-white font-extrabold bg-slate-600 px-2 py-2 rounded-md"
        >
            <h1 class="px-2 py-3 bg-black-50">Edit To Do</h1>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <form @submit.prevent="insertToDo">
                    <div>
                        <label
                            for="large-toggle"
                            class="inline-flex relative items-center cursor-pointer"
                        >
                            <input
                                type="checkbox"
                                value="1"
                                id="large-toggle"
                                class="sr-only peer"
                            />
                            <div
                                class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
                            ></div>
                            <span
                                class="ml-3 text-md font-extrabold uppercase text-black"
                                >Urgent</span
                            >
                        </label>
                    </div>
                    <div class="form-group">
                        <label>User</label>
                        <select
                            class="block mt-1 w-max rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="todo.user_id"
                            @change="getUsers"
                        >
                            <option disabled value="">Please select one</option>
                            <option
                                v-for="user in users"
                                :key="user.id"
                                :value="user.id"
                            >
                                <!-- {{ todo.user.name }} -->
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date of Task</label>
                        <input
                            type="date"
                            class="block mt-1 w-max rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="todo.date_created"
                        />
                    </div>
                    <div class="form-group">
                        <label>Deadline of Task</label>
                        <input
                            type="date"
                            class="block mt-1 w-max rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="todo.date_deadline"
                        />
                    </div>

                    <div class="form-group">
                        <label>Contact Status</label>
                        <select
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="todo.status_id" @change="getStatus">
                            <option disabled value="">Please select one</option>
                            <option v-for="status in statuses" :key="status.id" :value="status.id">
                                <!-- {{ status.name }} -->
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Contact Type</label>
                        <select
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="todo.type_id" @change="getType">
                            <option disabled value="">Please select one</option>
                            <option v-for="type in types" :key="type.id" :value="type.id">
                                // {{ todo.name }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Contact Name</label>
                        <select
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="todo.contact_id" @change="getContact">
                            <option disabled value="">Please select one</option>
                            <option v-for="contact in contacts" :key="contact.id" :value="contact.id">
                                <!-- {{ todo.name }} -->
                            </option>
                        </select>
                    </div>             

                    <div class="form-group">
                        <label>Task</label>
                        <select
                            class="block mt-1 w-max rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="todo.task_id"
                            @change="getTasks"
                        >
                            <option disabled value="">Please select one</option>
                            <option
                                v-for="task in tasks"
                                :key="task.id"
                                :value="task.id"
                            >
                                <!-- {{ todo.user.name }} -->
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Remark</label>
                        <textarea
                            type="text"
                            class="block mt-1 w-60 w-max-100 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="todo.remark"
                        />
                    </div>

                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 mt-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                    >
                        Create
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import GoBack from "../utils/GoBack.vue";
import axios from "axios";

export default {
    data() {
        return {
            todo: {
                priority_id: "",
                user_id: "",
                date_created: "",
                date_deadline: "",
                status_id: "",
                type_id: "",
                contact_id: "",
                task_id: "",
                remark: "",
            },
            tasks: [],
            contacts:[],
            statuses: [],
            types: [],
            users: []
        };
    },

    mounted() {
        // this.getStatus();
    },

    methods: {
        insertToDo() {
            axios
                .post("/api/contacts/store", {
                    type_id: this.form.type_id,
                    industry: this.form.industry,
                    status_id: this.form.status_id,
                    name: this.form.name,
                    category_id: this.form.category_id,
                    address: this.form.address,
                    remark: this.form.remark,
                })
                .then((res) => {
                    this.$router.push({ name: "contact_index" });
                });
        },

        getTasks() {
            axios
                .get("/api/todotasks/index")
                .then((res) => {
                    this.tasks = res.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    components: { GoBack },
};
</script>