<script setup>
import Nav from "./Nav.vue";
import { ref, computed } from "vue";

// const showLayout = computed(() => {
//     return page.props.auth.user.username === "Angelo";
// });
</script>

<template>
    <section class="p-6 flex gap-10 h-full">
        <header>
            <Nav />
        </header>
        <div >
            <div>
                <slot name="pagename"></slot>
            </div>

            <div>
                <!-- <span>Welcome Back {{ $page.props.auth.user.username }}</span>   -->
                <slot />
            </div>
        </div>
    </section>
</template>
