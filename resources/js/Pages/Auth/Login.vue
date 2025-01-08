<script setup>
import { Link } from "@inertiajs/vue3";
import navLink from "../Components/navLink.vue";

defineOptions({
    layout: null,
});
</script>

<template>
    <Head>
        <title>Login</title>
        <meta name="description" content="this is meta tag" />
    </Head>

    <div class="w-full flex justify-center items-center h-full">
        <div class="max-w-lg flex justify-center items-center flex-col gap-4">
            <h1 class="text-center text-2xl font-bold">Login Page</h1>
            <p class="text-center opacity-75 bg-gray-800 p-2 rounded-lg">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum
                perspiciatis officiis aliquam nisi veritatis quasi et iure odit
                neque, qui sint animi assumenda totam aperiam itaque repellendus
                a aut molestias repellendus a aut mole stias repellendus a aut
                molestias.
            </p>
             
            <navLink  page="home"
                >Login</navLink
            >
           
            <navLink  page="register"
                >Register</navLink
            >
        </div>
    </div>
</template>
