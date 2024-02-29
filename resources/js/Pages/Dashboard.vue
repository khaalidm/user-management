<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Worker Management" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Worker Management</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="container">
                        <div class="worker-list">
                            <h2>Workers</h2>
                            <ul>
                                <li v-for="worker in workers" :key="worker.id" @click="selectWorker(worker)">
                                    <span>{{ worker.name }}</span>
                                    <button class="delete-btn" @click.stop="deleteWorker(worker.id)">Delete</button>
                                </li>
                            </ul>
                        </div>
                        <div class="worker-details">
                            <h2>Worker Details</h2>
                            <div v-if="selectedWorker">
                                <form @submit.prevent="updateWorker">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" id="name" v-model="selectedWorker.name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="surname">Surname:</label>
                                        <input type="text" id="surname" v-model="selectedWorker.surname" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" v-model="selectedWorker.email" />
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone:</label>
                                        <input type="text" id="phone" v-model="selectedWorker.phone" />
                                    </div>
                                    <div class="form-group">
                                        <label for="language">Language:</label>
                                        <select id="language" v-model="selectedWorker.language">
                                            <option value="english">English</option>
                                            <option value="spanish">Spanish</option>
                                            <option value="french">French</option>
                                            <option value="german">German</option>
                                            <option value="italian">Italian</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="hobbies">Hobbies:</label>
                                        <select id="hobbies" multiple v-model="selectedWorker.hobbies">
                                            <option v-for="hobby in hobbies" :key="hobby" :value="hobby">{{ hobby }}</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="update-btn">Update Worker</button>
                                </form>
                            </div>
                            <div v-else>
                                <p>Select a worker to view details</p>
                            </div>
                        </div>
                    </div>


                </div>
                </div>
            </div>
    </AuthenticatedLayout>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            workers: [],
            selectedWorker: null,
            hobbies: ['Reading', 'Cooking', 'Hiking', 'Gardening', 'Painting', 'Photography', 'Knitting', 'Dancing', 'Traveling', 'Playing Music']
        };
    },
    mounted() {
        this.fetchWorkers();
    },
    methods: {
        async fetchWorkers() {
            try {
                const response = await axios.get('/api/workers');
                this.workers = response.data;
            } catch (error) {
                console.error('Error fetching workers:', error);
            }
        },
        selectWorker(worker) {
            this.selectedWorker = { ...worker };
        },
        async updateWorker() {
            try {
                const response = await axios.put(`/api/workers/${this.selectedWorker.id}`, this.selectedWorker);
                console.log('Worker updated successfully:', response.data);
                // Optionally, you can update the worker in the list after successful update
                const index = this.workers.findIndex(w => w.id === this.selectedWorker.id);
                if (index !== -1) {
                    this.workers[index] = { ...this.selectedWorker };
                }
            } catch (error) {
                console.error('Error updating worker:', error);
            }
        },
        async deleteWorker(workerId) {
            try {
                await axios.delete(`/api/workers/${workerId}`);
                this.workers = this.workers.filter(worker => worker.id !== workerId);
                if (this.selectedWorker && this.selectedWorker.id === workerId) {
                    this.selectedWorker = null; // Clear selected worker if deleted
                }
            } catch (error) {
                console.error('Error deleting worker:', error);
            }
        }
    }
};
</script>

<style scoped>
.container {
    display: flex;
    align-items: flex-start;
    margin: 20px;
}

.worker-list {
    width: 30%;
}

.worker-list h2 {
    margin-bottom: 10px;
}

.worker-list ul {
    list-style-type: none;
    padding: 0;
}

.worker-list li {
    cursor: pointer;
    padding: 5px;
    border-bottom: 1px solid #ccc;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.worker-list li:hover {
    background-color: #f0f0f0;
}

.delete-btn {
    padding: 3px 8px;
    background-color: #ff6347;
    border: none;
    color: #fff;
    cursor: pointer;
    border-radius: 4px;
}

.delete-btn:hover {
    background-color: #e74c3c;
}

.worker-details {
    margin-left: 20px;
    width: 65%;
}

.worker-details h2 {
    margin-bottom: 10px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="text"],
input[type="email"],
select {
    width: 100%; /* Set width to 100% */
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

button {
    padding: 10px 20px;
    background-color: #4caf50;
    border: none;
    color: #fff;
    cursor: pointer;
    border-radius: 4px;
}

button:hover {
    background-color: #45a049;
}
</style>
