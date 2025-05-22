<template>
    <div class="bg-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Категории товаров
                </h2>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                    Выберите интересующую вас категорию
                </p>
            </div>

            <div class="mt-12">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <a
                        v-for="category in categories"
                        :key="category.uuid"
                        :href="category.url"
                        class="group relative bg-white border border-gray-200 rounded-lg flex flex-col overflow-hidden hover:shadow-md transition-shadow duration-200"
                    >
                        <div class="aspect-w-3 aspect-h-2 bg-gray-200 group-hover:opacity-75 flex items-center justify-center p-6">
                            <BoltIcon class="h-12 w-12 text-gray-700" />
                        </div>
                        <div class="flex-1 p-4 flex flex-col justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">
                                    <span aria-hidden="true" class="absolute inset-0" />
                                    {{ category.name }}
                                </h3>
                            </div>
                            <p class="mt-2 text-sm text-gray-500 flex items-center">
                                Смотреть товары
                                <ArrowRightIcon class="ml-1 h-4 w-4" />
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { BoltIcon, ArrowRightIcon } from '@heroicons/vue/24/outline';

defineProps({
    categories: {
        type: Object,
        required: true
    }
});
</script>
