<script setup>
import { usePrefetch } from '@inertiajs/vue3'

const props = defineProps({
    page: String,
    componenName: String
});

const prefetch = () => {
    router.prefetch(
        props.page,
        { method: 'get' } // No data parameters passed
    );
};
</script>

<template>
    <Link 
        class="btn" 
        @click="prefetch" 
        prefetch 
        :href="route(props.page)" 
        :class="$page.url.startsWith(componenName) ? 'btn-primary': 'btn-ghost'"
    >
        <slot />
    </Link>
</template>
