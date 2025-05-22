<template>
    <div>
        <!-- Заголовок категории -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ category.name }}</h1>
            <div class="text-sm text-gray-500 mt-1">
                Найдено товаров: {{ products.meta.total }}
            </div>
        </div>

        <!-- Список товаров -->
        <div class="space-y-4">
            <div
                v-for="product in products.data"
                :key="product.uuid"
                class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow"
            >
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Изображение товара -->
                    <div class="w-full md:w-32 h-32 bg-gray-100 rounded flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>

                    <!-- Информация о товаре -->
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                            <Link :href="product.url" class="hover:text-red-500">{{ product.name }}</Link>
                        </h3>

                        <div class="flex flex-wrap gap-4 mb-3">
                            <div class="text-sm">
                                <span class="text-gray-500">Артикул:</span>
                                <span class="font-medium ml-1">{{ product.supplierData.VendorProdNum }}</span>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-500">Бренд:</span>
                                <span class="font-medium ml-1">{{ product.supplierData.Brand }}</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <div class="text-red-500 font-bold text-xl">
                                {{ formatPrice(product.price) }} ₽
                            </div>
                            <div class="text-sm text-gray-600">
                                В наличии: {{ formatStock(product.stock) }} {{ product.unit }}
                            </div>
                        </div>

                        <!-- Кнопка в корзину -->
                        <button
                            @click="addToCart(product)"
                            class="mt-4 w-full md:w-auto bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition-colors flex items-center justify-center gap-2"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            В корзину
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Пагинация -->
        <Pagination :meta="products.meta" class="mt-8" />
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Common/Pagination.vue';

const props = defineProps({
    category: Object,
    products: Object
});

const formatPrice = (price) => {
    return new Intl.NumberFormat('ru-RU').format(price);
};

const formatStock = (stock) => {
    return new Intl.NumberFormat('ru-RU').format(stock);
};

const addToCart = (product) => {
    // Здесь будет логика добавления в корзину
    console.log('Добавлен товар:', product.name);
    // В реальном проекте можно использовать:
    // Inertia.post(route('cart.add'), { product_id: product.id })
};
</script>
