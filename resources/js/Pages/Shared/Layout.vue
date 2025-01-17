<script setup>
import Nav from "./Nav.vue";
import { ref, computed } from "vue";
import { storeToRefs } from "pinia";
import { userSideNavStore } from "../../stores/sidenav.js";
const store = userSideNavStore();
</script>

<template>
    <section
        class="p-4 flex transition-all duration-100 ease-in-out h-full bg-base-200"
        :class="store.isCollapse ? 'ml-56' : 'ml-16'"
    >
        <header class="fixed top-0 bottom-0 left-0">
            <Nav />
        </header>

        <div class="w-full fixed right-6 z-50 max-w-96">
            <div role="alert" class="alert alert-success">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 shrink-0 stroke-current"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
                <span>Your purchase has been confirmed!</span>
            </div>
        </div>

        <div class="w-full mx-2">
            <div class="mt-2">
                <slot />
            </div>
        </div>
    </section>
</template>
