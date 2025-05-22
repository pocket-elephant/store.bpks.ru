<template>
    <div class="bg-white rounded-lg shadow p-4 hover:shadow-md transition-shadow">
        <div class="flex gap-4">
            <!-- Компактное изображение товара -->
            <div class="w-20 h-20 flex-shrink-0 bg-gray-100 rounded flex items-center justify-center overflow-hidden">
                <img
                    v-if="product.image"
                    :src="product.image"
                    :alt="product.name"
                    class="object-cover w-full h-full"
                >
                <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>

            <!-- Основная информация -->
            <div class="flex-1 min-w-0">
                <h3 class="font-medium text-gray-800 truncate">
                    <Link :href="product.url" class="hover:text-red-500">
                        {{ product.name }}
                    </Link>
                </h3>

                <div class="text-xs text-gray-500 mt-1">
                    Арт: {{ product.supplierData.VendorProdNum }}
                </div>

                <div v-if="product.supplierData.Brand" class="text-xs text-gray-600 mt-1">
                    {{ product.supplierData.Brand }}
                </div>
            </div>

            <!-- Блок с ценой и кнопкой -->
            <div class="flex flex-col items-end ml-2">
                <div class="text-lg font-bold text-red-500 whitespace-nowrap">
                    {{ formatPrice(product.price) }} ₽
                </div>

                <div class="text-xs mt-1" :class="stockStatusClass">
                    {{ stockStatusText }}
                </div>

                <AddToCard :disabled="!product.stock" :class="{ 'opacity-50 cursor-not-allowed': !product.stock }" :product="product"/>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import AddToCard from '@/Components/AddToCard.vue';

const props = defineProps({
    product: Object
});

const emit = defineEmits(['add-to-cart']);

const formatPrice = (price) => {
    return new Intl.NumberFormat('ru-RU').format(price);
};

const stockStatusText = computed(() => {
    if (props.product.stock > 10) return `${formatStock(props.product.stock)} ${props.product.unit}`;
    if (props.product.stock > 0) return `Осталось ${formatStock(props.product.stock)}`;
    return 'Нет в наличии';
});

const stockStatusClass = computed(() => {
    return {
        'text-green-600': props.product.stock > 10,
        'text-yellow-600': props.product.stock > 0 && props.product.stock <= 10,
        'text-gray-500': props.product.stock <= 0
    };
});

const formatStock = (stock) => {
    return new Intl.NumberFormat('ru-RU').format(stock);
};

const addToCart = () => {
    if (props.product.stock <= 0) return;
    emit('add-to-cart', props.product);
};
</script>
