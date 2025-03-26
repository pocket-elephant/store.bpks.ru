<script setup>
import Layout from '../Layouts/Basic.vue'
import { usePage, useForm } from '@inertiajs/vue3'
import {computed, ref} from 'vue'
import { DaDataNext } from 'vue-dadata-3'
import CartItem from '../Components/CartItem.vue'

const page = usePage()

const isEmpty = computed(() => !page.props.cart?.order)

const cssClasses = {
    root: 'relative',
    input: 'py-2 px-3 text-gray-500 rounded-md border bg-white mt-1 block w-full border-gray-100 shadow-sm focus:border-red-500 focus:ring-red-500',
    list: 'bg-white absolute w-full text-gray-500 z-40',
    row: 'px-2 py-1 hover:bg-gray-100 cursor-pointer'
}

const company = ref({
    value: null,
})

const acceptPrivacyPolicy = ref(false)

const checkout = function () {
    useForm({
        client: client.value,
        acceptPrivacyPolicy: acceptPrivacyPolicy.value,
    }).post('cart/checkout')
}

const data = computed(() => {

    if (client.value.type === 'legal') {
        return company.value
    }

    return null
})

const client = ref({
    contact: {
        name: null,
        phone: null,
        email: null,
    },
    type: 'individual',
    data: data
})

const setCompanyValue = function (suggestion) {
    company.value = suggestion
    return suggestion.value
}

const onSubjectSelect = function () {
    // if (client.value.type === 'individual') {
    //     client.value.data = null
    // }
    //
    // if (client.value.type === 'legal') {
    //     client.value.data = company.value
    // }
}

</script>

<template>
    <Layout>
        <h1 class="text-xl sm:text-2xl lg:text-3xl mb-6">Корзина</h1>
        <div v-if="isEmpty" class="bg-yellow-100 w-full px-4 py-4 rounded-md mb-4">Ваша корзина пуста</div>

        <div v-else class="grid md:grid-cols-3 grid-cols-1 gap-12">
            <div class="col-span-3 md:col-span-2">
                <h2 class="text-2xl">Список товаров</h2>
                <div class="divide-y divide-solid divide-gray-200">
                    <CartItem :item="item" v-for="item in page.props.cart.order.data.items" />
                </div>
            </div>

            <div class="col-span-3 md:col-span-1">
                <form @submit.prevent="checkout">
                    <h2 class="text-2xl mb-4">Контактные данные</h2>
                    <div class="bg-gray-100 rounded-md px-4 py-6">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Контактное лицо</label>
                            <DaDataNext v-model="client.contact.name" type="fio" :cssClasses="cssClasses"></DaDataNext>
                            <div class="text-red-600 text-sm mt-2" v-if="page.props.errors.hasOwnProperty('client.contact.name')">{{ page.props.errors['client.contact.name'] }}</div>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700">Телефон</label>
                            <input v-model="client.contact.phone" type="text" required name="phone" autocomplete="phone" :class="cssClasses.input">
                            <div class="text-red-600 text-sm mt-2" v-if="page.props.errors.hasOwnProperty('client.contact.phone')">{{ page.props.errors['client.contact.phone'] }}</div>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700">Email</label>
                            <DaDataNext v-model="client.contact.email" type="email" :cssClasses="cssClasses"></DaDataNext>
                            <div class="text-red-600 text-sm mt-2" v-if="page.props.errors.hasOwnProperty('client.contact.email')">{{ page.props.errors['client.contact.email'] }}</div>
                        </div>
                        <div class="mb-4">
                            <label for="subject" class="block text-gray-700">Субъект</label>
                            <select @change="onSubjectSelect" v-model="client.type" class="py-2 px-3 text-gray-500 rounded-md border bg-white mt-1 block w-full border-gray-100 shadow-sm focus:border-red-500 focus:ring-red-500">
                                <option value="individual">Физическое лицо</option>
                                <option value="legal">Юридическое лицо лицо</option>
                            </select>
                        </div>
                        <div class="mb-4" v-if="client.type === 'legal'">
                            <label for="company" class="block text-gray-700">Компания</label>
                            <DaDataNext :set-input-value="setCompanyValue" v-model="company.value" type="party" :cssClasses="cssClasses">
                                <template #list-item="{ prop, prepareValue}">
                                    <div class="text-gray-600">
                                        <div>{{ prop.value }}</div>
                                        <div class="text-xs text-gray-400">ИНН: {{ prop?.data?.inn }}</div>
                                    </div>
                                </template>
                            </DaDataNext>
                            <div class="text-red-600 text-sm mt-2" v-if="page.props.errors.hasOwnProperty('client.data.inn')">{{ page.props.errors['client.data.inn'] }}</div>
                        </div>
                        <div class="mb-4 flex items-center">
                            <input v-model="acceptPrivacyPolicy" type="checkbox" id="privacy-policy" class="mr-4">
                            <label for="privacy-policy" class="text-gray-700 text-xs"> Я согласен с <a href="https://bpks.ru/privacy-policy" target="_blank" class="text-blue-500">политикой конфиденциальности</a> а также с <a href="https://bpks.ru/user-agreement" target="_blank" class="text-blue-500">правилами обработки и хранения персональных данных.</a></label>
                        </div>
                        <button :disabled="!acceptPrivacyPolicy" type="submit" class="bg-red-600 hover:bg-red-700 w-full px-4 py-4 rounded-md text-white cursor-pointer disabled:bg-gray-300 disabled:cursor-default"> Оформить заказ </button>
                    </div>
                </form>
            </div>
        </div>

<!--        <pre class="text-xs">-->
<!--{{ {client: client, acceptPrivacyPolicy: acceptPrivacyPolicy} }}-->
<!--        </pre>-->
<!--        <pre class="text-xs bg-gray-100 p-3">-->
<!--{{ page.props.errors}}-->
<!--        </pre>-->

    </Layout>
</template>
