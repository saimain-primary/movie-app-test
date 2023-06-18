<template>
    <div class="mb-10">
        <div class="mb-8 flex items-center justify-between">
            <p class="text-base font-medium tracking-wide">
                Comments
                <span class="badge badge-neutral">10</span>
            </p>
        </div>
        <div class="mb-10 space-y-4">
            <input
                type="text"
                placeholder="Name"
                class="input input-bordered text-sm w-full"
            />
            <input
                type="text"
                placeholder="Email Address"
                class="input input-bordered text-sm w-full"
            />
            <textarea
                class="textarea textarea-bordered w-full mb-2"
                placeholder="Write a comment"
                rows="6"
            ></textarea>
            <button class="btn btn-sm btn-primary">Submit</button>
        </div>
        <div class="space-y-10">
            <Comment
                name="Sai Main"
                created-at="1 day ago"
                text="A predictable storyline that is embellished with
                            technical brilliance to make it a unique experience.
                            Kantara is a Rishab-Shetty-show all the way. He
                            shines as the director as well as the protagonist."
            />
            <Comment
                name="Kyaw Kyaw"
                created-at="2 day ago"
                text="A predictable storyline that is embellished with
                            technical brilliance to make it a unique experience.
                            Kantara is a Rishab-Shetty-show all the way. He
                            shines as the director as well as the protagonist."
            />
            <Comment
                name="Mg Aye"
                created-at="3 day ago"
                text="A predictable storyline that is embellished with
                            technical brilliance to make it a unique experience.
                            Kantara is a Rishab-Shetty-show all the way. He
                            shines as the director as well as the protagonist."
            />
            <Comment
                name="Kyaw Gyi"
                created-at="4 day ago"
                text="A predictable storyline that is embellished with
                            technical brilliance to make it a unique experience.
                            Kantara is a Rishab-Shetty-show all the way. He
                            shines as the director as well as the protagonist."
            />
        </div>
    </div>
</template>

<script setup>
import Comment from "./Comment.vue";
</script>

<style lang="scss" scoped></style>
