<template>
    <Layout>
        <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <!-- Заголовок заказа -->
                    <div class="px-4 py-5 sm:px-6 bg-gray-800 text-white">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center">
                                <ShoppingBagIcon class="h-6 w-6 mr-2" />
                                <div>
                                    <h1 class="text-2xl font-bold">Заказ #{{ order.data.uuid }}</h1>
                                    <p class="mt-1 text-gray-300">
                                        Создан: {{ formatDate(order.data.created_at) }} в {{ formatTime(order.data.created_at) }}
                                    </p>
                                </div>
                            </div>
                            <span :class="statusBadgeClass">
                <component :is="statusIcon" class="h-3 w-3 mr-1" />
                {{ getStatusText(order.data.state) }}
              </span>
                        </div>
                    </div>

                    <!-- Информация о клиенте -->
                    <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
                        <h2 class="text-lg font-medium text-gray-900 flex items-center">
                            <UserCircleIcon class="h-5 w-5 mr-2 text-gray-500" />
                            Информация о клиенте
                        </h2>
                        <div class="mt-4 grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Тип клиента</p>
                                <p class="mt-1 text-sm text-gray-900 capitalize">
                                    {{ order.data.client.type === 'individual' ? 'Физическое лицо' : 'Юридическое лицо' }}
                                </p>
                            </div>

                            <!-- Контактное лицо -->
                            <div>
                                <p class="text-sm font-medium text-gray-500">Контактное лицо</p>
                                <p class="mt-1 text-sm text-gray-900">{{ order.data.client.contact.name }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500">Телефон</p>
                                <p class="mt-1 text-sm text-gray-900">{{ order.data.client.contact.phone }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="mt-1 text-sm text-gray-900">{{ order.data.client.contact.email }}</p>
                            </div>

                            <!-- Для юрлиц -->
                            <template v-if="order.data.client.type === 'legal' && order.data.client.data">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Название организации</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ order.data.client.data.value }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">ИНН</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ order.data.client.data.data.inn }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">КПП</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ order.data.client.data.data.kpp }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">Юридический адрес</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ order.data.client.data.data.address.value }}</p>
                                </div>
                            </template>
                        </div>

                        <!-- Реквизиты для юрлиц -->
                        <div v-if="order.data.client.type === 'legal' && order.data.client.paymentDetails" class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="text-md font-medium text-gray-900 flex items-center">
                                <BanknotesIcon class="h-5 w-5 mr-2 text-gray-500" />
                                Банковские реквизиты
                            </h3>
                            <div class="mt-4 grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Банк</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ order.data.client.paymentDetails.bank.value }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">БИК</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ order.data.client.paymentDetails.bank.data.bic }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">Расчетный счет</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ order.data.client.paymentDetails.bankAccountNumber }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">Корр. счет</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ order.data.client.paymentDetails.bank.data.correspondent_account }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Информация о доставке -->
                    <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
                        <h2 class="text-lg font-medium text-gray-900 flex items-center">
                            <TruckIcon class="h-5 w-5 mr-2 text-gray-500" />
                            Доставка
                        </h2>
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-500">Способ получения</p>
                            <p class="mt-1 text-sm text-gray-900 capitalize">
                                {{ order.data.delivery.type === 'selfPickup' ? 'Самовывоз' : 'Доставка по адресу' }}
                            </p>

                            <template v-if="order.data.delivery.data">
                                <p class="mt-3 text-sm font-medium text-gray-500">Адрес</p>
                                <p class="mt-1 text-sm text-gray-900 flex items-center">
                                    <MapPinIcon class="h-4 w-4 mr-1 text-gray-400" />
                                    {{ order.data.delivery.data.value }}
                                </p>

                                <div v-if="order.data.delivery.data.data.geo_lat" class="mt-2 flex items-center text-sm text-gray-500">
                                    <MapIcon class="h-4 w-4 mr-1 text-gray-400" />
                                    Координаты: {{ order.data.delivery.data.data.geo_lat }}, {{ order.data.delivery.data.data.geo_lon }}
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Товары в заказе -->
                    <div class="px-4 py-5 sm:px-6">
                        <h2 class="text-lg font-medium text-gray-900 flex items-center">
                            <ClipboardDocumentListIcon class="h-5 w-5 mr-2 text-gray-500" />
                            Товары в заказе
                        </h2>
                        <div class="mt-4 flow-root">
                            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Товар</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Цена</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Кол-во</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Сумма</th>
                                        </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                        <tr v-for="item in order.data.items" :key="item.uuid">
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-0">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 flex-shrink-0 bg-gray-200 rounded-md flex items-center justify-center">
                                                        <CubeIcon class="h-5 w-5 text-gray-500" />
                                                    </div>
                                                    <div class="ml-4">
                                                        <a :href="item.product.url" class="font-medium text-gray-900 hover:text-indigo-600">
                                                            {{ item.product.name }}
                                                        </a>
                                                        <p class="text-gray-500 text-xs mt-1">Арт: {{ item.supplierCode }}</p>
                                                        <p v-if="item.product.supplierData.Brand" class="text-gray-500 text-xs">Бренд: {{ item.product.supplierData.Brand }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ formatPrice(item.product.price) }} ₽
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ item.quantity }} {{ item.product.unitData.conventionalNationalView }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">
                                                {{ formatPrice(item.total) }} ₽
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th scope="row" colspan="3" class="hidden pl-6 pr-3 pt-4 text-right text-sm font-semibold text-gray-900 sm:table-cell sm:pl-0">
                                                Итого
                                            </th>
                                            <th scope="row" class="pl-4 pr-3 pt-4 text-left text-sm font-semibold text-gray-900 sm:hidden">
                                                Итого
                                            </th>
                                            <td class="pl-3 pr-4 pt-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">
                                                {{ formatPrice(order.data.total) }} ₽
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Действия -->
                    <div class="bg-gray-100 px-4 py-4 sm:px-6 flex justify-end space-x-3">
                        <button
                            type="button"
                            class="inline-flex items-center rounded-md bg-gray-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-800"
                        >
                            <PrinterIcon class="-ml-0.5 mr-1.5 h-5 w-5" />
                            Печать
                        </button>
                        <button
                            type="button"
                            class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                        >
                            <ArrowLeftIcon class="-ml-0.5 mr-1.5 h-5 w-5" />
                            Назад
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import { computed } from 'vue';
import Layout from '../Layouts/Basic.vue';
import {
    ShoppingBagIcon,
    UserCircleIcon,
    BanknotesIcon,
    TruckIcon,
    ClipboardDocumentListIcon,
    CubeIcon,
    PrinterIcon,
    ArrowLeftIcon,
    MapPinIcon,
    MapIcon,
    ClockIcon,
    CheckCircleIcon,
    XCircleIcon,
    ExclamationTriangleIcon
} from '@heroicons/vue/24/outline';

const props = defineProps({
    order: {
        type: Object,
        required: true
    }
});

// Форматирование даты
const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('ru-RU', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });
};

// Форматирование времени
const formatTime = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleTimeString('ru-RU', {
        hour: '2-digit',
        minute: '2-digit'
    });
};

// Форматирование цены
const formatPrice = (price) => {
    return new Intl.NumberFormat('ru-RU', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(price);
};

// Текстовое представление статуса
const getStatusText = (status) => {
    const statusMap = {
        'created': 'Новый',
        'completed': 'Завершен',
        'rejected': 'Отклонен',
        'expired': 'Просрочен'
    };
    return statusMap[status] || status;
};

// Иконка для статуса
const statusIcon = computed(() => {
    const icons = {
        'created': ClockIcon,
        'completed': CheckCircleIcon,
        'rejected': XCircleIcon,
        'expired': ExclamationTriangleIcon
    };
    return icons[props.order.data.state] || ClockIcon;
});

// Классы для бейджа статуса
const statusBadgeClass = computed(() => {
    const baseClass = 'inline-flex items-center rounded-full px-3 py-1 text-xs font-medium';
    const statusClasses = {
        'created': 'bg-blue-100 text-blue-800',
        'completed': 'bg-green-100 text-green-800',
        'rejected': 'bg-red-100 text-red-800',
        'expired': 'bg-yellow-100 text-yellow-800'
    };
    return `${baseClass} ${statusClasses[props.order.data.state] || 'bg-gray-100 text-gray-800'}`;
});
</script>
