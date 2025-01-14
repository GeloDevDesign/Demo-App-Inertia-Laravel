<script setup>
import { ref } from "vue";
import Nav from "../Shared/Nav.vue";
import navLinks from "../Components/navLink.vue";
import Layout from "../Shared/Layout.vue";

defineProps({
    users: Object,
});

const getDate = (date) => {
    return new Date(date).toLocaleDateString("en-us", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
};
</script>

<template>
    <Head :title="$page.component"> </Head>

    <div class="overflow-x-auto bg-base-100 h-4/5">
        <table class="table table-pin-rows">
            <!-- head -->
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                <tr v-for="(userItem, index) in users?.data || []" :key="index">
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle h-12 w-12">
                                    <img
                                        class="avatar"
                                        :src="
                                            $page.props.auth.user.avatar
                                                ? 'storage/' +
                                                  $page.props.auth.user.avatar
                                                : 'storage/avatars/default-image.jpg'
                                        "
                                        alt="user-image"
                                    />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold">{{ userItem.name }}</div>
                                <div class="text-sm opacity-50">
                                    {{ userItem.email }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ getDate(userItem.created_at) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Refactored pagination -->
    <div class="flex justify-between items-center mt-4">
        <div class="text-sm text-gray-600">
            Showing page {{ users.current_page }} of {{ users.last_page }}
        </div>
        <div class="join ">
            <Link
                v-for="(link, index) in users.links"
                :key="link.label"
                :href="link.url"
                class="join-item btn"
                :class="{
                    'btn-primary': link.active,
                    'btn-disabled': !link.url,
                }"
                v-html="link.label"
            />
        </div>
    </div>
</template>
