<script setup>
import Nav from "./Nav.vue";
import { ref, computed } from "vue";
import { storeToRefs } from "pinia";
import { userSideNavStore } from "../../stores/sidenav.js";
const store = userSideNavStore();
</script>

<template>
    <section
        class="p-4  flex transition-all duration-100 ease-in-out h-full bg-base-200"
        :class="store.isCollapse ? 'ml-56' : 'ml-16'"
    >
        <header class="fixed top-0 bottom-0 left-0  ">
            <Nav />
        </header>

        <div class="w-full mx-2">
            
            <div class="mt-2">
                <slot/>
            </div>
        </div>
    </section>
</template>
