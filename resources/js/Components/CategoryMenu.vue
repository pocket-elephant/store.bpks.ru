<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    categories: Object,
})
</script>

<template>
    <nav class="bg-gray-100 rounded-lg shadow-sm py-4 text-sm lg:text-base hidden md:block">
        <Link class="block text-gray-600 px-6 py-1 hover:text-blue-700" v-for="category in categories" :href="category.url">{{ category.name }}</Link>
    </nav>
</template>
