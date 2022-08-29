import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function toDoComposables () {
    const users = ref([])

    const contacts = ref([])
    const contact = ref([])

    const statuses = ref([])
    const categories = ref([])
    const types = ref([])
    const tasks = ref([])

    const router = useRouter()
    const errors = ref('')

    const getContacts = async () => {
        let response = await axios.get('/api/contacts/index')
        contacts.value = response.data.data;
    }

    const getContact = async (id) => {
        let response = await axios.get('/api/contacts/new/' + id)
        contact.value = response.data.data;
    }

    const getUsers = async () => {
        let response = await axios.get('/api/user/index')
        users.value = response.data.data;
    }

    const getTasks = async () => {
        let response = await axios.get(`/api/tasks/index`)
        tasks.value = response.data.data;
    }


    const storeToDo = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/todos/insert', data)
            await router.push({name: 'todo_index'})
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
        getContacts,
        getContact,

        contact,
        contacts,

        errors,

        getUsers,
        users,

        getTasks,
        tasks,
        
        storeToDo,
        updateCompany,
        destroyCompany
    }
}