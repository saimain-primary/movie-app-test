import { createRouter, createWebHistory } from "vue-router";
import Welcome from "../pages/Welcome.vue";
import MovieDetail from "../pages/MovieDetail.vue";
const routes = [
    {
        path: "/",
        name: "home",
        component: Welcome,
    },
    {
        path: "/movies/:id",
        name: "detail",
        component: MovieDetail,
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;
