<template>
    <div class="mb-10">
        <div class="flex justify-between items-center mb-5">
            <p class="text-sm md:text-lg font-medium tracking-wider">
               {{ title }}
            </p>
            <button class="btn-sm md:btn md:btn-ghost btn-ghost">
                View More
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <MovieCard />
            <MovieCard />
            <MovieCard />
            <MovieCard />
            <MovieCard />
            <MovieCard />
        </div>
    </div>
</template>

<script setup>
import MovieCard from "./MovieCard.vue";

const props = defineProps({
    title: {
        type: String,
        default: "",
    },
});
</script>

<style lang="scss" scoped></style>
