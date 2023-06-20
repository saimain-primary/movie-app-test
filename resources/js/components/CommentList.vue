<template>
    <div class="mb-10">
        <div class="mb-8 flex items-center justify-between">
            <p class="text-base font-medium tracking-wide">
                Comments
                <span class="badge badge-neutral">10</span>
            </p>
        </div>
        <form @submit.prevent="submitCommentHandler" class="mb-10 space-y-4">
            <input
                type="text"
                placeholder="Name"
                v-model="formData.name"
                class="input input-bordered text-sm w-full"
            />
            <input
                type="email"
                v-model="formData.email"
                placeholder="Email Address"
                class="input input-bordered text-sm w-full"
            />
            <textarea
                class="textarea textarea-bordered w-full mb-2"
                placeholder="Write a comment"
                v-model="formData.text"
                rows="6"
            ></textarea>
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </form>
        <div class="space-y-10">
            <Comment
                v-for="comment in data"
                :key="comment.id"
                :name="comment.name"
                :created-at="comment.created_at"
                :text="comment.text"
            />
        </div>
    </div>
</template>

<script setup>
import Comment from "./Comment.vue";
import { useRoute } from "vue-router";
import { useMovieStore } from "../store/movie";
import { onMounted, ref, watch } from "vue";

const movieStore = useMovieStore();
const route = useRoute();
const id = ref(null);

const props = defineProps({
    data: {
        type: Object,
    },
});

const emits = defineEmits(["refreshData"]);

const formData = ref({
    name: null,
    email: null,
    text: null,
});

const submitCommentHandler = async () => {
    const response = await movieStore.addCommentAction(
        id.value,
        formData.value
    );
    formData.value = {
        name: null,
        email: null,
        text: null,
    };
    emits("refreshData");
};

watch(
    () => route.params.id,
    async (newValue) => {
        id.value = newValue;
    }
);

onMounted(() => {
    id.value = route.params.id;
});
</script>

<style lang="scss" scoped></style>
