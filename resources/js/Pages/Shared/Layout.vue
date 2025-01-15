<script setup>
import Nav from "./Nav.vue";
import { ref, computed } from "vue";
import { storeToRefs } from "pinia";
import { userSideNav } from "../../stores/sidenav.js";
const store = userSideNav();
</script>

<template>
    <section
        class="p-4  flex transition-all duration-100 ease-in-out h-full bg-base-200"
        :class="store.isCollapse ? 'ml-52' : 'ml-16'"
    >
        <header class="fixed top-0 bottom-0 left-0  ">
            <Nav />
        </header>

        <div class="w-full mx-4 mt-4">
            <div class=" pb-4">
                <h1 class="text-4xl font-bold">Dashboard</h1>
            </div>
            <div class="mt-4">
                <slot/>
            </div>
        </div>
    </section>
</template>
