<script setup>

defineProps({
  title: String
})

</script>


<template>
    <h1 class="text-2xl font-semibold text-primary">{{ title || 'No Title' }}</h1>
</template>