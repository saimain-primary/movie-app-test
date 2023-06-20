<template>
    <!-- content -->
    <MovieCardGrid
        title="🎬 All Movies"
        v-if="movieStore.movies"
        :data="movieStore.movies"
    />
    <div>
        <Pagination
            class="mt-3 mb-10"
            v-if="movieStore.movies"
            @gotoPage="gotoPage"
            :data="movieStore.movies"
        />
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import MovieCardGrid from "../components/MovieCardGrid.vue";
import Navbar from "../components/Navbar.vue";
import { useMovieStore } from "../store/movie";
import Pagination from "../components/Pagination.vue";
const movieStore = useMovieStore();
const pagination = ref({
    page: 1,
    limit: 12,
});

const gotoPage = async (page) => {
    pagination.value.page = page;
    await movieStore.getMovieListAction(pagination.value);
};

onMounted(async () => {
    await movieStore.getMovieListAction(pagination.value);
    console.log(movieStore.movies);
});
</script>

<style lang="scss" scoped></style>
