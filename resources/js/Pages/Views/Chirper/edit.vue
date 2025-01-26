<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    chirp: Object, // The chirp to edit is passed as a prop
});

// Initialize the form with the chirp data
const form = useForm({
    message: props.chirp.message,
});

// Update the form
const updateForm = () => {
    form.put(route("chirps.update", props.chirp.id), {
        onSuccess: () => {
            console.log("Message updated successfully!");
        },
        onError: (errors) => {
            console.log("Errors:", errors);
        },
    });
};

// Delete the chirp
const deleteForm = () => {
    form.delete(route("chirps.destroy", props.chirp.id), {
        onSuccess: () => {
            console.log("Chirp deleted successfully!");
        },
        onError: (errors) => {
            console.log("Errors:", errors);
        },
    });
};
</script>

<template>
    <Head :title="'Edit Message'" />
    <div class="flex justify-end mb-4"></div>

    <div class="card bg-base-100 w-96 shadow-xl">
        <div class="card-body">
            <h2 class="card-title">Edit Message</h2>
            <!-- Message input -->
            <textarea
                v-model="form.message"
                placeholder="Edit your message"
                class="textarea textarea-bordered w-full max-w-xs mb-4"
            ></textarea>
            <div class="card-actions justify-end">
                <!-- Delete Button -->
                <button
                    class="btn btn-error"
                    :disabled="form.processing"
                    @click="deleteForm"
                >
                    Delete
                </button>

                <!-- Update Button -->
                <button
                    class="btn btn-primary"
                    :disabled="form.processing"
                    @click="updateForm"
                >
                    Update Message
                </button>
            </div>
        </div>
    </div>
</template>
