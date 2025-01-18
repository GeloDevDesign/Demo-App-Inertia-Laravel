<script setup>
import { ref, computed } from "vue";

const props = defineProps({
    statusCode: Number,
    message: String,
    limit_message: String
});

defineOptions({
    layout: null,
});

const messages = ref({
    400: "Bad Request",
    401: "Unauthorized",
    403: "Access denied.",
    404: "Page not found.",
    408: "Request Timeout",
    422: "Unprocessable Entity",
    426: "Upgrade required.",
    429: "Too Many Requests",
    405: "Request Not Allowed",
    500: "Internal server error.",
    502: "Bad Gateway",
    503: "Service Unavailable",
    504: "Gateway Timeout",
});

const message = computed(() => {
    return messages.value[props.statusCode] || "Unknown Error";
});
</script>

<template>
    <div class="flex items-center justify-center h-full">
        <div class="text-center space-y-4">
            <h1 class="text-xl">Error {{ statusCode }}</h1>
            <p class="text-red-500 text-2xl">Ooops.. {{ message }}</p>
           
            <Link v-if="statusCode !== 429" class="btn" :href="route('home')">
                Go back to home page
            </Link>
        </div>
    </div>
</template>
