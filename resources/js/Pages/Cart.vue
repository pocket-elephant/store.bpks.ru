<script setup>
import Layout from '../Layouts/Basic.vue'
import { usePage, useForm } from '@inertiajs/vue3'
import {computed, ref} from 'vue'
import { DaDataNext } from 'vue-dadata-3'
import CartItem from '../Components/CartItem.vue'
import moneyFormat from "../helpers.js";
import OrderForm from '../Components/Cart/OrderForm/Form.vue'
import OrderFormBlock from '../Components/Cart/OrderForm/FormBlock.vue'
import FormField from '../Components/Cart/OrderForm/FormField.vue'

const page = usePage()

const isEmpty = computed(() => !page.props.cart?.order)

const cssClasses = {
    root: 'relative',
    input: 'py-2 px-3 text-gray-500 rounded-md border bg-white mt-1 block w-full border-gray-100 shadow-sm focus:border-red-500 focus:ring-red-500',
    list: 'bg-white absolute w-full text-gray-500 z-40',
    row: 'px-2 py-1 hover:bg-gray-100 cursor-pointer'
}

const totalCost = computed(() => {
    let sum = 0;
    page.props.cart.order.data.items.forEach((item) => sum += item.total)
    return sum;
})

const contact = ref({
    name: null,
    phone: null,
    email: null,
})

const clientType = ref(page.props.defines.clientTypes.default)

const companyData = ref({
    value: null
})

const setCompanyValue = (suggestion) => {
    companyData.value = suggestion
    return suggestion.value
}

const bankAccountNumber = ref(null)

const bankData = ref({
    value: null
})

const setBankValue = (suggestion) => {
    bankData.value = suggestion
    return suggestion.value
}

const paymentDetails = computed(() => {
    return {
        bankAccountNumber: bankAccountNumber.value,
        bank: bankData.value,
    }
})

const client = computed(() => {
    return {
        type: clientType.value,
        contact: contact.value,
        data: clientType.value === 'legal'
            ? companyData.value
            : null,
        paymentDetails: clientType.value === 'legal'
            ? paymentDetails.value
            : null
    }
})

const deliveryType = ref(page.props.defines.deliveryTypes.default)

const deliveryToAddressData = ref({
    value: null
});

const pickupPointIndex = ref(0);

const pickupDeliveryData = computed(() => {
    return {
        value: page.props.defines.warehouses[pickupPointIndex.value].address,
        data: page.props.defines.warehouses[pickupPointIndex.value]
    }
})

const delivery = computed(() => {
    return {
        type: deliveryType.value,
        data: deliveryType.value === 'toAddress'
            ? deliveryToAddressData.value
            : pickupDeliveryData.value,
    }
})

const setDeliveryValue = function (suggestion) {
    deliveryToAddressData.value = suggestion
    return suggestion.value
}

const order = computed(() => {
    return {
        client: client.value,
        delivery: delivery.value,
        acceptPrivacyPolicy: acceptPrivacyPolicy.value,
    }
})

const acceptPrivacyPolicy = ref(false)

const checkout = function () {
    useForm(order.value).post('cart/checkout')
}

function displayPrice(price) {
    return moneyFormat(price)
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

                    <div class="flex mb-8 space-x-8 pt-4 pb-4">
                        <div class="basis-4/6 uppercase text-2xl">
                            Итого
                        </div>
                        <div class="basis-2/6 text-right">
                            <span class="text-2xl">{{ displayPrice(page.props.cart.order.data.total) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-3 md:col-span-1">
                <h2 class="text-2xl mb-4">Оформление заказа</h2>
                <OrderForm @submit.prevent="checkout">
                    <OrderFormBlock>
                        <template #header>Контактные данные</template>
                        <FormField error-key="client.contact.name">
                            <template #label>Контактное лицо</template>
                            <DaDataNext v-model="client.contact.name" placeholder="Фамилия Имя Отчество" type="fio" :cssClasses="cssClasses"/>
                        </FormField>
                        <FormField error-key="client.contact.phone">
                            <template #label>Телефон</template>
                            <input placeholder="+7 (900) 000-00-00" v-model="client.contact.phone" type="text" required name="phone" autocomplete="phone" :class="cssClasses.input">
                        </FormField>
                        <FormField error-key="client.contact.email">
                            <template #label>Email</template>
                            <DaDataNext placeholder="client@example.ru" v-model="client.contact.email" type="email" :cssClasses="cssClasses"></DaDataNext>
                        </FormField>
                    </OrderFormBlock>
                    <OrderFormBlock>
                        <template #header>Реквизиты</template>
                        <FormField error-key="client.type">
                            <template #label>Субъект</template>
                            <select v-model="clientType" class="py-2 px-3 text-gray-500 rounded-md border bg-white mt-1 block w-full border-gray-100 shadow-sm focus:border-red-500 focus:ring-red-500">
                                <option v-for="(type, key) in page.props.defines.clientTypes.options" :value="key">{{ type }}</option>
                            </select>
                        </FormField>
                        <FormField v-if="client.type === 'legal'" error-key="client.data.data.inn">
                            <template #label>Компания</template>
                            <DaDataNext placeholder="Название или ИНН" :set-input-value="setCompanyValue" v-model="companyData.value" type="party" :cssClasses="cssClasses">
                                <template #list-item="{ prop, prepareValue}">
                                    <div class="text-gray-600">
                                        <div>{{ prop.value }}</div>
                                        <div class="text-xs text-gray-400">ИНН: {{ prop?.data?.inn }}</div>
                                    </div>
                                </template>
                            </DaDataNext>
                            <div v-if="client.data?.data?.inn" class="mt-2 text-xs text-gray-400 px-2">
                                <span>ИНН: {{ client.data?.data?.inn }}</span>
                                <span v-if="client.data?.data?.kpp" class="ml-2">КПП: {{ client.data?.data?.kpp }}</span>
                            </div>
                        </FormField>
                        <FormField v-if="client.type === 'legal'" error-key="client.paymentDetails.bank.data.bic">
                            <template #label>Банк</template>
                            <DaDataNext placeholder="Банк или БИК" type="bank" :set-input-value="setBankValue" v-model="bankData.value" :cssClasses="cssClasses">
                                <template #list-item="{ prop, prepareValue}">
                                    <div class="text-gray-600">
                                        <div>{{ prop.value }}</div>
                                        <div class="text-xs text-gray-400">БИК: {{ prop?.data?.bic }}</div>
                                    </div>
                                </template>
                            </DaDataNext>
                            <div v-if="bankData?.data?.bic" class="mt-2 text-xs text-gray-400 px-2">
                                <span>БИК: {{ bankData?.data?.bic }}</span>
                                <span v-if="bankData?.data?.correspondent_account" class="ml-2">КОР СЧ: {{ bankData?.data?.correspondent_account }}</span>
                            </div>
                        </FormField>
                        <FormField v-if="client.type === 'legal'" error-key="client.paymentDetails.bankAccountNumber">
                            <template #label>Расчетный счет</template>
                            <input type="text" v-model="bankAccountNumber" required name="rsc" :class="cssClasses.input">
                        </FormField>
                    </OrderFormBlock>
                    <OrderFormBlock>
                        <template #header>Доставка</template>
                        <FormField error-key="delivery.type">
                            <template #label>Тип доставки</template>
                            <select v-model="deliveryType" class="py-2 px-3 text-gray-500 rounded-md border bg-white mt-1 block w-full border-gray-100 shadow-sm focus:border-red-500 focus:ring-red-500">
                                <option v-for="(type, key) in page.props.defines.deliveryTypes.options" :value="key">{{ type }}</option>
                            </select>
                        </FormField>
                        <FormField v-if="delivery.type === 'selfPickup'" error-key="delivery.pickupPoint">
                            <template #label>Пункт выдачи</template>
                            <select v-model="pickupPointIndex" class="py-2 px-3 text-gray-500 rounded-md border bg-white mt-1 block w-full border-gray-100 shadow-sm focus:border-red-500 focus:ring-red-500">
                                <option v-for="(point, key) in page.props.defines.warehouses" :value="key">{{ point.address }}</option>
                            </select>
                        </FormField>
                        <FormField v-if="deliveryType === 'toAddress'" error-key="delivery.data.value">
                            <template #label>Адрес доставки</template>
                            <DaDataNext placeholder="Город, улица, дом" :set-input-value="setDeliveryValue" v-model="deliveryToAddressData.value" type="address" :cssClasses="cssClasses"/>
                        </FormField>
                    </OrderFormBlock>
                    <div class="mb-4 flex items-center">
                        <input v-model="acceptPrivacyPolicy" type="checkbox" id="privacy-policy" class="mr-4">
                        <label for="privacy-policy" class="text-gray-700 text-xs"> Я согласен с <a href="https://bpks.ru/privacy-policy" target="_blank" class="text-blue-500">политикой конфиденциальности</a> а также с <a href="https://bpks.ru/user-agreement" target="_blank" class="text-blue-500">правилами обработки и хранения персональных данных.</a></label>
                    </div>
                    <button :disabled="!acceptPrivacyPolicy" type="submit" class="bg-red-600 hover:bg-red-700 w-full px-4 py-4 rounded-md text-white cursor-pointer disabled:bg-gray-300 disabled:cursor-default"> Оформить заказ </button>
                </OrderForm>
            </div>
        </div>
    </Layout>
</template>
