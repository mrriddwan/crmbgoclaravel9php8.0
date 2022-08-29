import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function toDoComposables () {
    const users = ref([])
    const statuses = ref([])
    const categories = ref([])
    const types = ref([])
    const tasks = ref([])


    const company = ref([])
    const companies = ref([])
    const router = useRouter()
    const errors = ref('')

    const getCompanies = async () => {
        let response = await axios.get('/api/companies')
        companies.value = response.data.data;
    }

    const getUsers = async () => {
        let response = await axios.get('/user/index')
        users.value = response.data.data;
    }

    const getCompany = async (id) => {
        let response = await axios.get('/api/companies/' + id)
        company.value = response.data.data;
    }

    const storeToDo = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/companies', data)
            await router.push({name: 'companies.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updateCompany = async (id) => {
        errors.value = ''
        try {
            await axios.put('/api/companies/' + id, company.value)
            await router.push({name: 'companies.index'})
        } catch (e) {
            if (e.response.status === 422) {
               errors.value = e.response.data.errors
            }
        }
    }

    const destroyCompany = async (id) => {
        await axios.delete('/api/companies/' + id)
    }


    return {
        companies,
        company,
        errors,

        getCompanies,
        getCompany,
        getUsers,

        storeToDo,
        updateCompany,
        destroyCompany
    }
}