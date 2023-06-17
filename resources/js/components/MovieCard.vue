<template>
    <div
        @click.prevent="goToDetail()"
        class="group relative bg-base-100 shadow-xl cursor-pointer rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-200"
    >
        <img
            class="w-full h-auto"
            src="https://m.media-amazon.com/images/M/MV5BMTAxNTIwNzE5MTJeQTJeQWpwZ15BbWU4MDE2NDQ2MTMy._V1_FMjpg_UX1000_.jpg"
            alt=""
        />
        <div
            class="absolute top-3 left-2 badge badge-neutral items-center flex gap-1 py-3"
        >
            <StarIcon class="w-3 h-3 md:w-4 md:h-4 text-yellow-400 inline" />
            <span class="font-medium text-xs md:text-sm tracking-wider"
                >7.0</span
            >
        </div>
        <div
            class="left-0 text-gray-200 bg-black/60 p-4 absolute bottom-0 w-full transform md:translate-y-full group-hover:translate-y-0 transition-transform duration-300"
        >
            <h2 class="text-sm tracking-wider font-medium mb-1">StartUp</h2>
            <p class="text-xs text-gray-200 tracking-wide">
                {{
                    `A desperate banker, a Haitian-American gang lord and a Cuban-American hacker are forced to work together to unwittingly create their version of the American dream - organized crime 2.0`.substring(
                        0,
                        100
                    ) + ".."
                }}
            </p>
        </div>
    </div>
</template>

<script setup>
import { StarIcon } from "@heroicons/vue/24/solid";
import router from "../router";
const goToDetail = () => {
    router.push("/movies/1");
};
</script>

<style lang="scss" scoped></style>
