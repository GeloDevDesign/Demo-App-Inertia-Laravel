<script setup>
import { usePrefetch, usePage, Link, router } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage(); // Add this to access the $page object

const props = defineProps({
    page: String,
    componenName: String,
});

// const prefetchData = () => {
//     router.prefetch("/users/loadmore", {
//         method: "get",
//         data: { page: props.users.current_page + 1 },
//         cacheFor: '1m'
//     });
// };

const isActive = computed(() => {
    return page.url === props.componenName
        ? "border-b-2 border-primary"
        : "border-none";
});
</script>

<template>
    <div :class="isActive" class="w-full">
        <Link
            class="btn w-full btn-ghost"
            cache-for="1m"
            prefetch
            :href="route(props.page)"
        >
            <slot />
        </Link>
    </div>
</template>
