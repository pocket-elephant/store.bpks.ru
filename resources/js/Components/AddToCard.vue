<script setup>
import {useForm} from "@inertiajs/vue3";

defineProps({
    product: Object
})

function addToCard(uuid) {
    useForm({
        uuid: uuid,
    }).post('/cart/items')
}
</script>

<template>
    <div
        @click="addToCard(product.uuid)"
        class="bg-red-500 hover:bg-red-600 text-white inline-block rounded-md text-center px-4 md:px-6 py-2 whitespace-nowrap cursor-pointer text-xs sm:text-sm">
        в корзину
    </div>
</template>
