<template>
    <div>
        <!-- Заголовок и информация -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ category.name }}</h1>
            <div class="text-sm text-gray-500 mt-1">
                Найдено товаров: {{ formatNumber(products.meta.total) }}
            </div>
        </div>

        <!-- Список товаров -->
        <div class="space-y-4">
            <ProductCard
                v-for="product in products.data"
                :key="product.uuid"
                :product="product"
            />
        </div>

        <!-- Пагинация -->
        <Pagination :meta="products.meta" class="mt-8" />
    </div>
</template>

<script setup>
import ProductCard from '@/Components/Product/ProductCard.vue';
import Pagination from '@/Components/Common/Pagination.vue';

const props = defineProps({
    category: Object,
    products: Object
});

const formatNumber = (num) => {
    return new Intl.NumberFormat('ru-RU').format(num);
};
</script>
