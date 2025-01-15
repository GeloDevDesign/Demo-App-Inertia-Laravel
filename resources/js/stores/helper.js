import { defineStore } from "pinia";

export const useHelperStore = defineStore("helper", {
    state: () => ({}),
    getters: {},
    actions: {
        getDate(date) {
            return new Date(date).toLocaleDateString("en-us", {
                year: "numeric",
                month: "long",
                day: "numeric",
            });
        },
    },
});
