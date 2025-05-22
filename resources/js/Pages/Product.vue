<template>
    <Layout>
        <div class="grid md:grid-cols-3 grid-cols-1 gap-2 md:gap-12">
            <!-- Сайдбар с подкатегориями -->
            <div class="col-span-3 md:col-span-1">
                <SubCategories :categories="categories" />
            </div>

            <!-- Основное содержимое -->
            <div class="col-span-3 md:col-span-2">
                <div class="bg-white rounded-lg shadow p-6">
                    <!-- Основная информация о товаре -->
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Изображение товара -->
                        <div class="w-full md:w-1/3 flex-shrink-0">
                            <div class="bg-gray-100 rounded-lg p-4 flex items-center justify-center h-64">
                                <img v-if="product.image" :src="product.image" :alt="product.name" class="max-h-full max-w-full">
                                <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Информация о товаре -->
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ product.data.name }}</h1>

                            <!-- Цена и наличие -->
                            <div class="flex items-center mb-4">
                                <span class="text-red-500 font-bold text-3xl mr-4">{{ formatPrice(product.data.price) }} ₽</span>
                                <span class="text-sm" :class="stockStatusClass">
                  {{ stockStatusText }}
                </span>
                            </div>

                            <!-- Кнопка корзины -->
                            <div class="mb-6">
                                <AddToCard :disabled="!product.data.stock" :class="{ 'opacity-50 cursor-not-allowed': !product.data.stock }" :product="product.data"/>
<!--                                <button-->
<!--                                    @click="addToCart"-->
<!--                                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg transition-colors flex items-center gap-2"-->

<!--                                    :class="{ 'opacity-50 cursor-not-allowed': !product.data.stock }"-->
<!--                                >-->
<!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
<!--                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />-->
<!--                                    </svg>-->
<!--                                    Добавить в корзину-->
<!--                                </button>-->
                            </div>

                            <!-- Характеристики -->
                            <div class="border-t pt-4">
                                <h3 class="font-semibold text-gray-800 mb-3">Характеристики</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div v-if="product.data.supplierData.VendorProdNum">
                                        <span class="text-gray-600">Артикул:</span>
                                        <span class="ml-2 font-medium">{{ product.data.supplierData.VendorProdNum }}</span>
                                    </div>
                                    <div v-if="product.data.supplierData.Brand">
                                        <span class="text-gray-600">Бренд:</span>
                                        <span class="ml-2 font-medium">{{ product.data.supplierData.Brand }}</span>
                                    </div>
                                    <div v-if="product.data.supplierData.ProductGroup">
                                        <span class="text-gray-600">Группа товаров:</span>
                                        <span class="ml-2 font-medium">{{ product.data.supplierData.ProductGroup }}</span>
                                    </div>
                                    <div v-if="product.data.unitData?.name">
                                        <span class="text-gray-600">Единица измерения:</span>
                                        <span class="ml-2 font-medium">{{ product.data.unitData.name }}</span>
                                    </div>
                                    <div v-if="product.data.supplierData.EAN?.Value">
                                        <span class="text-gray-600">Штрих-код:</span>
                                        <span class="ml-2 font-medium">{{ product.data.supplierData.EAN.Value }}</span>
                                    </div>
                                    <div v-if="product.data.supplierData.RetailCurrency">
                                        <span class="text-gray-600">Валюта:</span>
                                        <span class="ml-2 font-medium">{{ product.data.supplierData.RetailCurrency.toUpperCase() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import Layout from '@/Layouts/Basic.vue';
import SubCategories from '@/Components/Category/SubCategories.vue';
import AddToCard from '@/Components/AddToCard.vue';

const props = defineProps({
    product: Object,
    categories: Object
});

const formatPrice = (price) => {
    return new Intl.NumberFormat('ru-RU').format(price);
};

const formatStock = (stock) => {
    return new Intl.NumberFormat('ru-RU').format(stock);
};

const stockStatusText = computed(() => {
    if (!props.product.data.stock && props.product.data.stock !== 0) return 'Нет данных о наличии';
    if (props.product.data.stock > 10) return `В наличии: ${formatStock(props.product.data.stock)} ${props.product.data.unit || 'шт'}`;
    if (props.product.data.stock > 0) return `Мало: ${formatStock(props.product.data.stock)} ${props.product.data.unit || 'шт'}`;
    return 'Нет в наличии';
});

const stockStatusClass = computed(() => {
    if (!props.product.data.stock && props.product.data.stock !== 0) return 'text-gray-500';
    return {
        'text-green-600': props.product.data.stock > 10,
        'text-yellow-600': props.product.data.stock > 0 && props.product.data.stock <= 10,
        'text-gray-500': props.product.data.stock <= 0
    };
});

const addToCart = () => {
    if (!props.product.data.stock || props.product.data.stock <= 0) return;
    // Логика добавления в корзину
    console.log('Добавлен товар:', props.product.data.name);
    // Inertia.post(route('cart.add'), { product_id: props.product.data.id })
};
</script>
