import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp, Head, Link,useForm } from "@inertiajs/vue3";
import { createPinia } from "pinia";
import { router } from "@inertiajs/vue3";
import NProgress from "nprogress";
import Layout from "./Pages/Shared/Layout.vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

const pinia = createPinia();
router.on("start", () => NProgress.start());
router.on("finish", () => NProgress.done());

createInertiaApp({
    title: (title) => (title ? `${title} - My App` : "My App"),
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];

        page.default.layout =
            page.default.layout === undefined ? Layout : page.default.layout;

        return page;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.use(plugin)
            .use(pinia)
            .use(ZiggyVue)
            .component("Head", Head)
            .component("Link", Link)
            .component("Form",useForm)
        app.mount(el);
    },
    progress: {
        delay: 150,
        color: "#29d",
        includeCSS: true,
        showSpinner: false,
    },
});
