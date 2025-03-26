<script setup>
import {useForm, usePage} from "@inertiajs/vue3";
import {TrashIcon} from '@heroicons/vue/24/outline/index.js'
import moneyFormat from "../helpers.js";

const props = defineProps({
    item: Object
})

const page = usePage()

const deleteItem = function (uuid) {
    useForm({
        uuid: uuid,
    }).delete('/cart/items')
}

const ouQuantityChange = function () {
    useForm({
        uuid: props.item.product.uuid,
        quantity: props.item.quantity,
    }).post('/cart/items')
}

function displayPrice(price) {
    return moneyFormat(price)
}
</script>

<template>
    <div class="flex mb-8 space-x-8 pt-4 pb-4">
        <div class="basis-4/6">
            <div>{{ props.item.product.name }}</div>
            <div v-if="page.props.cart.order.data.items.length > 1">
                <span class="w-5 h-5 mr-1 text-sm text-gray-400 cursor-pointer" @click="deleteItem(props.item.uuid)">
                    <TrashIcon class="w-5 h-5 float-left mr-1"/>
                    <span>Удалить</span>
                </span>
            </div>
        </div>
        <div class="basis-2/6 text-right">
            <div class="text-2xl">{{ displayPrice(props.item.total) }}</div>
            <div class="text-sm text-gray-600">{{ displayPrice(props.item.product.price) }} / {{ props.item.product.unit }}</div>

            <div class="float-right">
                <input @change="ouQuantityChange" v-model="props.item.quantity" type="number" min="1" class="mt-4 text-center text-center py-2 px-2 w-18 rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"/>
            </div>
        </div>
    </div>
</template>
