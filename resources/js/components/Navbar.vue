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
            <a
                class="btn btn-xs btn-primary md:btn md:btn-primary"
                onclick="loginModal.showModal()"
                >Login</a
            >
            <a class="btn btn-xs btn-error md:btn md:btn-error">Logout</a>
        </div>
    </div>
    <dialog id="loginModal" class="modal">
        <form method="dialog" class="modal-box">
            <h3 class="font-bold text-lg mb-5">Login Account</h3>
            <div class="form-control w-100 mb-5">
                <label class="label">
                    <span class="label-text">Email Address</span>
                </label>
                <input
                    type="text"
                    class="input input-bordered w-full focus:outline-none"
                />
            </div>
            <div class="form-control w-100 mb-5">
                <label class="label">
                    <span class="label-text">Password</span>
                </label>
                <input
                    type="password"
                    class="input input-bordered focus:outline-none w-full"
                />
            </div>
            <button class="btn btn-primary w-full">Login</button>
        </form>
    </dialog>
</template>

<script setup></script>

<style lang="scss" scoped></style>
