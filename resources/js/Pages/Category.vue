<template>
    <Layout>
        <div class="grid md:grid-cols-3 grid-cols-1 gap-2 md:gap-12">
            <!-- Сайдбар -->
            <div class="col-span-3 md:col-span-1">
                <SubCategories :categories="categories" />
            </div>

            <!-- Основной контент -->
            <div class="col-span-3 md:col-span-2">
                <ProductList :category="category" :products="products" />
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from '@/Layouts/Basic.vue';
import SubCategories from '@/Components/Category/SubCategories.vue';
import ProductList from '@/Components/Product/ProductList.vue';

defineProps({
    category: Object,
    categories: Object,
    products: Object
});
</script>
