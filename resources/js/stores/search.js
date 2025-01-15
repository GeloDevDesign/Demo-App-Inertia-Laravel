import { defineStore } from "pinia";


export const useUserSearchStore = defineStore("search", {
    state: () => ({
        searchValue: null,
        filterValue: null // State property
    }),
    getters: {},
    actions: {},
});
