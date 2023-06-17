<template>
    <!-- navbar -->
    <Navbar />
    <!-- content -->
    <MovieCardGrid title="🎬 All Movies" />
    <MovieCardGrid title="⭐️ Top Rated" />
    <MovieCardGrid title="😊 Recommended" />
</template>

<script setup>
import MovieCardGrid from "../components/MovieCardGrid.vue";
import Navbar from "../components/Navbar.vue";
</script>

<style lang="scss" scoped></style>
