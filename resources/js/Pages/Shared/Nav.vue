<script setup>
import { ref, computed } from "vue";
import navLink from "../Components/navLink.vue";
import { storeToRefs } from "pinia";
import { userSideNav } from "../../stores/sidenav.js";

const store = userSideNav();

const { navLinks,isCollapse,collapseSideNav } = storeToRefs(store);

</script>

<template>
    <section
        class="py-4 px-2 flex flex-col justify-between h-full items-center transition-all duration-100 ease-in-out"
        :class="store.isCollapse ? 'w-52' : 'w-16'"
    >
        <div class="flex flex-col items-center w-full">
            <div class="w-full flex items-center gap-2 border-b-[1px] pb-4">
                <div class="flex justify-start items-center gap-4 py-4">
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
                </div>
                <p v-if="isCollapse" class="font-semibold">Agenda Pro</p>
            </div>

            <div class="w-full border-b-[1px] justify-between flex">
                <div class="flex justify-start items-center gap-4 py-4">
                    <div class="avatar placeholder">
                        <div
                            class="bg-neutral text-neutral-content w-10 rounded-full"
                        >
                            <img
                                class="avatar"
                                :src="'storage/' + $page.props.auth.user.avatar"
                                alt="user-image"
                            />
                        </div>
                    </div>

                    <div class="flex flex-col" v-if="isCollapse">
                        <span class="text-base font-semibold">{{
                            $page.props.auth.user.name
                        }}</span>
                        <span class="text-sm opacity-60">Superadmin</span>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex flex-col gap-2 w-full py-4">
                <navLink
                    v-for="link in navLinks"
                    :key="link.page"
                    :page="link.page"
                    :componenName="link.componentName"
                    :collapse="isCollapse"
                >
                    <template #icon>
                        <span v-html="link.icon"></span>
                    </template>
                    {{ link.label }}
                </navLink>
            </div>
        </div>

        <div class="w-full flex justify-center">
            <button
                @click="store.collapseSideNav"
                class="btn w-full flex btn-ghost"
                :class="isCollapse ? 'justify-start' : 'justify-center'"
            >
                <span>
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
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"
                        />
                    </svg>
                </span>
                <span v-if="isCollapse">Collapse</span>
            </button>
        </div>
    </section>
</template>
