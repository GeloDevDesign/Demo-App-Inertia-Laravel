<script setup>
import { ref } from "vue";
import Nav from "../Shared/Nav.vue";
import Layout from "../Shared/Layout.vue";

defineProps({
    time: String,
});




</script>
<template>
    <Head title="Welcome">
      
    </Head>
    <div>
      <span>Welcome </span>
        <header>
            <!-- Render the "pagename" slot if provided -->
            <slot name="pagename"></slot>
        </header>
        <main>
            <!-- Render the default slot content -->
            <slot></slot>
        </main>
    </div>
</template>
