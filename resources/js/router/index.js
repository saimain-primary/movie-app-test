import { createRouter, createWebHistory } from "vue-router";
import Welcome from "../pages/Welcome.vue";
import MovieDetail from "../pages/MovieDetail.vue";
import NewMovie from "../pages/NewMovie.vue";
import EditMovie from "../pages/EditMovie.vue";
import MovieList from "../pages/MovieList.vue";
import { useAuthStore } from "../store/auth";
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
    {
        path: "/movies/new",
        name: "new_movies",
        component: NewMovie,
        meta: {
            requireAuth: true,
        },
    },
    {
        path: "/movies/edit/:id",
        name: "edit_movie",
        component: EditMovie,
        meta: {
            requireAuth: true,
        },
    },
    {
        path: "/movies/list",
        name: "movie_list",
        component: MovieList,
        meta: {
            requireAuth: true,
        },
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const token = localStorage.getItem("token");
    const authStore = useAuthStore();
    if (token) {
        await authStore.getMeAction();
    }

    if (to.meta.requireAuth && token == null) {
        next("/");
    } else {
        next();
    }
});

export default router;
