<script setup>
import { ref } from "vue";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";

import pagination from "../../Components/pagination.vue";

dayjs.extend(relativeTime);

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
                        <td>{{ dayjs(message.created_at).fromNow() }}</td>
                        <td>
                            <Link
                                class="btn btn-sm btn-primary btn-outline"
                                :href="route('chirps.edit', message.id)"
                            >
                                Edit
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <pagination :users="chirps" />
</template>
