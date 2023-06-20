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
    <div class="flex flex-col md:flex-row justify-start gap-10 mb-5">
        <div>
            <img
                class="w-96 h-auto rounded-lg shadow-lg mb-5"
                :src="
                    'http://localhost:8000/storage/images/' +
                    movieDetail?.cover_image
                "
                alt=""
            />
        </div>
        <div class="" v-if="movieDetail">
            <h3 class="text-lg md:text-3xl font-medium tracking-wider mb-3">
                {{ movieDetail?.title }}
            </h3>
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-3">
                    <p class="text-xs font-medium md:text-sm tracking-wider">
                        IMDb Rating :
                    </p>
                    <div class="flex items-center">
                        <StarIcon
                            class="w-4 h-4 md:w-6 md:h-6 text-yellow-400 inline me-2"
                        />
                        <span
                            class="font-medium text-xs md:text-base tracking-wider"
                            >{{ movieDetail.imdb_rating }} / 10</span
                        >
                    </div>
                </div>
                <div class="space-x-2">
                    <GenresBadge
                        v-for="(genre, index) in movieDetail.genres"
                        :key="index"
                        :text="genre"
                    />
                </div>
            </div>
            <p class="mb-5 text-base tracking-wide">
                {{ movieDetail.summary }}
            </p>
            <div class="flex items-center gap-3 mb-3">
                <p class="font-medium text-sm tracking-wider hidden md:block">
                    Authors :
                </p>
                <div class="space-x-1">
                    <span
                        v-for="(author, index) in movieDetail.authors"
                        :key="index"
                        class="text-accent text-sm cursor-pointer"
                        >{{ author }}</span
                    >
                </div>
            </div>
            <div class="flex items-center gap-3 mb-5">
                <div class="space-x-2">
                    <span
                        v-for="(tag, index) in movieDetail.tags"
                        :key="index"
                        class="text-sm cursor-pointer"
                        >#{{ tag }}</span
                    >
                </div>
            </div>
            <div>
                <a
                    :href="movieDetail.pdf_download_link"
                    target="_blank"
                    class="btn btn-sm md:btn btn-primary md:btn-primary"
                >
                    <ArrowDownTrayIcon class="w-4 h-4" />
                    Download PDF
                </a>
            </div>
        </div>
    </div>
    <div class="mb-10">
        <div class="flex justify-between items-center mb-5">
            <p class="text-sm md:text-lg font-medium tracking-wider">
                Related Movies
            </p>
            <!-- <button class="btn-sm md:btn md:btn-ghost btn-ghost">
                View More
            </button> -->
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <template v-for="d in movieDetail?.related_movies" :key="d.id">
                <MovieCard
                    :title="d.title"
                    :summary="d.summary"
                    :id="d.id"
                    :rating="d.imdb_rating"
                    :cover_image="d.cover_image"
                />
            </template>
        </div>
    </div>

    <CommentList :data="movieDetail?.comments" @refresh-data="fetchDetail" />
</template>

<script setup>
import Navbar from "../components/Navbar.vue";
import MovieCardGrid from "../components/MovieCardGrid.vue";
import GenresBadge from "../components/GenresBadge.vue";
import CommentList from "../components/CommentList.vue";
import MovieCard from "../components/MovieCard.vue";
import {
    ChevronLeftIcon,
    StarIcon,
    ArrowDownTrayIcon,
} from "@heroicons/vue/24/solid";
import { useRoute, useRouter } from "vue-router";
import { onMounted, onUpdated, ref, watch } from "vue";
import { useMovieStore } from "../store/movie";

const route = useRoute();
const movieStore = useMovieStore();
const movieDetail = ref(null);
const id = ref(null);

const fetchDetail = async () => {
    movieDetail.value = await movieStore.getMovieDetailAction(id.value);
};

onMounted(async () => {
    id.value = route.params.id;
    movieDetail.value = await movieStore.getMovieDetailAction(id.value);
});

watch(
    () => route.params.id,
    async (newValue) => {
        id.value = newValue;
        movieDetail.value = await movieStore.getMovieDetailAction(newValue);
    }
);
</script>

<style lang="scss" scoped></style>
