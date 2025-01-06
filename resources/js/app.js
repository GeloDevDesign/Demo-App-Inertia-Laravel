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

        if (Layout === undefined) {
            page.default.layout 
        } else {
            page.default.layout  = Layout
        }

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
        delay: 50,
        color: "#29d",
        includeCSS: true,
        showSpinner: false,
    },
});
