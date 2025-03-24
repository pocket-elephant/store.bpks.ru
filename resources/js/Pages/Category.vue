<script setup>
import Layout from '../Layouts/Basic.vue'
import CategoryMenu from '../Components/CategoryMenu.vue'
import ProductsList from '../Components/ProductsList.vue'

defineProps({
    category: Object,
    categories: Object,
    products: Object,
})
</script>

<template>
    <Layout>
        <div class="grid md:grid-cols-3 grid-cols-1 gap-2 md:gap-12">

            <div class="col-span-3 md:col-span-1">
                <CategoryMenu :categories="categories.data"/>
            </div>

            <div class="col-span-3 md:col-span-2">
                <h1 class="text-xl sm:text-2xl lg:text-3xl mb-2">{{ category.name}}</h1>
                <ProductsList :products="products"/>
            </div>
        </div>

    </Layout>
</template>
