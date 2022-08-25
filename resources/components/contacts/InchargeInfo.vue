<template>
        <div v-if="incharge_infos === null">
            <span>No PIC data</span>
        </div>

        <div v-else class="flex row-auto">
            <table v-for="info in incharge_infos">
                <thead>
                    <tr>
                        <th>
                            PIC - {{ info.contact }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{{ info.name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ info.email }}</td>
                    </tr>
                    <tr>
                        <td>Phone No. (Mobile)</td>
                        <td>{{ info.phone_no1 }}</td>
                    </tr>
                    <tr>
                        <td>Phone No. (Office)</td>
                        <td>{{ info.phone_no2 }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

</template>

<script>
import GoBack from '../utils/GoBack.vue';

export default {
    data() {
        return {
            form: {
                name: '',
                email: '',
                phone_no1: '',
                phone_no2: '',
            },
            incharge_infos: []
        };
    },

    created () {
        this.showIncharge()
    }, 
    methods: {
        showIncharge() {
            axios
                .get("api/incharges/show/" + this.$route.params.id)
                .then((res) => {
                    this.incharge_infos = res.data.data;
                }).catch((error) => {
                    console.log(error);
                });
        }
    },
    
    components: { GoBack }
};
</script>