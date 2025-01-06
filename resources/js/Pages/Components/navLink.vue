<script setup>

const props = defineProps({
    page: String,
    componenName: String
});

</script>

<template>
    <Link class="btn " data-inertia-link data-inertia-prefetch  :href="route(props.page)" :class="$page.url.startsWith(componenName) ? 'btn-primary': 'btn-ghost'">
        <slot/>
    </Link>
</template>
