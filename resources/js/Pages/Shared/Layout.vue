<script setup>
import Nav from "./Nav.vue";
import { ref, computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const showLayout = computed(() => {
    return page.props.auth.user.username === "Angelo";
});

</script> 

<template>
    <section class="p-6">
        <header v-if="showLayout">
            <Nav />
        </header>

        <div>
          
            <slot name="pagename"></slot>
        </div>

        <div>
            <!-- <span>Welcome Back {{ $page.props.auth.user.username }}</span>   -->
            <slot />
        </div>
    </section>
</template>
