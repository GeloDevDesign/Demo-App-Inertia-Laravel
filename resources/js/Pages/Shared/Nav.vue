<script setup>
import { ref, computed } from "vue";
import navLink from "../Components/navLink.vue";
import { usePage } from "@inertiajs/vue3";

const isCollapse = ref(false);

const page = usePage();

const showLayout = computed(() => {
    return page.props.auth.user;
});

const collapseSideNav = () => {
    isCollapse.value = !isCollapse.value;
};


</script>

<template>
    <section
        v-if="showLayout"
        class="py-4 px-2 flex flex-col justify-between h-full items-center transition-all-300"
        :class="isCollapse ? 'w-52' : 'w-16'"
    >
        <div class="flex flex-col items-center w-full transition-all-300">
            <div class="w-full flex items-center gap-2 border-b-[1px] pb-8">
                <div class="w-14 aspect-square bg-white rounded-full"></div>
                <span v-if="isCollapse" class="font-semibold text-lg"
                    >Agenda Pro</span
                >
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

                <div
                    v-if="isCollapse"
                    class="flex gap-2 items-center justify-center mb-2 z-50"
                >
                    <div class="dropdown dropdown-end">
                        <div
                            tabindex="0"
                            role="button"
                            class="btn btn-xs btn-ghost"
                        >
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
                                    d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z"
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
                            class="dropdown-content menu bg-base-100 rounded-box z-[1] w-48 p-2 shadow border-[1px]"
                        >
                            <li><a>Item 1</a></li>
                            <li><a>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2 w-full py-4">
                <navLink page="home" componenName="/">
                    <template v-if="isCollapse" #name>
                        Task Management
                    </template>
                    <template #icon>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                            />
                        </svg>
                    </template>
                </navLink>
                <navLink page="welcome" componenName="/welcome"
                    ><template v-if="isCollapse" #name> welcome </template>
                    <template #icon>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                            />
                        </svg> </template
                ></navLink>
            </div>
        </div>

        <div class="w-full flex justify-center transition-all-300">
            <button
                @click="collapseSideNav"
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
