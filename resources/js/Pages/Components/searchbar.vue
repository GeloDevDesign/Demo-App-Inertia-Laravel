<script setup>
import { watch } from "vue";
import { useUserSearchStore } from "../../stores/search.js";
const store = useUserSearchStore();
watch(() => [store.searchValue, store.filterValue], store.debouncedSearch, {
    deep: true,
});
</script>

<template>
    <div class="flex items-center  join">
        
        <label class="input input-bordered flex items-center gap-2 join-item">
            <input v-model="store.searchValue" type="text" class="grow " placeholder="Search" />
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 16 16"
                fill="currentColor"
                class="h-4 w-4 opacity-70"
            >
                <path
                    fill-rule="evenodd"
                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                    clip-rule="evenodd"
                />
            </svg>
        </label>
        <select
            v-model="store.filterValue"
            class="select select-bordered w-full max-w-xs join-item"
        >
            <option selected value="">All</option>
            <option value="Admin">Admin</option>
            <option value="Moderator">Moderator</option>
            <option value="Guest">Guest</option>
            <option value="User">User</option>
        </select>
    </div>
</template>
