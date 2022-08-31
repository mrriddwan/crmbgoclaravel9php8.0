<template>
    <router-link
        to="/todo/create"
        class="m-5 inline-block items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-m text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
    >
        Create to do</router-link
    >

    <table class="table table-hover table-bordered" id="example">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date Created</th>
                <th>Date Deadline</th>
                <th>Status</th>
                <th>Type</th>
                <th>Contact</th>
                <th>CS</th>
                <th>Task</th>
                <th>Remark</th>
                <th>Progress</th>
                <th>Progress</th>
                <th>-</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="todo in todos" :key="todo.id">
                <td>{{ todo.id }}</td>
                <td>{{ todo.todo_created }}</td>
                <td>{{ todo.todo_deadline }}</td>
                <td>{{ todo.status.name }}</td>
                <td>{{ todo.type.name }}</td>
                <td>{{ todo.contact.name }}</td>
                <td>{{ todo.user.name }}</td>
                <td>{{ todo.task.name }}</td>
                <td>{{ todo.remark }}</td>
                <td>Progress indication</td>
                <td>
                    <select>
                        <option>Select action</option>
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
            <!-- <tr>
                <td>Teststs</td>
                <td>Teststs</td>
                <td>Teststs</td>
                <td>Teststs</td>
            </tr> -->
        </tbody>
    </table>
</template>

<script>
//Bootstrap and jQuery libraries
import "bootstrap/dist/css/bootstrap.min.css";
import "datatables.net-dt/css/jquery.dataTables.min.css";
// import DataTable from "datatables.net-vue3";

//Datatable Modules
import "jquery/dist/jquery.min.js";
import "datatables.net-dt/js/dataTables.dataTables";

import $ from "jquery";

import axios from "axios";
export default {
    mounted() {
        this.getToDos();
    },
    data() {
        return {
            todos: [],
        };
    },

    methods: {
        getToDos() {
            axios.get("/api/todos/index").then((res) => {
                this.todos = res.data.data;
                $("#example").DataTable();
            });
        },

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
