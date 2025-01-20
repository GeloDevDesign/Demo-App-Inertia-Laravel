<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
  
    buttonName: String,
    disabled: {
        type: Boolean,
        default: false,
    },
});


</script>

<template>
    <button class="btn btn-primary w-full">
        {{ buttonName }}
    </button>
</template>
