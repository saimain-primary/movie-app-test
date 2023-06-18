<template>
    <div class="container py-4">
        <Navbar />
        <router-view />
        <div class="flex items-center justify-between mb-8">
            <p class="text-xs uppercase tracking-wide font-medium">All right reserved to Muuvee DB @ 2023</p>
            <p class="text-xs uppercase tracking-wide font-medium">🥺 Please give me the job offer</p>
        </div>
    </div>
</template>

<script setup>
import Navbar from "./Navbar.vue";
</script>

<style lang="scss" scoped></style>
