<template>
    <div
        @click.prevent="goToDetail()"
        class="group relative bg-base-100 shadow-xl cursor-pointer rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-200 h-72 w-full"
    >
        <img
            class="w-full h-full"
            :src="'http://localhost:8000/storage/images/' + cover_image"
            alt=""
        />
        <div
            class="absolute top-3 left-2 badge badge-neutral items-center flex gap-1 py-3"
        >
            <StarIcon class="w-3 h-3 md:w-4 md:h-4 text-yellow-400 inline" />
            <span class="font-medium text-xs md:text-sm tracking-wider">{{
                rating
            }}</span>
        </div>
        <div
            class="left-0 text-gray-200 bg-black/60 p-4 absolute bottom-0 w-full transform md:translate-y-full group-hover:translate-y-0 transition-transform duration-300"
        >
            <h2 class="text-sm tracking-wider font-medium mb-1">{{ title }}</h2>
            <p class="text-xs text-gray-200 tracking-wide">
                {{ summary?.substring(0, 20) + ".." }}
            </p>
        </div>
    </div>
</template>

<script setup>
import { StarIcon } from "@heroicons/vue/24/solid";
import router from "../router";

const props = defineProps({
    id: {
        type: Number,
    },
    title: {
        type: String,
    },
    rating: {
        type: String,
    },
    summary: {
        type: String,
    },
    cover_image: {
        type: String,
    },
});
const goToDetail = () => {
    router.push("/movies/" + props.id);
};
</script>

<style lang="scss" scoped></style>
