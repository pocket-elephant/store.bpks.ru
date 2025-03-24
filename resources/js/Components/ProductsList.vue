<script setup>
import Paginator from '../Components/Pagination/Paginator.vue'
import AddToCard from '../Components/AddToCard.vue'

defineProps({
    products: Object,
})

</script>

<template>
    <div class="mb-4">
        <div class="divide-y divide-solid divide-gray-200">
            <div class="flex mb-2 lg:mb-2 space-x-4 lg:space-x-8 pt-4 lg:pt-4 pb-4" v-for="product in products.data">
                <div class="basis-5/6">
                    {{ product.name }}
                </div>
                <div class="basis-1/6">
                    <div class="text-center mb-2">
                        {{ product.price }} ₽ / {{ product.unit }}
                    </div>
                    <AddToCard :product="product"/>
                </div>
            </div>
        </div>
    </div>

    <Paginator :resource="products"/>
</template>
