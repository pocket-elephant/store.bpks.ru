<script setup>
import Paginator from '../Components/Pagination/Paginator.vue'
import AddToCard from '../Components/AddToCard.vue'
import { Link } from '@inertiajs/vue3'
import moneyFormat from "../helpers.js";

defineProps({
    products: Object,
})

</script>

<template>
    <div class="grid gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow" v-for="product in products.data">
            <Link class="text-xl text-gray-800 mb-2" :href="product.url">{{ product.name }}</Link>
            <div class="flex flex-wrap items-center justify-between gap-4 mt-4">
                <div class="flex flex-wrap items-center gap-4">
                    <span class="text-2xl">{{ moneyFormat(product.price) }}</span>
                    <span class="text-gray-600">за {{ product.unitData.name.toLowerCase() }}</span>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">В наличии: {{ product.stock }} {{ product.unit }}</span>
                </div>
                <AddToCard :product="product"/>
            </div>
        </div>
    </div>
    <Paginator :resource="products"/>
</template>
