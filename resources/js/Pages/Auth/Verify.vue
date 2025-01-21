<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import sessionMessage from "../Components/sessionMessage.vue";

defineOptions({
    layout: null,
});

const props = defineProps({
    status: String,
    limit_message: {
        type: String,
        default: "",
    },
});

const form = useForm({});

const submit = () => {
    form.post(route("verification.send"), {
        preserveScroll: true,
        onSuccess: () => {
            // Handle success if needed
        },
        onError: (errors) => {
            // Handle other errors if needed
        },
    });
};
</script>

<template>
    <Head title="Confirm Email">
        <meta name="description" content="Confirm your email to proceed" />
    </Head>

    <div class="flex justify-center h-full items-center p-10">
        <div class="card bg-neutral text-neutral-content max-w-96">
            <div class="card-body items-center text-center gap-6">
                <h2 class="card-title">Confirm Your Email</h2>

                <p>
                    We've sent a confirmation link to your email address. Please
                    check your inbox and click the link to confirm your email.
                </p>

                <form
                    @submit.prevent="submit"
                    class="card-actions flex flex-col items-center"
                >
                    <span
                        v-if="limit_message || status"
                        :class="{
                            'text-error': limit_message,
                            'text-success': status,
                        }"
                        class="text-sm font-semibold mb-2"
                    >
                        {{ limit_message || status }}
                    </span>
                    <button :disabled="form.processing" class="btn btn-primary">
                        Resend Email
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
