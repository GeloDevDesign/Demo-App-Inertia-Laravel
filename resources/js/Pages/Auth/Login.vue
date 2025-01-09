<script setup>
import { Link } from "@inertiajs/vue3";
import navLink from "../Components/navLink.vue";
import inputTag from "../Components/input.vue";
defineOptions({
    layout: null,
});
</script>

<template>
    <Head>
        <title>Login</title>
        <meta name="description" content="this is meta tag" />
    </Head>

    <div class="flex justify-center items-center h-full flex-col">
        <div>
            <span class="font-semibold text-lg"> Welcome Back</span>
        </div>
        <div class="w-96">
            <inputTag type="text" name="name" pagename="Username" />
            <inputTag type="text" name="name" pagename="Password" />
        
        </div>
    </div>
</template>
