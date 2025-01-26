<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

// Define the form with the required fields and initial values
const form = useForm({
    message: "", // Field for the message (or any other data you want)
});

const submitForm = () => {
    form.post(route('chirps.store'), {
        onSuccess: () => {
            console.log("Message created successfully!");
        },
        onError: (errors) => {
            console.log("Errors:", errors);
        },
    });
};
</script>

<template>
    <Head :title="$page.component"> </Head>
    <div class="flex justify-end mb-4"></div>

    <div class="card bg-base-100 w-96 shadow-xl">
        <div class="card-body">
            <h2 class="card-title">Create a New Message</h2>
            <!-- Message input -->
            <textarea
                v-model="form.message"
                placeholder="Type your message"
                class="textarea textarea-bordered w-full max-w-xs mb-4"
            ></textarea>
            <div class="card-actions justify-end">
                <button
                    class="btn btn-primary"
                    :disabled="form.processing"
                    @click="submitForm"
                >
                    Create Message
                </button>
            </div>
        </div>
    </div>
</template>
