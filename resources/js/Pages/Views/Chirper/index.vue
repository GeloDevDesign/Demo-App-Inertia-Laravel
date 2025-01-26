<script setup>
import { ref } from "vue";
import pagination from "../../Components/pagination.vue";

const props = defineProps({
    chirps: Object, // The list of chirps is passed as a prop
});
</script>

<template>
    <Head :title="'Chirps Index'" />
    <div class="flex justify-end mb-4"></div>
    <div class="flex justify-end mb-2">
        <Link class="btn btn-sm btn-primary" :href="route('chirps.create')">
            Create
        </Link>
    </div>
    <div>
        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Message</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(message, index) in props.chirps.data"
                        :key="message.id"
                    >
                        <th>{{ index + 1 }}</th>
                        <td>{{ message.user.name }}</td>
                        <td>{{ message.message }}</td>
                        <td>{{ message.created_at }}</td>
                        <td>
                            <!-- Use the canEdit field to show the Edit button -->
                            <Link
                              
                                class="btn btn-sm btn-secondary"
                                :href="route('chirps.edit', message.id)"
                            >
                                Edit
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <pagination :users="chirps" />
    </div>
</template>
