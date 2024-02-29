<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Add User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add User</h2><div class="container">
            <h2>User Details</h2>
            <form @submit.prevent="addUser">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" v-model="userData.name" />
                </div>
                <div class="form-group">
                    <label for="surname">Surname:</label>
                    <input type="text" id="surname" v-model="userData.surname" />
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" v-model="userData.email" />
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" v-model="userData.phone" />
                </div>
                <div class="form-group">
                    <label for="idNumber">ID Number (13 digits):</label>
                    <input type="text" id="idNumber" v-model="userData.id_number" />
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" v-model="userData.birth_date" />
                </div>
                <div class="form-group">
                    <label for="language">Language:</label>
                    <select id="language" v-model="userData.language">
                        <option value="english">English</option>
                        <option value="spanish">Spanish</option>
                        <option value="french">French</option>
                        <option value="german">German</option>
                        <option value="italian">Italian</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="hobbies">Hobbies:</label>
                    <select id="hobbies" multiple v-model="userData.interests">
                        <option v-for="hobby in interests" :key="hobby" :value="hobby">{{ hobby }}</option>
                    </select>
                </div>
                <button type="submit" class="add-btn">Add User</button>
            </form>
        </div>



        </template>

    </AuthenticatedLayout>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            userData: {
                name: '',
                surname: '',
                email: '',
                phone: '',
                id_number: '',
                language: '',
                birth_date: '',
                interests: []
            },
            interests: ['Reading', 'Cooking', 'Hiking', 'Gardening', 'Painting', 'Photography', 'Knitting', 'Dancing', 'Traveling', 'Playing Music']
        };
    },
    methods: {
        async addUser() {
            try {
                const response = await axios.post('/api/workers', this.userData);
                console.log('User added successfully:', response.data);
                // Optionally, you can redirect to another page or show a success message
                // After successful addition
            } catch (error) {
                console.error('Error adding user:', error);
            }
        }
    }
};
</script>

<style scoped>
.container {
    margin: 20px;
}

h2 {
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
select,
input[type="date"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

select[multiple] {
    height: 150px; /* Set a fixed height for the dropdown */
}

option {
    padding: 10px;
}

select:hover {
    border-color: #aaa; /* Change border color on hover */
}

.add-btn {
    padding: 10px 20px;
    background-color: #4caf50;
    border: none;
    color: #fff;
    cursor: pointer;
    border-radius: 4px;
}

.add-btn:hover {
    background-color: #45a049;
}
</style>



