<script setup>
import Layout from '../Layouts/Basic.vue'
import {usePage} from "@inertiajs/vue3";
import ProductList from '../Components/ProductsList.vue'

defineProps({
    products: Object,
})

const page = usePage()
</script>

<template>
    <Layout>
        <ProductList v-if="products?.data?.length" :products="products"/>
    </Layout>
</template>
