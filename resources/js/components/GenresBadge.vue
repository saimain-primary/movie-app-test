<template>
    <div
        class="badge badge-neutral text-sm tracking-wider font-medium py-3 px-2 cursor-pointer hover:badge-primary"
    >
        {{ text }}
    </div>
</template>

<script setup>
const props = defineProps({
    text: String,
});
</script>

<style lang="scss" scoped></style>
