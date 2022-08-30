<template>
    <div>
        <router-link
            to="/todo/create"
            class="m-5 inline-block items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-m text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
        >
            Create to do</router-link
        >
        <router-link
            to="/todo/edit"
            class="m-5 inline-block items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-m text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
        >
            Edit to do</router-link
        >

        <router-link
            to="/todo/index2"
            class="m-5 inline-block items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-m text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
        >
            Index 2 To Do</router-link
        >
    </div>
    <DataTable
        :columns="columns"
        :data="data"
        class="display cell-border"
        width="100%"
        :options="options"
    />
</template>

<script>
import DataTable from "datatables.net-vue3";

import axios from "axios";

export default {
    components: {
        DataTable,
    },

    data() {
        return {
            data: [],
            data2: [],
            options: {
                responsive: true,
                autoWidth: false,
                destroy: true,
                deferRender: true,
            },
            columns: [
                { data: "id", title: "#", width: "1%" },
                {
                    data: "todo_created",
                    title: "Date Started",
                    width: "10%",
                    className: "dt-body-center dt-head-center",
                },
                {
                    data: "todo_deadline",
                    title: "Date Deadline",
                    width: "10%",
                    className: "dt-body-center dt-head-center",
                },
                {
                    data: "status.name",
                    title: "Status",
                    width: "10%",
                    className: "dt-body-center dt-head-center",
                },
                {
                    data: "type.name",
                    title: "Type",
                    width: "10%",
                    className: "dt-body-center dt-head-center",
                },
                {
                    data: "contact.name",
                    title: "Contact",
                    width: "10%",
                    className: "dt-body-center dt-head-center",
                },
                {
                    data: "task.name",
                    title: "Task",
                    width: "10%",
                    className: "dt-body-center dt-head-center",
                },
                {
                    data: "remark",
                    title: "Remark",
                    width: "10%",
                    className: "dt-body-center dt-head-center",
                },
                {
                    data: null,
                    title: "Action",
                    className: "dt-body-center dt-head-center",
                    wrap: true,
                    width: "10%",
                    
                },
                {
                    data: null,
                    title: "-",
                    className: "dt-body-center dt-head-center",
                    wrap: true,
                    width: "10%",
                    render: function () {
                        let buttons =
                            '<a href="/todo/:id/edit" class="edit btn btn-warning btn-xs btn-flat"><i class="fas fa-edit"></i></a> ';
                        buttons +=
                            '<a https="#" class="delete btn btn-danger btn-xs btn-flat"><i class="fas fa-trash-alt"></i></a>';
                        return buttons;
                    },
                },
            ],
        };
    },
    mounted() {
        this.getToDos();
    },

    methods: {
        async getToDos() {
            const response = await axios.get("/api/todos/index");
            this.data = response.data.data;
        },
    },
};
</script>

<!-- <template>
    <div>
        <router-link
            to="/todo/create"
            class="m-5 inline-block items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-m text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
        >
            Create to do</router-link
        >
    </div>
    <div>
        <DataTable :data="data" :columns="columns" :options="options" class="table m-5" width="100%">
            <thead class="px-3 py-3 border-2">
                <tr>
                    <th class="px-3 py-3 border-2">#</th>
                    <th class="px-3 py-3 border-2">Source</th>
                    <th class="px-3 py-3 border-2">Date</th>
                    <th class="px-3 py-3 border-2">Deadline</th>
                    <th class="px-3 py-3 border-2">Status</th>
                    <th class="px-3 py-3 border-2">Type</th>
                    <th class="px-3 py-3 border-2">Contact</th>
                    <th class="px-3 py-3 border-2">Task</th>
                    <th class="px-3 py-3 border-2">Remark</th>
                    <th class="px-3 py-3 border-2">Completed</th>
                    <th class="px-3 py-3 border-2">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="px-3 py-3 border-2">#</th>
                    <th class="px-3 py-3 border-2">Source</th>
                    <th class="px-3 py-3 border-2">Date</th>
                    <th class="px-3 py-3 border-2">Deadline</th>
                    <th class="px-3 py-3 border-2">Status</th>
                    <th class="px-3 py-3 border-2">Type</th>
                    <th class="px-3 py-3 border-2">Contact</th>
                    <th class="px-3 py-3 border-2">Task</th>
                    <th class="px-3 py-3 border-2">Remark</th>
                    <th class="px-3 py-3 border-2">Completed</th>
                    <th class="px-3 py-3 border-2">Action</th>
                </tr>
            </tfoot>
        </DataTable>
    </div>
</template> -->
