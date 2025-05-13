<script setup>
import Layout from '../Layouts/Basic.vue'
import CategoryMenu from '../Components/CategoryMenu.vue'
import moneyFormat from "../helpers.js";
import AddToCard from "../Components/AddToCard.vue";

defineProps({
    product: {
        type: Object,
        required: true
    },
    categories: {
        type: Object,
        required: true
    }
})

const addToCart = () => {

}

// export default {
//     props: {
//         product: {
//             type: Object,
//             required: true
//         }
//     },
//     methods: {
//         addToCart() {
//             // Логика добавления в корзину
//             this.$inertia.post(route('cart.add'), {
//                 product_id: this.product.ItemId,
//                 quantity: 1
//             }, {
//                 preserveScroll: true,
//                 onSuccess: () => {
//                     // Можно добавить уведомление об успешном добавлении
//                 }
//             });
//         }
//     }
// }
</script>
<template>
    <Layout>
        <div class="grid md:grid-cols-3 grid-cols-1 gap-2 md:gap-12">

            <div class="col-span-3 md:col-span-1">
                <CategoryMenu :categories="categories.data"/>
            </div>

            <div class="col-span-3 md:col-span-2">
                <h1 class="text-2xl text-gray-900 mb-2">{{ product.data.name }}</h1>
                <div class="mb-6">
                    <div class="flex items-baseline mb-2">
                        <span class="text-3xl text-gray-900">{{ moneyFormat(product.data.price) }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-green-600 font-medium mr-2">В наличии</span>
                        <span class="text-gray-600"> {{ product.data.stock }} {{ product.data.unit }}</span>
                    </div>
                </div>
                <AddToCard :product="product.data"/>

                <!-- Характеристики -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Характеристики</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div class="flex" v-if="product.data.supplierData?.Brand">
                            <span class="text-gray-600 w-1/2">Бренд</span>
                            <span class="text-gray-900 font-medium w-1/2">{{ product.data.supplierData.Brand }} </span>
                        </div>
                        <div class="flex" v-if="product.data.supplierData?.VendorProdNum">
                            <span class="text-gray-600 w-1/2">Артикул</span>
                            <span class="text-gray-900 font-medium w-1/2">{{ product.data.supplierData.VendorProdNum }}</span>
                        </div>
                        <div class="flex" v-if="product.data.supplierData?.EAN?.Value">
                            <span class="text-gray-600 w-1/2">Штрих-код</span>
                            <span class="text-gray-900 font-medium w-1/2">{{ product.data.supplierData.EAN.Value }}</span>
                        </div>
                        <div class="flex" v-if="product.data.supplierData?.ProductGroup">
                            <span class="text-gray-600 w-1/2">Категория</span>
                            <span class="text-gray-900 font-medium w-1/2">{{ product.data.supplierData.ProductGroup }}</span>
                        </div>
                        <div class="flex" v-if="product.data.unit">
                            <span class="text-gray-600 w-1/2">Единица измерения</span>
                            <span class="text-gray-900 font-medium w-1/2">{{ product.data.unit }}</span>
                        </div>
                        <div class="flex" v-if="product.data.supplierData?.Multiplicity">
                            <span class="text-gray-600 w-1/2">Кратность</span>
                            <span class="text-gray-900 font-medium w-1/2">{{ product.data.supplierData.Multiplicity }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </Layout>
</template>
<!--<template>-->
<!--    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">-->
<!--        &lt;!&ndash; Хлебные крошки &ndash;&gt;-->
<!--        <nav class="flex mb-6" aria-label="Breadcrumb">-->
<!--            <ol class="inline-flex items-center space-x-1 md:space-x-3">-->
<!--                <li class="inline-flex items-center">-->
<!--                    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">-->
<!--                        <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">-->
<!--                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>-->
<!--                        </svg>-->
<!--                        Главная-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <div class="flex items-center">-->
<!--                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">-->
<!--                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>-->
<!--                        </svg>-->
<!--                        <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">product.ParentProdGroup</a>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <div class="flex items-center">-->
<!--                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">-->
<!--                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>-->
<!--                        </svg>-->
<!--                        <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">product.ProductGroup</a>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li aria-current="page">-->
<!--                    <div class="flex items-center">-->
<!--                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">-->
<!--                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>-->
<!--                        </svg>-->
<!--                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ product.name }}</span>-->
<!--                    </div>-->
<!--                </li>-->
<!--            </ol>-->
<!--        </nav>-->

<!--        &lt;!&ndash; Основная информация о товаре &ndash;&gt;-->
<!--        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">-->
<!--            &lt;!&ndash; Левая колонка - изображение товара &ndash;&gt;-->
<!--            <div class="lg:col-span-1 bg-white rounded-lg shadow-md p-4">-->
<!--                <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200">-->
<!--                    <img src="https://via.placeholder.com/600x600?text=Product+Image" alt="Product image" class="h-full w-full object-cover object-center">-->
<!--                </div>-->
<!--                <div class="mt-4 grid grid-cols-3 gap-2">-->
<!--                    <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg bg-gray-200">-->
<!--                        <img src="https://via.placeholder.com/200x200?text=Thumb+1" alt="Thumbnail 1" class="h-full w-full object-cover object-center">-->
<!--                    </div>-->
<!--                    <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg bg-gray-200">-->
<!--                        <img src="https://via.placeholder.com/200x200?text=Thumb+2" alt="Thumbnail 2" class="h-full w-full object-cover object-center">-->
<!--                    </div>-->
<!--                    <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg bg-gray-200">-->
<!--                        <img src="https://via.placeholder.com/200x200?text=Thumb+3" alt="Thumbnail 3" class="h-full w-full object-cover object-center">-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

<!--            &lt;!&ndash; Центральная колонка - информация о товаре &ndash;&gt;-->
<!--            <div class="lg:col-span-2">-->
<!--                <div class="bg-white rounded-lg shadow-md p-6">-->
<!--                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ product.name }}</h1>-->
<!--                    <div class="flex items-center mb-4">-->
<!--                        <div class="flex items-center">-->
<!--                            <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">-->
<!--                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>-->
<!--                            </svg>-->
<!--                            <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">-->
<!--                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>-->
<!--                            </svg>-->
<!--                            <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">-->
<!--                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>-->
<!--                            </svg>-->
<!--                            <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">-->
<!--                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>-->
<!--                            </svg>-->
<!--                            <svg class="w-4 h-4 text-gray-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">-->
<!--                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                        <span class="text-gray-600 text-sm ml-2">12 отзывов</span>-->
<!--                    </div>-->

<!--                    &lt;!&ndash; Цены и наличие &ndash;&gt;-->
<!--                    <div class="mb-6">-->
<!--                        <div class="flex items-baseline mb-2">-->
<!--                            <span class="text-3xl font-bold text-gray-900">product.RetailPrice  product.RetailCurrency</span>-->
<!--                            <span class="ml-2 text-lg text-gray-500 line-through"> product.Price2 product.RetailCurrency</span>-->
<!--                            <span class="ml-2 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">-15%</span>-->
<!--                        </div>-->
<!--                        <div class="flex items-center">-->
<!--                            <span class="text-green-600 font-medium mr-2">В наличии</span>-->
<!--                            <span class="text-gray-600"> product.QTY   product.UOM</span>-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    &lt;!&ndash; Кнопка добавления в корзину &ndash;&gt;-->
<!--                    <div class="flex items-center mb-6">-->
<!--                        <div class="flex items-center border border-gray-300 rounded-md mr-4">-->
<!--                            <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-l-md">-</button>-->
<!--                            <input type="text" class="w-12 text-center border-0 focus:ring-0" value="1">-->
<!--                            <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-r-md">+</button>-->
<!--                        </div>-->
<!--                        <button @click="addToCart" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition duration-300 flex items-center justify-center">-->
<!--                            <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">-->
<!--                                <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>-->
<!--                            </svg>-->
<!--                            В корзину-->
<!--                        </button>-->
<!--                    </div>-->

<!--                    &lt;!&ndash; Краткое описание &ndash;&gt;-->
<!--                    <div class="mb-6">-->
<!--                        <h3 class="text-lg font-medium text-gray-900 mb-2">Описание</h3>-->
<!--                        <p class="text-gray-600">Провод ПуГВВ 3х2.5 Б предназначен для стационарной прокладки в осветительных и силовых сетях, а также для монтажа электрооборудования, машин, механизмов и станков на номинальное напряжение до 450 В (Uₒ/U) частоты до 400 Гц.</p>-->
<!--                    </div>-->

<!--                    &lt;!&ndash; Характеристики &ndash;&gt;-->
<!--                    <div class="mb-6">-->
<!--                        <h3 class="text-lg font-medium text-gray-900 mb-2">Характеристики</h3>-->
<!--                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">-->
<!--                            <div class="flex">-->
<!--                                <span class="text-gray-600 w-1/2">Бренд</span>-->
<!--                                <span class="text-gray-900 font-medium w-1/2"> product.Brand </span>-->
<!--                            </div>-->
<!--                            <div class="flex">-->
<!--                                <span class="text-gray-600 w-1/2">Артикул</span>-->
<!--                                <span class="text-gray-900 font-medium w-1/2"> product.VendorProdNum </span>-->
<!--                            </div>-->
<!--                            <div class="flex">-->
<!--                                <span class="text-gray-600 w-1/2">Штрих-код</span>-->
<!--                                <span class="text-gray-900 font-medium w-1/2"> product.EAN.Value </span>-->
<!--                            </div>-->
<!--                            <div class="flex">-->
<!--                                <span class="text-gray-600 w-1/2">Категория</span>-->
<!--                                <span class="text-gray-900 font-medium w-1/2"> product.ProductGroup </span>-->
<!--                            </div>-->
<!--                            <div class="flex">-->
<!--                                <span class="text-gray-600 w-1/2">Единица измерения</span>-->
<!--                                <span class="text-gray-900 font-medium w-1/2"> product.UOM </span>-->
<!--                            </div>-->
<!--                            <div class="flex">-->
<!--                                <span class="text-gray-600 w-1/2">Кратность</span>-->
<!--                                <span class="text-gray-900 font-medium w-1/2"> product.Multiplicity</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--        &lt;!&ndash; Дополнительные блоки &ndash;&gt;-->
<!--        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">-->
<!--            &lt;!&ndash; Описание &ndash;&gt;-->
<!--            <div class="bg-white rounded-lg shadow-md p-6">-->
<!--                <h3 class="text-lg font-medium text-gray-900 mb-4">Подробное описание</h3>-->
<!--                <div class="prose prose-sm text-gray-600">-->
<!--                    <p>Провод монтажный ПуГВВ 3х2.5 Б (бухта) применяется для неподвижного монтажа электрических цепей в силовых и осветительных сетях с номинальным переменным напряжением до 450 В частотой до 400 Гц или постоянным напряжением до 1000 В.</p>-->
<!--                    <p><strong>Конструкция:</strong></p>-->
<!--                    <ul>-->
<!--                        <li>Токопроводящая жила - медная, многопроволочная, класса 5 по ГОСТ 22483</li>-->
<!--                        <li>Изоляция - из ПВХ пластиката</li>-->
<!--                        <li>Оболочка - из ПВХ пластиката</li>-->
<!--                    </ul>-->
<!--                    <p><strong>Условия эксплуатации:</strong></p>-->
<!--                    <ul>-->
<!--                        <li>Температура эксплуатации: от -50°С до +70°С</li>-->
<!--                        <li>Относительная влажность воздуха при температуре до +35°С: до 98%</li>-->
<!--                        <li>Прокладка без предварительного подогрева производится при температуре не ниже -15°С</li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->

<!--            &lt;!&ndash; Документы &ndash;&gt;-->
<!--            <div class="bg-white rounded-lg shadow-md p-6">-->
<!--                <h3 class="text-lg font-medium text-gray-900 mb-4">Документы</h3>-->
<!--                <div class="space-y-3">-->
<!--                    <a href="#" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50">-->
<!--                        <svg class="w-6 h-6 text-gray-500 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">-->
<!--                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 18a.969.969 0 0 0 .933 1h12.134A.97.97 0 0 0 15 18M1 7V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2v5M6 1v4a1 1 0 0 1-1 1H1m0 9v-5h1.5a1.5 1.5 0 1 1 0 3H1m12 2v-5h2m-2 3h2m-8-3v5h1.375A1.626 1.626 0 0 0 10 13.375v-1.75A1.626 1.626 0 0 0 8.375 10H7Z"/>-->
<!--                        </svg>-->
<!--                        <div>-->
<!--                            <div class="font-medium text-gray-900">Технический паспорт</div>-->
<!--                            <div class="text-xs text-gray-500">PDF, 1.2 MB</div>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                    <a href="#" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50">-->
<!--                        <svg class="w-6 h-6 text-gray-500 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">-->
<!--                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 18a.969.969 0 0 0 .933 1h12.134A.97.97 0 0 0 15 18M1 7V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2v5M6 1v4a1 1 0 0 1-1 1H1m0 9v-5h1.5a1.5 1.5 0 1 1 0 3H1m12 2v-5h2m-2 3h2m-8-3v5h1.375A1.626 1.626 0 0 0 10 13.375v-1.75A1.626 1.626 0 0 0 8.375 10H7Z"/>-->
<!--                        </svg>-->
<!--                        <div>-->
<!--                            <div class="font-medium text-gray-900">Сертификат соответствия</div>-->
<!--                            <div class="text-xs text-gray-500">PDF, 0.8 MB</div>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                    <a href="#" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50">-->
<!--                        <svg class="w-6 h-6 text-gray-500 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">-->
<!--                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 18a.969.969 0 0 0 .933 1h12.134A.97.97 0 0 0 15 18M1 7V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2v5M6 1v4a1 1 0 0 1-1 1H1m0 9v-5h1.5a1.5 1.5 0 1 1 0 3H1m12 2v-5h2m-2 3h2m-8-3v5h1.375A1.626 1.626 0 0 0 10 13.375v-1.75A1.626 1.626 0 0 0 8.375 10H7Z"/>-->
<!--                        </svg>-->
<!--                        <div>-->
<!--                            <div class="font-medium text-gray-900">Инструкция по монтажу</div>-->
<!--                            <div class="text-xs text-gray-500">PDF, 1.5 MB</div>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--        &lt;!&ndash; Похожие товары &ndash;&gt;-->
<!--        <div class="mt-12">-->
<!--            <h2 class="text-xl font-bold text-gray-900 mb-6">Похожие товары</h2>-->
<!--            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">-->
<!--                &lt;!&ndash; Товар 1 &ndash;&gt;-->
<!--                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">-->
<!--                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200">-->
<!--                        <img src="https://via.placeholder.com/300x300?text=Product+1" alt="Product 1" class="h-full w-full object-cover object-center">-->
<!--                    </div>-->
<!--                    <div class="p-4">-->
<!--                        <h3 class="text-sm font-medium text-gray-900">Провод ПуГВВ 3х1.5 Б (бухта) (м) ПромЭл</h3>-->
<!--                        <div class="mt-2 flex items-center">-->
<!--                            <span class="text-lg font-bold text-gray-900">89.50 rub</span>-->
<!--                            <span class="ml-2 text-sm text-gray-500 line-through">105.30 rub</span>-->
<!--                        </div>-->
<!--                        <button class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">-->
<!--                            В корзину-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->

<!--                &lt;!&ndash; Товар 2 &ndash;&gt;-->
<!--                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">-->
<!--                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200">-->
<!--                        <img src="https://via.placeholder.com/300x300?text=Product+2" alt="Product 2" class="h-full w-full object-cover object-center">-->
<!--                    </div>-->
<!--                    <div class="p-4">-->
<!--                        <h3 class="text-sm font-medium text-gray-900">Провод ПуГВВ 3х4.0 Б (бухта) (м) ПромЭл</h3>-->
<!--                        <div class="mt-2 flex items-center">-->
<!--                            <span class="text-lg font-bold text-gray-900">132.75 rub</span>-->
<!--                            <span class="ml-2 text-sm text-gray-500 line-through">156.20 rub</span>-->
<!--                        </div>-->
<!--                        <button class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">-->
<!--                            В корзину-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->

<!--                &lt;!&ndash; Товар 3 &ndash;&gt;-->
<!--                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">-->
<!--                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200">-->
<!--                        <img src="https://via.placeholder.com/300x300?text=Product+3" alt="Product 3" class="h-full w-full object-cover object-center">-->
<!--                    </div>-->
<!--                    <div class="p-4">-->
<!--                        <h3 class="text-sm font-medium text-gray-900">Кабель ВВГ 3х2.5 (м) ПромЭл</h3>-->
<!--                        <div class="mt-2 flex items-center">-->
<!--                            <span class="text-lg font-bold text-gray-900">145.90 rub</span>-->
<!--                        </div>-->
<!--                        <button class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">-->
<!--                            В корзину-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->

<!--                &lt;!&ndash; Товар 4 &ndash;&gt;-->
<!--                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">-->
<!--                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200">-->
<!--                        <img src="https://via.placeholder.com/300x300?text=Product+4" alt="Product 4" class="h-full w-full object-cover object-center">-->
<!--                    </div>-->
<!--                    <div class="p-4">-->
<!--                        <h3 class="text-sm font-medium text-gray-900">Кабель NYM 3х2.5 (м) ПромЭл</h3>-->
<!--                        <div class="mt-2 flex items-center">-->
<!--                            <span class="text-lg font-bold text-gray-900">187.30 rub</span>-->
<!--                        </div>-->
<!--                        <button class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">-->
<!--                            В корзину-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->
