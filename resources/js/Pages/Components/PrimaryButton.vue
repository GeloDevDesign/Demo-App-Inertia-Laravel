<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    routeName: String,
    buttonName: String,
    disabled: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <Link class="btn btn-primary w-full" :href="route(routeName)">
        {{ buttonName }}
    </Link>
</template>
