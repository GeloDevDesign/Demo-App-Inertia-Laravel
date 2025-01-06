import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import { createPinia } from "pinia";
import { router } from "@inertiajs/vue3";
import NProgress from "nprogress";
import Layout from "./Pages/Shared/Layout.vue";
import Login from "./Pages/Auth/Login.vue";

const pinia = createPinia();
router.on("start", () => NProgress.start());
router.on("finish", () => NProgress.done());

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || Layout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.use(plugin)
            .use(pinia)
            .component("Head", Head)
            .component("Link", Link);
        app.mount(el);
    },

    progress: {
        // The delay after which the progress bar will appear, in milliseconds...
        delay: 50,

        // The color of the progress bar...
        color: "#29d",

        // Whether to include the default NProgress styles...
        includeCSS: true,

        // Whether the NProgress spinner will be shown...
        showSpinner: false,
    },
});
