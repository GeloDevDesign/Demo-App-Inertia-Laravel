import { defineStore } from "pinia";

export const useUserSearchStore = defineStore("search", {
    state: () => ({
        searchValue: null, // State property
    }),
    getters: {},
    actions: {},
});
