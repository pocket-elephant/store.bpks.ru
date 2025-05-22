<template>
    <nav class="flex items-center justify-center space-x-1">
        <template v-for="(link, index) in meta.links" :key="index">
            <Link
                v-if="link.url"
                :href="link.url"
                class="px-4 py-2 rounded-md text-sm"
                :class="{
          'bg-red-500 text-white': link.active,
          'bg-white text-gray-800 hover:bg-gray-100 border': !link.active
        }"
                v-html="link.label"
            />
            <span
                v-else
                class="px-4 py-2 text-gray-500"
                v-html="link.label"
            />
        </template>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    meta: Object
});
</script>
