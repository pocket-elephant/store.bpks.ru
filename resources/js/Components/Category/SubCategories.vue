<template>
    <div class="bg-white rounded-lg shadow p-6 sticky top-4">
        <h2 class="text-lg font-semibold mb-4 text-gray-800 border-b pb-2">
            Подкатегории
        </h2>
        <ul class="space-y-1">
            <li v-for="subCat in categories.data" :key="subCat.uuid">
                <Link
                    :href="subCat.url"
                    class="flex items-center px-3 py-2 rounded hover:bg-red-50 transition-colors group"
                    :class="{ 'bg-red-50 text-red-500': $page.url === subCat.url }"
                >
                    <span class="flex-1 text-gray-800 group-hover:text-red-500">{{ subCat.name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </Link>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    categories: Object
});
</script>
