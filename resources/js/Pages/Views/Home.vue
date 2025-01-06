<script setup>
import { ref } from "vue";
import Nav from "../Shared/Nav.vue";
import navLinks from "../Components/navLink.vue";
import Layout from "../Shared/Layout.vue";

defineProps({
    time: String,
});

layout:Layout


</script>

<template>
    
        <div class="flex h-full">
           
            <div
                class="flex w-full h-full justify-center items-center flex-col gap-2"
            >
                <h1 class="p-8 bg-gray-800 rounded-xl">
                    <span class="text-red-300">{{ time }}</span>
                </h1>
                <navLinks page="/home" preserve-scroll
                    >Refresh
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                        />
                    </svg>
                </navLinks>
            
            </div>
        </div>
  
</template>
