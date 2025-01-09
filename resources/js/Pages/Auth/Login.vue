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

    <div class="flex justify-center items-center h-full">
        <div>
            <span  class="font-semibold font-"> Welcome Back</span>
        </div>
        <div class="w-96">
            <inputTag type="text" name="name" pagename="login" />
        </div>
    </div>
</template>
