<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="w-full flex justify-center items-center h-full">
        <div class="max-w-lg flex justify-center items-center flex-col gap-4">
            <h1 class="text-center text-2xl font-bold">Login Page</h1>
            <p class="text-center opacity-75 bg-gray-800 p-2 rounded-lg">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum
                perspiciatis officiis aliquam nisi veritatis quasi et iure odit
                neque, qui sint animi assumenda totam aperiam itaque repellendus
                a aut molestias repellendus a aut molestias repellendus a aut
                molestias.
            </p>
            <Link href="/home" class="btn btn-primary">Login</Link>
        </div>
    </div>
</template>
