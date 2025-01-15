<script setup>
import { ref } from "vue";
import Nav from "../Shared/Nav.vue";
import navLinks from "../Components/navLink.vue";
import Layout from "../Shared/Layout.vue";
import pagination from "../Components/pagination.vue"
import { useHelperStore } from "../../stores/helper.js";
import searchbar from "../Components/searchbar.vue";

const store = useHelperStore();

const props = defineProps({
    users: Object,
    searchTerm: String,
});

store.searchValue = props.searchTerm || ""; 

</script>

<template>
    <Head :title="$page.component"> </Head>
        <div class="flex justify-end mb-4">
            <searchbar/>
        </div>
    <div class="overflow-x-auto bg-base-100 h-4/5 rounded-lg">
        <table class="table table-pin-rows">
            <!-- head -->
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
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
                                           userItem.avatar !== null
                                                ? `storage/${userItem.avatar}`
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
                        {{ store.getDate(userItem.created_at)  }}
                    </td>

                    <td>
                        {{ userItem.role  }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <pagination :users="users"/>
    <!-- Refactored pagination -->
   
</template>
