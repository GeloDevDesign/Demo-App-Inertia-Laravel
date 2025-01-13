<script setup>
import { ref, computed } from "vue";
import navLink from "../Components/navLink.vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const showLayout = computed(() => {
    return page.props.auth.user;
});
</script>

<template>
    <section
        v-if="showLayout"
        class="w-52 py-4 px-2 flex flex-col justify-between h-full items-center"
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

        <div class="w-full gap">
            <div
                class="flex justify-start items-center gap-4 border-b-[1px] pb-4"
            >
                <div class="avatar placeholder">
                    <div
                        class="bg-neutral text-neutral-content w-12 rounded-full"
                    >
                        <img
                            class="avatar"
                            :src="'storage/' + $page.props.auth.user.avatar"
                            alt="user-image"
                        />
                    </div>
                </div>

                <div class="flex flex-col">
                    <span class="text-lg font-semibold">{{
                        $page.props.auth.user.name
                    }}</span>
                    <span class="text-sm opacity-60">Superadmin</span>
                </div>
            </div>
            <div class="flex gap-2 items-center mt-2">
                <Link
                    :href="route('logout')"
                    method="POST"
                    as="button"
                    class="btn btn-ghost"
                    ><div class="w-full flex items-center justify-between gap-2">
                        <span class="text-base">Logout</span>
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
                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25"
                            />
                        </svg></div
                ></Link>
            </div>
        </div>
    </section>
  
</template>
