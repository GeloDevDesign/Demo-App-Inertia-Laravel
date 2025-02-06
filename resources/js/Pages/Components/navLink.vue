<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage(); // Access the $page object

const props = defineProps({
    page: String,
    componenName: String,
    collapse: Boolean,
});

const isActive = computed(() => {
    // If either page.url matches props.componentName or some other URL condition, make it active
    if (page.url === props.componenName) {
        return 'btn-active btn-primary';
    } else {
        return 'btn-ghost';
    }
});


</script>

<template>
    <div class="w-full">
        <Link
            class="btn w-full btn-sm font-normal flex justify-start"
            cache-for="1m"
            :class="isActive"
            prefetch
            :href="route(props.page)"
        >
            <slot name="icon" />
            <slot v-if="collapse" />
        </Link>
    </div>
</template>
