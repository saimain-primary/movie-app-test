<template>
    <div class="mb-5">
        <router-link
            to="/"
            class="btn btn-sm md:btn btn-neutral md:btn-neutral"
        >
            <ChevronLeftIcon class="w-4 h-4 me-1 inline" />
            <span class="hidden md:block">Go Back</span>
        </router-link>
    </div>
    <div class="mb-10 space-y-4">
        <input
            type="text"
            placeholder="Movie Title"
            class="input input-bordered text-sm w-full"
        />
        <input
            type="text"
            placeholder="Genres"
            class="input input-bordered text-sm w-full"
        />
        <textarea
            class="textarea textarea-bordered w-full mb-2"
            placeholder="Movie Summary"
            rows="6"
        ></textarea>
        <button class="btn btn-sm btn-primary">Submit</button>
    </div>
</template>

<script setup>
import Navbar from "../components/Navbar.vue";
import MovieCardGrid from "../components/MovieCardGrid.vue";
import GenresBadge from "../components/GenresBadge.vue";
import CommentList from "../components/CommentList.vue";
import {
    ChevronLeftIcon,
    StarIcon,
    ArrowDownTrayIcon,
} from "@heroicons/vue/24/solid";
</script>

<style lang="scss" scoped></style>
