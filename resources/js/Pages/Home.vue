<script setup>
import Layout from '../Layouts/Basic.vue'
import CategoryMenu from '../Components/CategoryMenu.vue'
import CategoryList from '../Components/CategoryList.vue';

const props = defineProps({
    categories: Object
})

</script>

<template>
    <Layout>
        <CategoryList :categories="categories.data"/>
        <CategoryMenu v-if="false" :categories="categories.data"/>
    </Layout>
</template>
