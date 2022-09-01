<template>
    <GoBack />

    <h3>Company History - Syarikat Buah Bhd.</h3>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>CS</th>
                <th>Task</th>
                <th>Action</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>12-08-22</td>
                <td>Ali</td>
                <td>Payment</td>
                <td>Deposit done</td>
                <td>Need to meet at 5pm</td>
            </tr>
        </tbody>
    </table>

    <span v-for="todo in contact_todo" :key="todo.id">
        <h3>Company History - {{ todo.contact.name }}</h3>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>CS</th>
                    <th>Task</th>
                    <th>Action</th>
                    <th>Remark</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ todo.created_at }}</td>
                    <td>{{ todo.user.name }}</td>
                    <td>{{ todo.task }}</td>
                    <td>{{ todo.user.name }}</td>
                    <td>{{ todo.remark }}</td>
                </tr>
            </tbody>
        </table>
    </span>
</template>

<script>
import GoBack from "../utils/GoBack.vue";

export default {
    components: { GoBack },

    // created() {
    //     getContact()
    // },

    // methods: {
    //     getContact() {

    //     }
    // }
};
</script>
