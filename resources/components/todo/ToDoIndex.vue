<template>
    <h1
        class="items-center text-center text-6xl text-white font-extrabold bg-slate-400 px-2 py-2 rounded-md"
    >
        To Do Index
    </h1>

    <router-link
        to="/todo/create"
        class="m-2 inline-block items-center px-2 py-1 bg-blue-800 border border-transparent rounded-md font-semibold text-m text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
    >
        Create to do</router-link
    >
    <router-link
        to="/dashboard"
        class="m-2 inline-block items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-m text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
    >
        Contact Index</router-link
    >

    <div class="">
        <div class="grid grid-cols-2 items-center">
            <div class="grid grid-cols-2 items-center">
                <div class="grid grid-rows-2 items-center text-center">
                    <label for="listByDayOrMonth" class="">View By</label>
                    <select v-model="viewType" class="form-control text-center">
                        <option value="day">Day</option>
                        <option value="month">Month</option>
                    </select>
                </div>
                <span v-if="viewType === `day`">
                    <div
                        class="grid grid-rows-2 items-center text-center px-2 w-max"
                    >
                        <label for="listByDayOrMonth" class=""
                            >Select date</label
                        >
                        <input
                            v-model.lazy="selectedDate"
                            class="border-gray-300"
                            type="date"
                        />
                    </div>
                </span>
                <span v-else>
                    <div
                        class="grid grid-rows-2 items-center text-center px-2 w-max"
                    >
                        <label for="listByDayOrMonth" class=""
                            >Select month</label
                        >
                        <input
                            v-model.lazy="selectedMonth"
                            class="border-gray-300"
                            type="month"
                        />
                    </div>
                </span>
            </div>

            <div class="grid grid-rows-2 items-center text-center px-2 w-max">
                <label for="searchAny" class="text-center px-2"
                    >Search term</label
                >
                <input
                    v-model.lazy="search"
                    type="search"
                    class="form-control"
                    placeholder="Search by any..."
                />
            </div>

            <div class="grid grid-cols-3 items-center text-center m-2 w-max">
                <label for="paginate" class="px-2">Entry</label>
                <select v-model="paginate" class="form-control">
                    <option value="10">10</option>
                    <option value="20">50</option>
                    <option value="30">100</option>
                </select>
                <label for="paginate" class="px-2">of 100 entries</label>
            </div>

            <div class="grid grid-cols-2 items-center">
                <label for="chooseUser" class="text-right px-2">User</label>
                <select v-model="selectedUser" class="form-control">
                    <option value="">All User</option>
                    <option
                        v-for="user in users"
                        :key="user.id"
                        :value="user.id"
                    >
                        {{ user.name }}
                    </option>
                </select>
            </div>
        </div>

        <div class="py-2">
            <Pagination
                :data="todos"
                @pagination-change-page="getToDos"
                :size="'small'"
                :align="'center'"
                class="pagination"
            />
        </div>

        <!-- <div>this is the selected day: {{ getSelectedDay() }}</div>
        <div>this is the selected month: {{ getSelectedMonth() }}</div>
        <div>this is the selected year: {{ getSelectedYear() }}</div> -->

        <div class="grid grid-cols-3 w-full text-center">
            <div class="text-left">
                <button class="text-5xl text-left">&larr;</button>
            </div>
            <span v-if="viewType === `day`">
                <div class="">
                    <h3 class="uppercase font-extrabold">
                        {{ showToday(selectedDate) }}
                    </h3>
                </div>
            </span>
            <span v-else>
                <div>
                    <h3 class="uppercase font-extrabold">
                        {{ showMonth(selectedMonth) }}
                    </h3>
                </div>
            </span>
            <div class="text-right">
                <button class="text-5xl text-right">&rarr;</button>
            </div>
        </div>

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
                            <span v-else> Unset yet </span>
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
                            <select class="form-control form-control-sm">
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
                                class="mr-2 mb-2 inline-flex items-center px-2 py-1 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                            >
                                <i class="fa-solid fa-pen-to-square"></i
                                >Edit</router-link
                            >
                            <button
                                class="mr-2 mb-2 inline-flex items-center px-2 py-1 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
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
import moment from "moment";

export default {
    components: {
        Pagination: LaravelVuePagination,
    },

    mounted() {
        this.getStatus();
        this.getActions();
        this.getUsers();
        //initial date selection
        this.currentDate = this.showToday();
        console.log(this.currentDate)
        this.selectedDate = this.currentDate;

        //initial month selection
        this.currentMonth = `${this.getSelectedMonth()}`;
        console.log(this.currentMonth)
        this.selectedMonth = this.currentMonth;

        this.getToDos();
    },
    data() {
        return {
            moment: moment,
            todos: [],
            paginate: 10,
            viewType: "day",
            search: "",

            statuses: "",
            selectedStatus: "",
            users: "",
            selectedUser: 1,

            currentDate: "",
            currentMonth: "",
            currentYear: "",

            selectedDate: "",
            selectedMonth: "",
            selectedYear: "",

            sort_direction: "desc",
            sort_field: "todo_created",
            actions: "",
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

        selectedDate: function (value) {
            if (this.viewType === "day") {
                this.selectedMonth = "";
                this.getSelectedDate();
                this.getToDos();
            }
        },

        selectedMonth: function (value) {
            if (this.viewType === "month") {
                this.selectedDate = "";
                this.selectedMonth = moment(this.selectedMonth).format("MM");
                this.getToDos();
            }
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
                        "&selectedDate=" +
                        this.selectedDate +
                        "&selectedMonth=" +
                        this.selectedMonth +
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

        getUsers() {
            axios
                .get("/api/users/index")
                .then((res) => {
                    this.users = res.data.data;
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

        showToday(date) {
            let month = moment(date).format("YYYY-MM-DD");
            return month;
        },

        showMonth(date) {
            let month = moment(date.toString()).format("MMMM-YYYY");
            return month;
        },

        getSelectedDate() {
            this.currentDate = this.selectedDate;
            this.showToday(this.currentDate);
            return this.currentDate;
        },

        getSelectedDay() {
            let day = moment(this.currentDate).format("DD");
            return day;
        },

        getSelectedMonth() {
            let month = moment(this.currentDate).format("YYYY-MM");
            return month;
        },

        getSelectedYear() {
            let year = moment(this.currentDate).format("YYYY");
            return year;
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

<style scoped>
@import "bootstrap/dist/css/bootstrap.min.css";
</style>
