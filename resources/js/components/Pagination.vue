<script setup>
import { computed } from "vue";

const props = defineProps({
    data: Object,
});

const emits = defineEmits(["gotoPage"]);

const pages = computed(() => {
    const startPage = Math.max(1, props.data.meta.current_page - 2);
    const endPage = Math.min(
        props.data.meta.total_page,
        props.data.meta.current_page + 2
    );
    let pages = [];
    for (let i = startPage; i <= endPage; i++) {
        pages.push(i);
    }

    if (startPage > 1) {
        pages.unshift("...");
        pages.unshift(1);
    }

    if (endPage < props.data.meta.total_page) {
        pages.push("...");
        pages.push(props.data.meta.total_page);
    }
    return pages;
});

const gotoPage = (page) => {
    emits("gotoPage", page);
};

const prevPage = () => {
    const link = props.data.links.prev;
    if (link) {
        const pageNumber = link.split("?page=")[1];
        gotoPage(pageNumber);
    }
};
const nextPage = () => {
    const link = props.data.links.next;
    if (link) {
        const pageNumber = link.split("?page=")[1];
        gotoPage(pageNumber);
    }
};
</script>

<template>
    <div class="flex items-center justify-center">
        <div class="join">
            <button
                @click="prevPage"
                class="join-item btn"
                :disabled="!props.data.links.prev"
            >
                Prev
            </button>
            <button
                v-for="page in pages"
                :key="page"
                @click="gotoPage(page)"
                class="join-item btn"
                :class="{
                    'btn-primary': page === props.data.meta.current_page,
                }"
            >
                {{ page }}
            </button>
            <button
                @click="nextPage"
                class="join-item btn"
                :disabled="!props.data.links.next"
            >
                Next
            </button>
        </div>
    </div>
</template>
