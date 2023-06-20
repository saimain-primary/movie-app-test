<template>
    <div class="mb-5">
        <router-link
            to="/movies/list"
            class="btn btn-sm md:btn btn-neutral md:btn-neutral"
        >
            <ChevronLeftIcon class="w-4 h-4 me-1 inline" />
            <span class="hidden md:block">Go Back</span>
        </router-link>
    </div>
    <form @submit.prevent="onSubmitHandler" class="mb-10 space-y-4">
        <input
            type="text"
            placeholder="Movie Title"
            v-model="formData.title"
            class="input input-bordered text-sm w-full"
        />
        <input
            type="number"
            max="10"
            v-model="formData.imdb_rating"
            placeholder="IMDb Rating"
            class="input input-bordered text-sm w-full"
        />
        <v-select
            v-if="movieStore.genres"
            multiple
            placeholder="Genres"
            v-model="formData.genres"
            :reduce="(i) => i.name"
            taggable
            label="name"
            class="text-gray-600 style-chooser"
            :options="movieStore.genres"
        ></v-select>
        <v-select
            v-if="movieStore.authors"
            multiple
            placeholder="Authors"
            :reduce="(i) => i.name"
            v-model="formData.authors"
            taggable
            label="name"
            class="text-gray-600 style-chooser"
            :options="movieStore.authors"
        ></v-select>
        <v-select
            v-if="movieStore.tags"
            multiple
            placeholder="Tags"
            :reduce="(i) => i.name"
            v-model="formData.tags"
            taggable
            label="name"
            class="text-gray-600 style-chooser"
            :options="movieStore.tags"
        ></v-select>
        <textarea
            class="textarea textarea-bordered w-full mb-2"
            v-model="formData.summary"
            placeholder="Movie Summary"
            rows="6"
        ></textarea>
        <input
            type="text"
            v-model="formData.pdf_download_link"
            placeholder="PDF Download Link"
            class="input input-bordered text-sm w-full"
        />
        <div>
            <p class="mb-2 text-sm text-gray-400">Cover Image</p>
            <input
                type="file"
                ref="fileInput"
                @change="handleFileUpload"
                accept="image/*"
                class="file-input file-input-bordered w-full mb-5"
            />
            <div v-if="previewUrl">
                <img
                    :src="previewUrl"
                    class="rounded-lg shadow-md"
                    alt="Preview"
                    width="200"
                />
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Movie</button>
    </form>
</template>

<script setup>
import { ChevronLeftIcon } from "@heroicons/vue/24/solid";
import { onMounted, ref } from "vue";
import { useMovieStore } from "../store/movie";
import { useRouter, useRoute } from "vue-router";

const movieStore = useMovieStore();
const router = useRouter();
const route = useRoute();
const fileInput = ref(null);
const previewUrl = ref(null);
const formData = ref({
    title: "",
    summary: "",
    imdb_rating: "",
    pdf_download_link: "",
    tags: [],
    genres: [],
    authors: [],
});

const coverImage = ref(null);

const handleFileUpload = () => {
    const file = fileInput.value.files[0];
    if (file) {
        coverImage.value = file;
        const reader = new FileReader();
        reader.onload = () => {
            previewUrl.value = reader.result;
        };
        reader.readAsDataURL(file);
    }
};

const onSubmitHandler = async () => {
    try {
        const frmData = new FormData();
        Object.entries(formData.value).forEach((entry) => {
            const [key, value] = entry;
            frmData.append(key, value);
        });
        frmData.append("cover_image", coverImage.value);
        frmData.append("_method", "PUT");
        await movieStore.updateMovieAction(route.params.id, frmData);
        router.push("/movies/list");
    } catch (error) {
        console.log(error);
    }
};

onMounted(async () => {
    await movieStore.getTagListAction();
    await movieStore.getAuthorListAction();
    await movieStore.getGenresListAction();

    const detail = await movieStore.getMovieDetailAction(route.params.id);
    formData.value.title = detail.title;
    formData.value.summary = detail.summary;
    formData.value.imdb_rating = detail.imdb_rating;
    formData.value.pdf_download_link = detail.pdf_download_link;
    formData.value.genres = detail.genres;
    formData.value.tags = detail.tags;
    formData.value.authors = detail.authors;
    previewUrl.value =
        "http://localhost:8000/storage/images/" + detail.cover_image;
});
</script>

<style>
.style-chooser .vs__search::placeholder,
.style-chooser .vs__dropdown-toggle,
.style-chooser .vs__dropdown-menu {
    border-radius: 6px;
    padding: 10px 6px;
    font-size: 14px;
}

.style-chooser .vs__selected {
    color: rgb(53, 53, 53);
    background: rgb(141, 141, 141);
}
.style-chooser .vs__clear,
.style-chooser .vs__open-indicator {
}
</style>
