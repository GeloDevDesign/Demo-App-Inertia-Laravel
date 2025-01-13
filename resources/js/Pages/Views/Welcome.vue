<script setup>
import { ref } from "vue";
import Nav from "../Shared/Nav.vue";
import Layout from "../Shared/Layout.vue";

defineProps({
    time: String,
});
</script>
<template>
    <Head title="Welcome"> </Head>
    <div>
      <h1 class="text-6xl font-bold">Toggle Pesticide</h1>
    </div>
</template>
