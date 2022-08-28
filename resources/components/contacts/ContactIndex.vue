<template>

    <div>
        <router-link to="/contacts_create"
            class="mb-5 inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-m text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Create contact</router-link>
    </div>

    <div>

        <vue-good-table :columns="columns" :rows="rows" max-height="800px" :fixed-header="true" :sort-options="{
            enabled: true,
            initialSortBy: { field: 'created_at', type: 'desc' }
        }" :pagination-options="{
    enabled: true,
    mode: 'pages',
    perPage: 10,
    position: 'top',
    perPageDropdown: [20, 50, 100],
    dropdownAllowAll: true,
    setCurrentPage: 1,
    jumpFirstOrLast: true,
    firstLabel: 'First Page',
    lastLabel: 'Last Page',
    nextLabel: 'next',
    prevLabel: 'prev',
    rowsPerPageLabel: 'Entries',
    ofLabel: 'of',
    pageLabel: 'page', // for 'pages' mode
    allLabel: 'All',
    infoFn: (params) => `Page: ${params.firstRecordOnPage}`,
}">
            <template #table-row="props">
                <span v-if="props.column.field === 'name'">
                    <router-link :to="{
                        name: 'contacts_info',
                        params: { id: props.row.id },
                    }" class="text-center items-center align-middle px-1 py-3 mr-2 bg-blue-400 border border-transparent rounded-md font- text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900">
                    i
                    </router-link>
                </span>
                <span v-if="props.column.field == 'action'">
                    <router-link :to="{
                        name: 'contacts_edit',
                        params: { id: props.row.id },
                    }"
                        class="mr-2 mb-2 inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        To Do</router-link>
                    <router-link :to="{
                        name: 'contacts_edit',
                        params: { id: props.row.id },
                    }"
                        class="mr-2 mb-2 inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Edit</router-link>
                    <button
                        class="mr-2 mb-2 inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                        @click="deleteContact(props.row.id)">
                        Delete
                    </button>
                </span>
                <span v-else>
                    {{ props.formattedRow[props.column.field] }}
                </span>
            </template>
        </vue-good-table>
    </div>
</template>

<script>
import 'vue-good-table-next/dist/vue-good-table-next.css'
import { VueGoodTable } from 'vue-good-table-next';

export default {

    components: {
        'vue-good-table': VueGoodTable,
    },

    data() {
        return {

            statuses: '',
            columns: [

                {
                    label: 'Date Created',
                    field: 'created_at',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'dd-MM-yyyy',
                    filterOptions: {
                        styleClass: 'class1', // class to be added to the parent th element
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        filterValue: '', // initial populated value for this filter
                        // filterDropdownItems: [], // dropdown (with selected values) instead of text input
                        filterFn: this.columnFilterFn, //custom filter function that
                        // trigger: 'enter', //only trigger on enter not on keyup 
                    },

                },
                {
                    label: 'CS',
                    field: 'user.name',
                    filterOptions: {
                        styleClass: 'class1', // class to be added to the parent th element
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        filterValue: '', // initial populated value for this filter
                        // filterDropdownItems: [], // dropdown (with selected values) instead of text input
                        filterFn: this.columnFilterFn, //custom filter function that
                        // trigger: 'enter', //only trigger on enter not on keyup 
                    },
                },
                {
                    label: 'Status',
                    field: 'status.name',
                    filterOptions: {
                        styleClass: 'class1', // class to be added to the parent th element
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        filterValue: '', // initial populated value for this filter
                        filterDropdownItems: [
                               { value: 'n', text: 'Inactive' },
                            //    this.statuses                                           
                        ], // dropdown (with selected values) instead of text input
                        filterFn: this.columnFilterFn, //custom filter function that
                        // trigger: 'enter', //only trigger on enter not on keyup 
                    },
                },
                {
                    label: 'Type',
                    field: 'type.name',
                    filterOptions: {
                        styleClass: 'class1', // class to be added to the parent th element
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        filterValue: '', // initial populated value for this filter
                        // filterDropdownItems: [], // dropdown (with selected values) instead of text input
                        filterFn: this.columnFilterFn, //custom filter function that
                        // trigger: 'enter', //only trigger on enter not on keyup 
                    },
                },
                {
                    label: 'Industry',
                    field: 'industry',
                    filterOptions: {
                        styleClass: 'class1', // class to be added to the parent th element
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        filterValue: '', // initial populated value for this filter
                        // filterDropdownItems: [], // dropdown (with selected values) instead of text input
                        filterFn: this.columnFilterFn, //custom filter function that
                        // trigger: 'enter', //only trigger on enter not on keyup 
                    },
                },
                {
                    label: 'Contact Name',
                    field: 'name',
                    filterOptions: {
                        styleClass: 'class1', // class to be added to the parent th element
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        filterValue: '', // initial populated value for this filter
                        // filterDropdownItems: [], // dropdown (with selected values) instead of text input
                        filterFn: this.columnFilterFn, //custom filter function that
                        // trigger: 'enter', //only trigger on enter not on keyup 
                    },
                },
                {
                    label: 'Category',
                    field: 'category.name',
                    filterOptions: {
                        styleClass: 'class1', // class to be added to the parent th element
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        filterValue: '', // initial populated value for this filter
                        // filterDropdownItems: [], // dropdown (with selected values) instead of text input
                        filterFn: this.columnFilterFn, //custom filter function that
                        // trigger: 'enter', //only trigger on enter not on keyup 
                    },
                },
                {
                    label: 'Address',
                    field: 'address',
                    filterOptions: {
                        styleClass: 'class1', // class to be added to the parent th element
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        filterValue: '', // initial populated value for this filter
                        // filterDropdownItems: [], // dropdown (with selected values) instead of text input
                        filterFn: this.columnFilterFn, //custom filter function that
                        // trigger: 'enter', //only trigger on enter not on keyup 
                    },
                },
                {
                    label: 'Remark',
                    field: 'remark',
                    filterOptions: {
                        styleClass: 'class1', // class to be added to the parent th element
                        enabled: true, // enable filter for this column
                        placeholder: 'Filter', // placeholder for filter input
                        filterValue: '', // initial populated value for this filter
                        // filterDropdownItems: [], // dropdown (with selected values) instead of text input
                        filterFn: this.columnFilterFn, //custom filter function that
                        // trigger: 'enter', //only trigger on enter not on keyup 
                    },
                },
                {
                    label: 'Action',
                    field: 'action'
                },

            ],
            rows: [],

        };
    },

    mounted() {
        this.getStatus();
        this.getContacts()
    },

    methods: {
        // getContacts(page = 1) {
        //     if (typeof page === "undefined") {
        //         page = 1;
        //     }
        //     axios
        //         .get("/api/contacts/index?page=" + page)
        //         .then((res) => {
        //             this.rows = res.data.data;
        //             console.log(res.data.data);
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //         });
        // },

        getContacts() {
            axios
                .get("/api/contacts/index")
                .then((res) => {
                    this.rows = res.data.data;
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
                .get("/api/contactstatus/dropdown")
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
    }
};
</script>

