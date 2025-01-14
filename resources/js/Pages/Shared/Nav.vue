<script setup>
import { ref, computed } from "vue";
import navLink from "../Components/navLink.vue";
import { storeToRefs } from "pinia";
import { userSideNav } from "../../stores/sidenav.js";

const store = userSideNav();
const { navLinks, isCollapse } = storeToRefs(store);
</script>

<template>
    <section
        class="py-2 px-2 flex flex-col justify-between h-full items-center transition-all duration-100 ease-in-out"
        :class="isCollapse ? 'w-52' : 'w-16'"
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
                    <div v-if="isCollapse" class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-xs btn-ghost ">
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
                                    d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />
                            </svg>
                        </div>
                        <ul
                            tabindex="0"
                            class="dropdown-content menu bg-base-100 rounded-box z-[1] w-48 p-2 shadow"
                        >
                            <li><a>Item 1</a></li>
                            <li><a>Item 2</a></li>
                        </ul>
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
