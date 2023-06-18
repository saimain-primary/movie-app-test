import axios from "axios";
import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: null,
        token: null,
        count: 0,
        name: "Eduardo",
    }),
    getters: {
        doubleCount: (state) => state.count * 2,
    },
    actions: {
        async loginAction(body) {
            try {
                const { data } = await axios.post(
                    "http://localhost:8000/api/login",
                    body
                );
                const token = data.result.token;
                localStorage.setItem("token", token);
                this.user = data.result.user;
                this.token = token;
                axios.defaults.headers.common[
                    "Authorization"
                ] = `Bearer ${token}`;
            } catch (error) {
                console.log(error);
            }
        },
        async logoutAction() {
            try {
                const response = await axios.post(
                    "http://localhost:8000/api/logout"
                );
                this.user = null;
                this.token = null;
                localStorage.removeItem("token");
            } catch (error) {
                console.log(error);
            }
        },
        async getMeAction() {
            try {
                const token = localStorage.getItem("token");
                axios.defaults.headers.common[
                    "Authorization"
                ] = `Bearer ${token}`;
                const { data } = await axios.get(
                    "http://localhost:8000/api/me"
                );
                console.log(
                    "🚀 ~ file: auth.js:49 ~ getMeAction ~ data:",
                    data
                );
                this.user = data.result;
            } catch (error) {
                this.user = null;
                this.token = null;
                localStorage.removeItem("token");
                console.log(error);
            }
        },
    },
});
