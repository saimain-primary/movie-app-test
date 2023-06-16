import { createRouter, createWebHistory } from "vue-router";
import WelcomePage from "../pages/Welcome.vue";
const routes = [
    {
        path: "/",
        name: "home",
        component: WelcomePage,
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;
