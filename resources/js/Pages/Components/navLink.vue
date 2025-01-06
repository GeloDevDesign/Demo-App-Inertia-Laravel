<script setup>

defineProps({
    page: String,
    componenName: String
});

</script>

<template>
    <Link class="btn " data-inertia-link data-inertia-prefetch  :href="page" :class="$page.url.startsWith(componenName) ? 'btn-primary': 'btn-ghost'">
        <slot/>
    </Link>
</template>
