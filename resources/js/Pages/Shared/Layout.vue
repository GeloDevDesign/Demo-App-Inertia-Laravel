<script setup>
import Nav from "./Nav.vue";
import { ref, computed } from "vue";


// const showLayout = computed(() => {
//     return page.props.auth.user.username === "Angelo";
// });

const isCollapse = ref(null);


const collapse = (value) =>{
    isCollapse.value = value
}
</script>

<template>
    <section class="p-4 flex  transition-all duration-100 ease-in-out   h-full" :class="isCollapse ? 'ml-52':'ml-16'">
        <header class="fixed top-0 bottom-0 left-0 border-r-[1px]">
            <Nav @collapse="collapse" />
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
