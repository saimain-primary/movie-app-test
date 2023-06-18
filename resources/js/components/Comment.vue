<template>
    <div class="flex gap-5 items-start">
        <img
            :src="'https://api.dicebear.com/6.x/fun-emoji/svg?seed=' + name"
            alt=""
            class="w-10 h-10 rounded-md"
        />
        <div>
            <p class="text-sm font-medium tracking-wide mb-1">
                {{ name }}
                <span class="text-xs font-normal uppercase">{{
                    createdAt
                }}</span>
            </p>
            <p class="text-base">
                {{ text }}
            </p>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    text: {
        type: String,
    },
    createdAt: {
        type: String,
    },
});
</script>

<style lang="scss" scoped></style>
