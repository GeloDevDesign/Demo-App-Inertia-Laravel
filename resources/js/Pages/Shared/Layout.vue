<script setup>
import Nav from "./Nav.vue";
import { ref, computed } from "vue";

// const showLayout = computed(() => {
//     return page.props.auth.user.username === "Angelo";
// });
</script>

<template>
    <section class="p-4 flex ml-52   h-full">
        <header class="fixed top-0 bottom-0 left-0 border-r-[1px]">
            <Nav />
            <div>

            </div>
        </header>
        <div class="w-full" >
            <div>
                <slot name="pagename"></slot>
            </div>

            <div >
                <!-- <span>Welcome Back {{ $page.props.auth.user.username }}</span>   -->
                <slot />
            </div>
        </div>
    </section>
</template>
