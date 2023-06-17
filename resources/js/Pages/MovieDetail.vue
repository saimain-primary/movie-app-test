<template>
    <!-- navbar -->
    <Navbar />
    <!-- content -->
    <div class="mb-5">
        <router-link
            to="/"
            class="btn btn-sm md:btn btn-neutral md:btn-neutral"
        >
            <ChevronLeftIcon class="w-4 h-4 me-1 inline" />
            <span class="hidden md:block">Go Back</span></router-link
        >
    </div>
    <div class="flex flex-col md:flex-row justify-start gap-10 mb-5">
        <div>
            <img
                class="w-96 h-auto rounded-lg shadow-lg mb-5"
                src="https://m.media-amazon.com/images/M/MV5BMTAxNTIwNzE5MTJeQTJeQWpwZ15BbWU4MDE2NDQ2MTMy._V1_FMjpg_UX1000_.jpg"
                alt=""
            />
        </div>
        <div class="">
            <h3 class="text-lg md:text-3xl font-medium tracking-wider mb-3">
                Startup (2016)
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
                            >7.0 / 10</span
                        >
                    </div>
                </div>
                <div class="space-x-2">
                    <GenresBadge text="Crime" />
                    <GenresBadge text="Thriller" />
                </div>
            </div>
            <p class="mb-5 text-base tracking-wide">
                A desperate banker, a Haitian-American gang lord and a
                Cuban-American hacker are forced to work together to unwittingly
                create their version of the American dream - organized crime
                2.0.
            </p>
            <div class="flex items-center gap-3 mb-3">
                <p class="font-medium text-sm tracking-wider hidden md:block">
                    Authors :
                </p>
                <div class="space-x-1">
                    <span class="text-accent text-sm cursor-pointer"
                        >Adam Brody</span
                    >
                    <span>,</span>
                    <span class="text-accent text-sm cursor-pointer"
                        >AEdi Gathegi</span
                    >
                    <span>,</span>
                    <span class="text-accent text-sm cursor-pointer"
                        >Otmara Marrero</span
                    >
                </div>
            </div>
            <div class="flex items-center gap-3 mb-5">
                <div class="space-x-2">
                    <span class="text-sm cursor-pointer">#tech</span>
                    <span class="text-sm cursor-pointer">#startup</span>
                    <span class="text-sm cursor-pointer">#teen</span>
                    <span class="text-sm cursor-pointer">#action</span>
                </div>
            </div>
            <div>
                <button class="btn btn-sm md:btn btn-primary md:btn-primary">
                    <ArrowDownTrayIcon class="w-4 h-4" />
                    Download PDF
                </button>
            </div>
        </div>
    </div>
    <MovieCardGrid title="🎬 Related Movies" />
</template>

<script setup>
import Navbar from "../components/Navbar.vue";
import GenresBadge from "../components/GenresBadge.vue";
import MovieCardGrid from "../components/MovieCardGrid.vue";
import {
    ChevronLeftIcon,
    StarIcon,
    ArrowDownTrayIcon,
} from "@heroicons/vue/24/solid";
</script>

<style lang="scss" scoped></style>
