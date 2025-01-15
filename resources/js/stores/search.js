import { defineStore } from "pinia";
import debounce from "lodash/debounce";
import { router } from "@inertiajs/vue3"; // Import router if using Inertia

export const useUserSearchStore = defineStore("search", {
    state: () => ({
        searchValue: "",
        filterValue: "" // State property
    }),
    getters: {},
    actions: {
        debouncedSearch: debounce(function () {
            // Use 'this' to access the store's state
            router.get(
                "/",
                { search: this.searchValue, filter: this.filterValue },
                { preserveState: true }
            );
        }, 500),
    },
});
