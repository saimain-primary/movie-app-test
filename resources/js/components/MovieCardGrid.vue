<template>
    <div class="mb-10">
        <div class="flex justify-between items-center mb-5">
            <p class="text-sm md:text-lg font-medium tracking-wider">
                {{ title }}
            </p>
            <!-- <button class="btn-sm md:btn md:btn-ghost btn-ghost">
                View More
            </button> -->
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <template v-for="d in data?.data" :key="d.id">
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
</template>

<script setup>
import { onMounted } from "vue";
import MovieCard from "./MovieCard.vue";

const props = defineProps({
    title: {
        type: String,
        default: "",
    },
    data: {
        type: Object,
        required: true,
    },
});

onMounted(()=>{
    console.log('props',props.data);
})
</script>

<style lang="scss" scoped></style>
