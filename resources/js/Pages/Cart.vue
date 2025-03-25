<script setup>
import Layout from '../Layouts/Basic.vue'
import { usePage, useForm } from '@inertiajs/vue3'
import {computed, ref} from 'vue'
import {TrashIcon} from '@heroicons/vue/24/outline/index.js';
import { DaDataNext } from 'vue-dadata-3'

const page = usePage()

const isEmpty = computed(() => !page.props.cart?.order)

const deleteItem = function (uuid) {
    useForm({
        uuid: uuid,
    }).delete('/cart/items')
}

const ouQuantityChange = function () {}

const cssClasses = {
    root: 'relative',
    input: 'py-2 px-3 text-gray-500 rounded-md border bg-white mt-1 block w-full border-gray-100 shadow-sm focus:border-red-500 focus:ring-red-500',
    list: 'bg-white absolute w-full text-gray-500 z-40',
    row: 'px-2 py-1 hover:bg-gray-100 cursor-pointer'
}

const clientName = ref();
const clientEmail = ref();

</script>

<template>
    <Layout>
        <h1 class="text-xl sm:text-2xl lg:text-3xl mb-6">Корзина</h1>
        <div v-if="isEmpty" class="bg-yellow-100 w-full px-4 py-4 rounded-md mb-4">Ваша корзина пуста</div>

        <div v-else class="grid md:grid-cols-3 grid-cols-1 gap-12">
            <div class="col-span-3 md:col-span-2">

                <h2 class="text-2xl">Список товаров</h2>

                <div class="divide-y divide-solid divide-gray-200">
                    <div class="flex mb-8 space-x-8 pt-4 pb-4" v-for="item in page.props.cart.order.data.items">
                        <div class="basis-4/6">
                            <div>{{ item.product.name }}</div>
                            <div v-if="page.props.cart.order.data.items.length > 1">
                                <span class="w-5 h-5 mr-1 text-sm text-gray-400 cursor-pointer" @click="deleteItem(item.uuid)">
                                    <TrashIcon class="w-5 h-5 float-left mr-1"/>
                                    <span>Удалить</span>
                                </span>
                            </div>
                        </div>
                        <div class="basis-2/6 text-right">
                            <div class="text-2xl">{{ item.total }} ₽</div>
                            <div class="text-sm text-gray-600">{{ item.product.price }} ₽ / {{ item.product.unit }}</div>

                            <div class="float-right">
                                <input @change="ouQuantityChange" v-model="item.quantity" type="number" min="1" class="mt-4 text-center text-center py-2 px-2 w-18 rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"/>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-span-3 md:col-span-1">
                <form>
                    <h2 class="text-2xl mb-4">Контактные данные</h2>
                    <div class="bg-gray-100 rounded-md px-4 py-6">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Контактное лицо</label>
                            <DaDataNext v-model="clientName" type="fio" :cssClasses="cssClasses"></DaDataNext>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700">Телефон</label>
                            <input type="text" required="" name="phone" id="phone" autocomplete="phone" :class="cssClasses.input">
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700">Email</label>
                            <DaDataNext v-model="clientEmail" type="email" :cssClasses="cssClasses"></DaDataNext>
                        </div>
                        <div class="mb-4 flex items-center">
                            <input type="checkbox" id="privacy-policy" class="mr-2">
                            <label for="privacy-policy" class="text-gray-700"> Я согласен с <a href="/privacy-policy" target="_blank" class="text-blue-500">политикой конфиденциальности</a> а также с <a href="/user-agreement" target="_blank" class="text-blue-500">правилами обработки и хранения персональных данных.</a></label>
                        </div>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 w-full px-4 py-4 rounded-md text-white" disabled=""> Оформить заказ </button>
                    </div>
                </form>
            </div>
        </div>


    </Layout>
</template>
