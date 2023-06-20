<template>
    <div class="mb-5 space-x-4">
        <router-link
            to="/"
            class="btn btn-sm md:btn btn-neutral md:btn-neutral"
        >
            <ChevronLeftIcon class="w-4 h-4 me-1 inline" />
            <span class="hidden md:block">Go Back</span>
        </router-link>
        <router-link
            to="/movies/new"
            class="btn btn-sm md:btn btn-neutral md:btn-neutral"
        >
            <PlusIcon class="w-4 h-4 me-1 inline" />
            <span class="hidden md:block">Add New Movie</span>
        </router-link>
    </div>
    <div class="mb-10 space-y-4">
        <div class="overflow-x-auto mb-5">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th class="w-[100px]">ID</th>
                        <th class="w-[200px]">Image</th>
                        <th>Title</th>
                        <th>Summary</th>
                        <th class="w-[100px]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr
                        v-for="movie in movieStore.movies?.data"
                        :key="movie.id"
                    >
                        <th>{{ movie.id }}</th>
                        <th>
                            <img
                                class="w-24 rounded"
                                :src="
                                    'http://localhost:8000/storage/images/' +
                                    movie.cover_image
                                "
                                alt=""
                            />
                        </th>
                        <td>{{ movie.title }}</td>
                        <td>{{ movie.summary?.substring(0, 200) + ".." }}</td>
                        <td class="">
                            <div class="join">
                                <router-link
                                    :to="'/movies/' + movie.id"
                                    class="join-item btn btn-sm"
                                >
                                    <EyeIcon class="w-4 h-4" />
                                </router-link>
                                <router-link
                                    :to="'/movies/edit/' + movie.id"
                                    class="join-item btn btn-sm"
                                >
                                    <PencilSquareIcon class="w-4 h-4" />
                                </router-link>
                                <button @click.prevent="deleteMovie(movie.id)"
                                    class="join-item btn btn-sm" >
                                    <TrashIcon class="w-4 h-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Pagination
            class="mt-3"
            v-if="movieStore.movies"
            @gotoPage="gotoPage"
            :data="movieStore.movies"
        />
    </div>
</template>

<script setup>
import {
    ChevronLeftIcon,
    PlusIcon,
    PencilSquareIcon,
    TrashIcon,
    EyeIcon,
} from "@heroicons/vue/24/solid";
import { storeToRefs } from "pinia";
import { onMounted, ref } from "vue";
import { useMovieStore } from "../store/movie";
import Pagination from "../components/Pagination.vue";

const pagination = ref({
    page: 1,
    limit: 10,
});
const movieStore = useMovieStore();

const gotoPage = async (page) => {
    pagination.value.page = page;
    await movieStore.getMovieListAction(pagination.value);
};

const deleteMovie = async (id) => {
    await movieStore.deleteMovieAction(id);
    await movieStore.getMovieListAction(pagination.value);
};
onMounted(async () => {
    await movieStore.getMovieListAction(pagination.value);
});
</script>

<style lang="scss" scoped></style>
