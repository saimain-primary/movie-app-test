<template>
    <div class="navbar bg-base-100 mb-10">
        <div class="navbar-start">
            <p
                class="font-medium tracking-wider normal-case text-base md:text-xl"
            >
                🍿 Muuvee DB
            </p>
        </div>
        <div class="navbar-end flex gap-3">
            <div v-if="authStore.user" class="flex items-center gap-5">
                <p class="font-medium text-base">{{ authStore.user.name }}</p>
                <router-link
                    to="/movies/new"
                    class="btn btn-xs btn-primary md:btn md:btn-primary"
                >
                    Add New Movie
                </router-link>
                <button
                    type="button"
                    @click.prevent="logoutHandler"
                    class="btn btn-xs btn-error md:btn md:btn-error"
                >
                    Logout
                </button>
            </div>
            <a
                v-else
                class="btn btn-xs btn-primary md:btn md:btn-primary"
                onclick="loginModal.showModal()"
                >Login</a
            >
        </div>
    </div>
    <dialog id="loginModal" class="modal">
        <form method="dialog" @submit.prevent="loginHandler" class="modal-box">
            <h3 class="font-bold text-lg mb-5">Login Account</h3>
            <div class="form-control w-100 mb-5">
                <label class="label">
                    <span class="label-text">Email Address</span>
                </label>
                <input
                    type="text"
                    v-model="formData.email"
                    class="input input-bordered w-full focus:outline-none"
                />
            </div>
            <div class="form-control w-100 mb-5">
                <label class="label">
                    <span class="label-text">Password</span>
                </label>
                <input
                    type="password"
                    v-model="formData.password"
                    class="input input-bordered focus:outline-none w-full"
                />
            </div>
            <button type="submit" class="btn btn-primary w-full">Login</button>
        </form>
    </dialog>
</template>

<script setup>
import axios from "axios";
import { storeToRefs } from "pinia";
import { ref } from "vue";
import { useAuthStore } from "../store/auth";
const authStore = useAuthStore();

const formData = ref({
    email: "admin@gmail.com",
    password: "password",
});

const loginHandler = async () => {
    try {
        await authStore.loginAction(formData.value);
        loginModal.close();
    } catch (error) {
        console.log(error);
    }
};

const logoutHandler = async () => {
    try {
        await authStore.logoutAction();
    } catch (error) {
        console.log(error);
    }
};
</script>

<style lang="scss" scoped></style>
