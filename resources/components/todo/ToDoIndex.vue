<script setup lang="ts">
import DataTable from "datatables.net-vue3";

const data = [];
</script>

<template>
    <div>
        <DataTable :data="data" class="table m-5" width="100%">
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
</template>
