<script setup>
import { ref, computed } from "vue";
import navLink from "../Components/navLink.vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const showLayout = computed(() => {
    return page.props.auth.user.username;
});
</script>

<template>
    <section
        class=" w-52 p-4 flex flex-col justify-between h-full items-center"
    >
        <div class="flex flex-col items-center gap-8 w-full">
            <div class="w-full flex items-center gap-2">
                <div class="w-14 aspect-square bg-white rounded-full"></div>
                <span class="font-semibold">Agendra Pro</span>
            </div>
            <div class="flex flex-col gap-2 w-full">
                <navLink page="home" componenName="/">Home</navLink>
                <navLink page="welcome" componenName="/welcome"
                    >Welcome</navLink
                >
            </div>
        </div>
        <div>
            <Link
                :href="route('logout')"
                method="POST"
                as="button"
                class="btn btn-neutral"
                >Logout</Link
            >
        </div>
    </section>
</template>
