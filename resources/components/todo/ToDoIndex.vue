<template>
    <router-link
        to="/todo/create"
        class="m-5 inline-block items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-m text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
    >
        Create to do</router-link
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
            :data="todos"
            @pagination-change-page="getToDos"
            :size="'small'"
            :align="'center'"
            class="pagination"
        />

        <div>
            <table class="table table-hover table-bordered" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>
                            <a
                                href="#"
                                @click.prevent="change_sort('todo_created')"
                            >
                                Date Created
                            </a>
                            <span
                                v-if="
                                    sort_direction == 'desc' &&
                                    sort_field == 'todo_created'
                                "
                                >&uarr;</span
                            >
                            <span
                                v-if="
                                    sort_direction == 'asc' &&
                                    sort_field == 'todo_created'
                                "
                                >&darr;</span
                            >
                        </th>
                        <th>
                            <a
                                href="#"
                                @click.prevent="change_sort('todo_deadline')"
                            >
                                Date Deadline
                            </a>
                            <span
                                v-if="
                                    sort_direction == 'desc' &&
                                    sort_field == 'todo_deadline'
                                "
                                >&uarr;</span
                            >
                            <span
                                v-if="
                                    sort_direction == 'asc' &&
                                    sort_field == 'todo_deadline'
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
                                @click.prevent="change_sort('contact_name')"
                            >
                                Contact
                            </a>
                            <span
                                v-if="
                                    sort_direction == 'desc' &&
                                    sort_field == 'contact_name'
                                "
                                >&uarr;</span
                            >
                            <span
                                v-if="
                                    sort_direction == 'asc' &&
                                    sort_field == 'contact_name'
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
                                @click.prevent="change_sort('task_name')"
                            >
                                Task
                            </a>
                            <span
                                v-if="
                                    sort_direction == 'desc' &&
                                    sort_field == 'task_name'
                                "
                                >&uarr;</span
                            >
                            <span
                                v-if="
                                    sort_direction == 'asc' &&
                                    sort_field == 'task_name'
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
                        <th>Progress</th>
                        <th>Action</th>
                        <th>-</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="todo in todos.data" :key="todo.id">
                        <td>{{ todo.id }}</td>
                        <td>{{ todo.todo_created }}</td>
                        <td>
                            <span v-if="todo.todo_deadline.length !== 0">
                                {{ todo.todo_deadline }}
                            </span>
                            <span v-else>
                                Unset yet
                            </span>
                        </td>
                        <td>{{ todo.status.name }}</td>
                        <td>{{ todo.type.name }}</td>
                        <td>
                            <router-link
                                :to="`/contacts/${todo.contact.id}/info`"
                                custom
                                v-slot="{ navigate, href }"
                            >
                                <a :href="href" @click.stop="navigate">{{
                                    todo.contact.name
                                }}</a>
                            </router-link>
                        </td>
                        <td>{{ todo.user.name }}</td>
                        <td>{{ todo.task.name }}</td>
                        <td>{{ todo.remark }}</td>
                        <td>Progress indication</td>
                        <td>
                            <select
                                
                                class="form-control form-control-sm"
                            >
                                <option disable value="">Select Action</option>
                                <option
                                    v-for="action in actions.data"
                                    :key="action.id"
                                    :value="action.id"
                                >
                                    {{ action.name }}
                                </option>
                            </select>
                        </td>
                        <td>
                            <router-link
                                :to="{
                                    name: 'todo_edit',
                                    params: { id: todo.id },
                                }"
                                class="mr-2 mb-2 inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                            >
                                Edit</router-link
                            >
                            <button
                                class="mr-2 mb-2 inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                @click="deleteToDo(todo.id)"
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
        this.getToDos();
        this.getStatus();
        this.getActions();
    },
    data() {
        return {
            todos: [],
            paginate: 10,

            search: "",
            selectedStatus: "",

            sort_direction: "desc",
            sort_field: "todo_created",
            actions: "",
            statuses: "",
        };
    },
    watch: {
        paginate: function (value) {
            this.getToDos();
        },
        search: function (value) {
            this.getToDos();
        },
        selectedStatus: function (value) {
            this.getToDos();
        },
    },

    methods: {
        getToDos(page = 1) {
            if (typeof page === "undefined") {
                page = 1;
            }
            axios
                .get(
                    "/api/todos/index?" +
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
                    this.todos = res.data;
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

        getActions() {
            axios
                .get("/api/actions/index")
                .then((res) => {
                    this.actions = res.data;
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
            this.getToDos();
        },

        searchType() {},

        deleteToDo(id) {
            if (!window.confirm("Are you sure?")) {
                return;
            }
            axios.delete("/api/todos/delete/" + id);
            this.getToDos();
        },
    },
};
</script>
